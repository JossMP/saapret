<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Books\Models\BookCategory;
use Modules\Books\Models\Category;

class WidgetCategories extends Component
{
    public $categories = null;
    public function __construct()
    {
        $this->categories = Category::limit(20)->addSelect([
            'count' => BookCategory::select(DB::raw('COUNT(*)'))->whereColumn('book_category.category_id', 'categories.id')
        ])->get();
    }

    public function render()
    {
        return view('components.widget-categories');
    }
}
