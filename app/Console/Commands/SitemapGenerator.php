<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class SitemapGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        // Force URL generation to use HTTPS
        URL::forceScheme('https');

        $products = Product::select('slug', 'updated_at')->get();
        $articles = Article::select('slug', 'updated_at')->get();
        
        // Set static pages with their last update time
        $staticPages = [
            [
                'url' => URL::to('/'),
                'lastmod' => Carbon::now()->format('Y-m-d\TH:i:sP'),
                'priority' => '1.0',
                'changefreq' => 'weekly',
            ],
            [
                'url' => URL::route('products'),
                'lastmod' => Carbon::now()->format('Y-m-d\TH:i:sP'),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ],
            [
                'url' => URL::route('articles'),
                'lastmod' => Carbon::now()->format('Y-m-d\TH:i:sP'),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ],
            // Add more static pages as needed
        ];

        // Generate the sitemap content
        $sitemap = View::make('front.sitemap', [
            'staticPages' => $staticPages,
            'products' => $products,
            'articles' => $articles,
        ])->render();

        // Save the sitemap to public directory
        File::put(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap generated successfully at ' . public_path('sitemap.xml'));
    }
}
