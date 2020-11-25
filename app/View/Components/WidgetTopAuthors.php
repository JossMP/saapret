<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Books\Models\Author;
use Modules\Books\Models\AuthorBook;
use Modules\Books\Models\Book;

class WidgetTopAuthors extends Component
{
    public $authors = null;
    public function __construct()
    {
        $this->authors = Author::limit(10)->addSelect([
            'count' => AuthorBook::select(DB::raw('COUNT(*)'))->whereColumn('author_books.author_id', 'authors.id')
        ])->orderBy('count', 'DESC')->get();
    }

    public function render()
    {
        return view('components.widget-top-authors');
    }
}
