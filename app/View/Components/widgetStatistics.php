<?php

namespace App\View\Components;

use App\Models\Career;
use Illuminate\View\Component;

class widgetStatistics extends Component
{
    public $careers = null;
    public $title = 'Carreras Profesionales';
    public function __construct($title = null)
    {
        $this->title = ($title != null) ? $title : $this->title;

        $this->careers = Career::all();
    }

    public function render()
    {
        return view('components.widget-statistics', ['title' => $this->title, 'careers' => $this->careers]);
    }
}
