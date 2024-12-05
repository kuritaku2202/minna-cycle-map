<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function home(){

        // .envのAPIキーを変数へ
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.home')->with(['google_map_api_key' => $google_map_api_key]);

    }
}
