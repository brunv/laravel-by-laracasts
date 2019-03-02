<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Config\Repository;

class WelcomeController extends Controller
{
    // protected $config;

    // public function __construct(Repository $config)
    // {
    //     $this->config = $config;
    // }
    
    public function test()
    {
        // construtor injection
        // return $this->config->get('database.default');

        // method injection
        // public function test(Repository $config)
        // pode remover o método construct e a variável protected

        // facade
        // return \Config::get('database.default');

        // config helper function
        return config('database.default');
    }
}
