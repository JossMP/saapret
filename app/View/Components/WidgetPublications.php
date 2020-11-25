<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Books\Models\Book;
use Modules\Books\Models\PublicationType;

class WidgetPublications extends Component
{
    public $publications = null;

    public function __construct()
    {
        $this->publications = PublicationType::addSelect([
            'count' => Book::select(DB::raw('COUNT(*)'))->whereColumn('books.publication_type_id', 'publication_types.id'),
        ])->get();
    }
    public function render()
    {
        return view('components.widget-publications');
    }
}
