<?php

namespace App\View\Components\Backend\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $slug = null;

    public function __construct($slug = null)
    {
        $this->slug = $slug;
    }
    public function render(): View|Closure|string
    {
        return view('backend.admin.layouts.partials.header');
    }
}
