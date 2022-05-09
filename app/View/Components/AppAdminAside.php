<?php

namespace App\View\Components;

use App\Models\Contribution;
use Illuminate\View\Component;

class AppAdminAside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $contributions;
    public function __construct()
    {
        $this->contributions = Contribution::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.component.aside');
    }
}
