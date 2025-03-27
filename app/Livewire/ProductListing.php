<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $categorySlug = '';
    public $sortOption = 'newest';
    
    // Listen for changes to these properties to reset pagination
    protected $queryString = [
        'search' => ['except' => ''],
        'categorySlug' => ['except' => ''],
        'sortOption' => ['except' => 'newest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategorySlug()
    {
        $this->resetPage();
    }

    public function updatingSortOption()
    {
        $this->resetPage();
    }

    public function setCategory($slug)
    {
        $this->categorySlug = $slug;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'categorySlug', 'sortOption']);
    }

    public function render()
    {
        $query = Product::query()->where('is_active', true);

        // Apply search
        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if (!empty($this->categorySlug)) {
            $query->whereHas('category', function ($query) {
                $query->where('slug', $this->categorySlug);
            });
        }

        // Apply sorting
        switch ($this->sortOption) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('livewire.product-listing', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
