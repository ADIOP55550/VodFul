<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUndoForm(string $route, string $text = "undo", string $method = 'post')
    {
        return '<form method="'
            . (strtolower($method) == 'get' || strtolower($method) == 'post' ? $method : 'post')
            . '" action="' . $route . '">'
            . csrf_field()
            . method_field($method)
            . '<button type="submit" class="uk-button uk-button-secondary uk-button-small uk-margin-small-top uk-margin-auto">'
            . $text
            . '</button></form>';
    }
}
