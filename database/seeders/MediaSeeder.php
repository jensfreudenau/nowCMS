<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $path = resource_path('sql/media.sql');
        if (File::exists($path)) {
            DB::unprepared(File::get($path));
        } else {
            throw new Exception("SQL file not found: $path");
        }
    }
}
