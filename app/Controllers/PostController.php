<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    // handle add new post ajax request

    public function add() {
        print_r($_POST);
        print_r($_FILES);
    }
}