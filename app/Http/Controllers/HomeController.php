<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class HomeController
{
    public function index(): Factory|View|Application
    {
        return view('welcome');
    }
}
