<?php

namespace App\Console\Commands;

use App\Exceptions\ImportException;
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
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Exception\CommonMarkException;
use Resend\Laravel\Facades\Resend;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-images';
    protected array $data;

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
        $category = new Category();
        foreach ($files as $file) {
            $type = Storage::mimeType($file);
            if (!$type) {
                $this->error('no type in image ' . $file);
                continue;
            }
            $path = Storage::path($file);
            $baseFileName = basename($file);
            try {
                $this->setData($path, $baseFileName, $category);
            } catch (ImportException $exception) {
                $adminUser = User::where('is_admin', true)->first();
                Notification::send($adminUser, new ErrorNotification($exception));
                $this->error('no header in image ' . $path);
                continue;
            }
            $content = Content::where('header', $this->data['header'])->first();
            if (!$content) {
                $content = Content::create($this->data);
            }
            $mediaItem = $content->addMedia(
                Storage::disk('public')->path('/import/') . $baseFileName
            )->toMediaCollection('images');
            $mediaItem->meta = $this->data['header'];
            $mediaItem->headline = $this->data['header'];
            $mediaItem->description = $this->data['metadescription'];
            $mediaItem->keywords = $this->data['keywords'];
            $mediaItem->date = $this->data['date'];
            $mediaItem->website = $this->data['website'];
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
     * @param string $path
     * @param string $baseFileName
     * @param Category $category
     * @return void
     * @throws ImportException
     */
    public function setData(string $path, string $baseFileName, Category $category): void
    {
        $this->setHeader($path);
        $this->data['website'] = ImageService::parseData('*URL*', $path);
        if (empty($this->data['website'])) {
            $this->data['website'] = ImageService::parseSourceName($path);
            if (empty($this->data['website'])) {
                $this->data['website'] = 'berlinerphotoblog.de';
            }
            $this->data['website'] = Str::of($this->data['website'])->chopStart(['https://', 'http://']);
        }

        $this->data['file_name'] = $baseFileName;
        $this->data['height'] = ImageService::parseData('ImageHeight', $path);
        $this->data['width'] = ImageService::parseData('ImageWidth', $path);
        $this->data['category_id'] = 1;
        $cat = $category::whereTranslation('short', ImageService::parseData('Category', $path))->first();
        if (is_object($cat) !== false) {
            $this->data['category_id'] = $cat?->id;
        }
        $this->data['metadescription'] = $this->data['header'];
        $this->data['meta'] = $this->data['header'];
        $this->data['single'] = 0;
        $this->data['active'] = 1;
        $this->data['date'] = $this->setContentDate();
        $text = ImageService::parseData('Description', $path);
        $this->data['text'] = ImageService::parseText($text);
        $this->data['keywords'] = Str::remove(',', ImageService::parseData('Keywords', $path));
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
     * @return string
     */
    public function setContentDate(): string
    {
        $contentDate = Content::latest('date')->first()->date;
        $today = Carbon::now();
        $lastCreatedDate = Carbon::createFromDate($contentDate);
        return $today->max($lastCreatedDate)->addDay(5)->format('Y-m-d');
    }

    /**
     * @throws ImportException
     */
    private function setHeader($path): void
    {
        $this->data['header'] = ImageService::parseObjectName($path);
        if (empty($this->data['header'])) {
            $this->data['header'] = ImageService::parseData('*Headline*', $path);
            if (empty($this->data['header'])) {
                Resend::emails()->send([
                    'from' => 'info@freudefoto.de',
                    'to' => ['jens@freude-now.de'],
                    'subject' => 'Import Image Problem',
                    'html' => 'no header in image ' . $path,
                ]);
                throw new ImportException('no header in image ' . $path);
            }
        }
        Log::debug('header: '. $this->data['header']);
    }
}
