<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $id;
    public $name;
    public $value;

    public function __construct($id, $name, $value = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.textarea');
    }
}
