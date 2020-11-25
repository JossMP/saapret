<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Books\Models\Author;
use Modules\Books\Models\AuthorBook;
use Modules\Books\Models\Book;

class WidgetFeaturedAuthors extends Component
{
    public $authors = null;
    public $type    = 'download';

    public function __construct($type = 'download')
    {
        $this->type = $type;

        if ($this->type == 'download') {
            $this->authors = Author::addSelect([
                'view' => Book::select(DB::raw('SUM(view)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'download' => Book::select(DB::raw('SUM(download)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'count' => AuthorBook::select(DB::raw('COUNT(*)'))->whereColumn('author_books.author_id', 'authors.id'),
            ])->orderBy($this->type, 'DESC')->limit(5)->get();
        } else if ($this->type == 'view') {
            $this->authors = Author::addSelect([
                'view' => Book::select(DB::raw('SUM(view)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'download' => Book::select(DB::raw('SUM(download)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'count' => AuthorBook::select(DB::raw('COUNT(*)'))->whereColumn('author_books.author_id', 'authors.id'),
            ])->orderBy($this->type, 'DESC')->limit(5)->get();
        } else if ($this->type == 'count') {
            $this->authors = Author::addSelect([
                'view' => Book::select(DB::raw('SUM(view)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'download' => Book::select(DB::raw('SUM(download)'))->join('author_books', 'author_books.book_id', '=', 'books.id')->whereColumn('author_books.author_id', 'authors.id'),
                'count' => AuthorBook::select(DB::raw('COUNT(*)'))->whereColumn('author_books.author_id', 'authors.id'),
            ])->orderBy($this->type, 'DESC')->limit(5)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if ($this->authors) {
            return view('components.widget-featured-authors');
        }
    }
}
