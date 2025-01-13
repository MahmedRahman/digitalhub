<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainLayout extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('layouts.main');
    }
}
