<?php

namespace App\Console\Commands;

use App\Exceptions\ImportException;
use App\Mail\ErrorSend;
use App\Models\Category;
use App\Models\Content;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\ErrorNotification;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Exception\CommonMarkException;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importiert Dateien aus dem Import Verzeichnis in die Mediathek';

    /**
     * Execute the console command.
     * @throws CommonMarkException
     * @throws ImportException
     */
    public function handle(): void
    {
        $files = Storage::files(config('app.import_path'));
        Log::debug('Count Files to Import: ' . count($files));
        $contentDate = Content::latest('date')->first()->date;
        $lastDate = Carbon::createFromFormat('Y-m-d', $contentDate);
        $category = new Category();
        foreach ($files as $key => $file) {
            $type = Storage::mimeType($file);
            if (!$type) {
                $this->error('no type in image ' . $file);
                continue;
            }
            $path = Storage::path($file);
            $baseFileName = basename($file);
            try {
                $data = $this->setData($path, $baseFileName, $key, $category, $lastDate);
            }catch (ImportException $exception) {
                $adminUser = User::where('is_admin', true)->first();
                Notification::send($adminUser, new ErrorNotification($exception));
                $this->error('no header in image ' . $path);
                continue;
            }
            $content = Content::where('header', $data['header'])->first();
            if (!$content) {
                $content = Content::create($data);
            }
            $mediaItem = $content->addMedia(
                Storage::disk('public')->path('/import/') . $baseFileName
            )->toMediaCollection('images');
            $mediaItem->meta = $data['header'];
            $mediaItem->headline = $data['header'];
            $mediaItem->description = $data['metadescription'];
            $mediaItem->keywords = $data['keywords'];
            $mediaItem->date = $data['date'];
            $mediaItem->website = $data['website'];
            $mediaItem->save();

            $tags = $this->createTags($mediaItem->keywords);
            $content->tags()->sync($tags);
            $content->save();
            Artisan::call('queue:work --stop-when-empty --timeout=130');
        }
        Log::debug('läuft!');
        $this->info('läuft!');
    }

    /**
     * @param string $tags
     * @return array
     */
    private function createTags(string $tags): array
    {
        $replaced = Str::replace(' ', '#', $tags);
        $replaced = Str::replace(',', '#', $replaced);
        $explode = Str::of($replaced)->explode('#');
        $tagsArray = collect($explode)->filter();
        return collect($tagsArray)->map(function (string $tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->all();
    }

    /**
     * @param string $path
     * @param string $baseFileName
     * @param $key
     * @param Category $category
     * @param $lastDate
     * @throws ImportException
     */
    public function setData(string $path, string $baseFileName, $key, Category $category, $lastDate): array
    {
        $data['header'] = ImageService::parseData('Headline', $path);
        if (empty($data['header'])){
            throw new ImportException('no header in image ' . $path);
        }

        $data['file_name'] = $baseFileName;

        $data['height'] = ImageService::parseData('ImageHeight', $path);
        $data['width'] = ImageService::parseData('ImageWidth', $path);
        $data['category_id'] = 1;
        $cat = $category::whereTranslation('name', ImageService::parseData('Category', $path))->first();
        if(is_object($cat) !== false) {
            $data['category_id'] = $cat?->id;
        }
        $data['metadescription'] = $data['header'];
        $data['meta'] = $data['header'];
        $data['single'] = 0;
        $data['active'] = 1;
        $data['date'] = $lastDate->addDays($key)->format('Y-m-d');
        $text = ImageService::parseData('Description', $path);
        $data['text'] = ImageService::parseText($text);
        $data['keywords'] = Str::remove(',', ImageService::parseData('Keywords', $path));
        $data['website'] = !empty(ImageService::parseData('*URL*', $path)) ? Str::of(
            ImageService::parseData(
                '*URL*',
                $path
            )
        )->chopStart(['https://', 'http://']) : 'freudefoto.de';
        return $data;
    }
}
