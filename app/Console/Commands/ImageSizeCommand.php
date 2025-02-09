<?php

namespace App\Console\Commands;

use App\Models\Content;
use Illuminate\Console\Command;

class ImageSizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:image-size-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contents = Content::get();
        foreach ($contents as $content) {
            $imageItems = $content->getMedia('images');
            foreach ($imageItems as $imageItem) {

                list($width, $height) = getimagesize($imageItem->getPath());
                echo "width: " . $width . "\n";
                echo "height: " .  $height. "\n";
                $ratio = '';
                if($height === $width) {
                    $ratio = 'square';
                }
                if($height > $width) {
                    $ratio = 'portrait';
                }
                if($height < $width) {
                    $ratio = 'landscape';
                }
                $imageItem->setCustomProperty('ratio', $ratio);
                $imageItem->setCustomProperty('width', $width);
                $imageItem->setCustomProperty('height', $height);
                $imageItem->save();
                dump($imageItem);
            }

        }

    }
}
