<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleSearch extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    public $search = '';
    public $category = '';
    
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategory()
    {
        $this->resetPage();
    }
    
    public function resetFilters()
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Article::query()->where('is_published', true);
        
        if (!empty($this->search)) {
            $query->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }
        
        if (!empty($this->category)) {
            $query->whereHas('category', function($query) {
                $query->where('slug', $this->category);
            });
        }
        
        $articles = $query->latest()->paginate(9);
        $categories = \App\Models\Category::all();
        
        return view('livewire.article-search', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
