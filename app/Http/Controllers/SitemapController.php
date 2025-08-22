<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $frontUrl = env('FRONT_URL');
        $locales = ['en', 'az'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages for both locales
        foreach ($locales as $locale) {
            // Home page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}", '1.0', 'daily');

            // Products page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/products", '0.8', 'weekly');

            // About page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/about", '0.7', 'monthly');

            // Contact page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/contact", '0.7', 'monthly');

            // FAQ page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/faq", '0.7', 'monthly');

            // Blog listing page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/blogs", '0.8', 'weekly');

            // Login page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/login", '0.5', 'monthly');

            // Register page
            $xml .= $this->addUrl("{$frontUrl}/{$locale}/register", '0.5', 'monthly');
        }

        // Dynamic product pages
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            foreach ($locales as $locale) {
                $xml .= $this->addUrl(
                    "{$frontUrl}/{$locale}/product/{$product->slug}",
                    '0.9',
                    'weekly',
                    $product->updated_at
                );
            }
        }

        // Dynamic blog pages
        $blogs = Blog::where('is_active', true)->get();
        foreach ($blogs as $blog) {
            foreach ($locales as $locale) {
                $xml .= $this->addUrl(
                    "{$frontUrl}/{$locale}/blogs/{$blog->slug}",
                    '0.8',
                    'weekly',
                    $blog->updated_at
                );
            }
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    private function addUrl($url, $priority = '0.5', $changefreq = 'monthly', $lastmod = null)
    {
        $xml = '  <url>' . "\n";
        $xml .= '    <loc>' . htmlspecialchars($url) . '</loc>' . "\n";

        if ($lastmod) {
            $xml .= '    <lastmod>' . $lastmod->toISOString() . '</lastmod>' . "\n";
        } else {
            $xml .= '    <lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
        }

        $xml .= '    <changefreq>' . $changefreq . '</changefreq>' . "\n";
        $xml .= '    <priority>' . $priority . '</priority>' . "\n";
        $xml .= '  </url>' . "\n";

        return $xml;
    }
}