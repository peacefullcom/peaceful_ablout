<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class FrontEndController extends Controller
{

    
    function __construct()
    {

    }
    

    public function index()
    {
        return 'front_index';
    }

    
    
}