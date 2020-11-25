<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\Books\Models\Book;

class LastBook extends Component
{
    public $books = null;
    public function __construct()
    {
        $this->books = Book::orderBy('id', 'DESC')->limit(6)->get();
    }
    public function render()
    {
        return view('components.last-book');
    }
}
