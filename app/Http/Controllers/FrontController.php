<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Category;
use App\Models\WebInformation;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $products = Product::take(8)->orderBy('id', 'desc')->get();
        $categories = Category::select('name', 'slug')->get();

        return view('front.index', compact('webInfo', 'products', 'categories'));
    }

    /**
     * Display products listing page
     */
    public function products(Request $request)
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $query = Product::query();
        
        // Apply category filter if provided
        if ($request->has('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('front.products', compact('webInfo', 'products', 'categories'));
    }

    /**
     * Display product detail page
     */
    public function productDetail($slug)
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::whereHas('categories', function($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

        return view('front.product-detail', compact('webInfo', 'product', 'relatedProducts'));
    }

    /**
     * Display articles listing page
     */
    public function articles()
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $articles = Article::latest()->paginate(9);

        return view('front.articles', compact('webInfo', 'articles'));
    }

    /**
     * Display article detail page
     */
    public function articleDetail($slug)
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $article = Article::where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('front.article-detail', compact('webInfo', 'article', 'relatedArticles'));
    }

    public function detail($slug)
    {
        $webInfo = WebInformation::first() ?? new WebInformation();
        $product = Product::where('slug', $slug)->first();
        $article = Article::where('slug', $slug)->first();
        if (!empty($product)) {
            // Get related products that share categories with the current product
            $relatedProducts = Product::whereHas('category', function($query) use ($product) {
                $query->where('categories.id', $product->category_id);
            })
            ->where('id', '!=', $product->id)   
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();
            return view('front.product-detail', compact('webInfo', 'product', 'relatedProducts'));
        } elseif (!empty($article)) {
            return view('front.article-detail', compact('webInfo', 'article'));
        }else{
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
}
