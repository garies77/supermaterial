@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    {{-- Static Pages --}}
    @foreach ($staticPages as $page)
    <url>
        <loc>{{ $page['url'] }}</loc>
        <lastmod>{{ $page['lastmod'] }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
    @endforeach

    {{-- Product Pages (if they exist) --}}
    @foreach ($products as $product)
    <url>
        <loc>{{ route('detail', $product->slug) }}</loc>
        <lastmod>{{ $product->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>        
        <priority>0.6</priority>
    </url>
    @endforeach
    


    {{-- Article Pages (if they exist) --}}
    @foreach ($articles as $article)
    <url>
        <loc>{{ route('detail', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset> 