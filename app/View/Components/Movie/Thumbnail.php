<?php

namespace App\View\Components\Movie;

use App\Models\Movie;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Boolean;

class Thumbnail extends Component
{

    /**
     * @var Movie|null
     */
    public ?Movie $movie;

    /**
     * @var bool
     */
    public ?bool $overlay;

    /**
     * Create a new component instance.
     *
     * @param Movie|null $movie
     * @return void
     */
    public function __construct(Movie $movie = null, bool $overlay = true)
    {
        $this->overlay = $overlay;
        $this->movie = $movie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public
    function render()
    {
        return view('components.movie.thumbnail');
    }
}
