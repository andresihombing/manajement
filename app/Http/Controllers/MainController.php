<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function dashboard(){

        $role = auth()->user()->role;
        if($role == 1){ 
            return redirect('/dash');
        }else if($role == 2){
            return redirect('/dash');
        }
    }

    public function logout()
    {
    	\Auth::logout();

    	return redirect('login');
    }
}
