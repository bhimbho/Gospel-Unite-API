<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth2FAController extends Controller
{
    public function index(){
        $username = "Habeeb";
        $g = new \Google\Authenticator\GoogleAuthenticator();
        $salt = '7WAO342QFANY6IKBF7L7SWEUU79WL3VMT920VB5NQMW';
        $secret = $username.$salt;
        $auth_data = '<img src="'.$g->getURL($username, '', $secret).'" />';
        return view('administrator.settings.2fa')
        ->with('g',  $auth_data)
        ->with('security_code',  $secret);
    }
    public function test(){
       
    }
}
