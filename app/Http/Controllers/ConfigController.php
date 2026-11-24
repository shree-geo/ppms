<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        \Artisan::call('route:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
        \Artisan::call('storage:link');
        // \Artisan::call('migrate');
        dd('dd');
        
    }
}
