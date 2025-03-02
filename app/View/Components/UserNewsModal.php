<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserNewsModal extends Component
{
    public $berita;
    public function __construct($berita)
    {
        $this->berita = $berita;
    }

    public function render(): View|Closure|string
    {
        return view('components.user-news-modal');
    }
}
