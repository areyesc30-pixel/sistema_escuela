<?php
namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        helper('url');
        return view('login');
    }
}