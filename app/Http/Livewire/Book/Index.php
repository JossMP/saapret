<?php

namespace App\Http\Livewire\Book;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Books\Models\Book;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $page = 1;
    public $search = null;
    public $last_search = null;

    public function render()
    {
        $books = Book::search($this->search)
            ->orWhere('isbn_issn', 'LIKE', $this->search . '%')
            ->paginate(10);

        return view('livewire.book.index', ['books' => $books]);
    }

    public function updated()
    {
        if ($this->last_search != $this->search) {
            $this->page = 1;
            $this->last_search = $this->search;
        }
    }
}
