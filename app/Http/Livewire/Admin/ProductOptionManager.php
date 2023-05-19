<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Product\Models\Options;

class ProductOptionManager extends Component
{
    public $product;
    public $option;
    public $showCreateModal = false;
    public function render()
    {
        return view('livewire.admin.product-option-manager');
    }
    public function create()
    {
        $this->option = new Options();
        $this->showCreateModal = true;
    }
}
