<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\Books\Models\Book;

class WidgetTopBooks extends Component
{
    public $most_view = NULL;
    public $most_download = NULL;
    public function __construct()
    {
        $this->most_download = Book::orderBy('download', 'DESC')->first();
        $this->most_view = Book::orderBy('view', 'DESC')->first();
    }

    public function render()
    {
        if ($this->most_download && $this->most_view)
            return view('components.widget-top-books');
    }
}
