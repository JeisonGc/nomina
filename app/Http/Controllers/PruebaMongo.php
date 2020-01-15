<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PruebaMongo extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $post = new Post();

        $post->title = "title2";
        $post->description = "mensaje2";
        $post->prueba = "prueba";
        $post->numero_field = 12;
        $post->field = true;

        $post->save();
    }
}
