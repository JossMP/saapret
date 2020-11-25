<?php

namespace App\Http\Livewire\Book;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $image_cover = null;
    public $name = null;

    public function updatedPhoto()
    {
        $this->validate(
            [
                'image_cover' => 'image|max:1024', // 1MB Max
            ],
            [
                'image_cover.image' => 'Solo puede subir imagenes',
                'image_cover.max'   => 'El tamaño maximo es de 1MB',
            ]
        );
    }

    public function render()
    {
        return view('livewire.book.create');
    }

    public function save()
    {
        /* $this->validate([
            'image_cover' => 'image|max:1024', // 1MB Max
        ]); */
        $this->updatedPhoto();
        //$this->name = md5($this->image_cover . microtime()) . '.' . $this->image_cover->extension();
        $this->image_cover->store('photos');
    }
}
