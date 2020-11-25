<?php

namespace App\Http\Livewire\Book;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Books\Models\Book;

class HomeList extends Component
{
    use WithPagination;

    //protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $page        = 1;
    public $search      = null;
    public $last_search = null;
    public $per_page    = 10;

    public function render()
    {
        $books = Book::search($this->search)
            ->orWhere('isbn_issn', 'LIKE', $this->search . '%')
            ->paginate($this->per_page);
        return view('livewire.book.home-list', ['books' => $books]);
    }
    public function updated()
    {
        if ($this->last_search != $this->search) {
            $this->page = 1;
            $this->last_search = $this->search;
        }
    }
}
