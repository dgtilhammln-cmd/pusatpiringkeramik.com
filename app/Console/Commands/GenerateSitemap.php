<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SitemapController;

class GenerateSitemap extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate physical sitemap.xml in public/ and public_html/';

    public function handle(): int
    {
        $xml = SitemapController::buildXml();

        // Write to public/sitemap.xml
        $dest = public_path('sitemap.xml');
        file_put_contents($dest, $xml);
        $this->info("Sitemap generated: {$dest} (" . substr_count($xml, '<url>') . ' URLs)');

        // Also write to public_html/sitemap.xml if directory exists
        $altDest = base_path('../public_html/sitemap.xml');
        if (is_dir(dirname($altDest))) {
            file_put_contents($altDest, $xml);
            $this->info("Copied to: {$altDest}");
        }

        $localPublicHtml = base_path('public_html/sitemap.xml');
        if (is_dir(dirname($localPublicHtml))) {
            file_put_contents($localPublicHtml, $xml);
            $this->info("Copied to: {$localPublicHtml}");
        }

        return self::SUCCESS;
    }
}

