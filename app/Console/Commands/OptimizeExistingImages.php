<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageOptimizer;

class OptimizeExistingImages extends Command
{
    protected $signature = 'images:optimize-webp';
    protected $description = 'Batch convert all stored PNG/JPG images in storage/app/public to optimized WebP format';

    public function handle()
    {
        $this->info('Starting WebP image optimization scan...');

        $files = Storage::disk('public')->allFiles();
        $convertedCount = 0;

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $webpPath = ImageOptimizer::convertExistingToWebp($file, 82);
                if ($webpPath) {
                    $convertedCount++;
                    $this->line("Converted: {$file} -> {$webpPath}");
                }
            }
        }

        $this->info("Completed! Converted {$convertedCount} images to WebP.");
        return 0;
    }
}
