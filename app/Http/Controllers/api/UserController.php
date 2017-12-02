<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Response;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\Client;
use Laravel\Passport\Token;

class UserController extends Controller {

    function __construct() {
        $this->content = array();
    }

    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();                        
            //$this->content['token'] = $user->clients();
            //$this->content['token'] = $user->createToken('app_uiatra')->accessToken;
//            $cli = new ClientRepository();
//            
//            $c = $cli->activeForUser($user->id)->first();
//            
//            
//            
//            $tkr = new TokenRepository();
//            
//            $tk = $tkr->getValidToken($user, $c);
            //$tk = $tkr->findValidToken($user, $c);
            
            
            
            //$this->content['client'] = $c;
            
           // $this->content['token'] = $tk;
            $this->content['usuario'] = $user;
            $this->content['logado'] = true;
            
            //$this->content['token'] = $user->createToken('app_uiatra')->token;
            $this->content['token'] = $user->createToken('app_uiatra')->accessToken;
            $status = 200;
        } else {
            $this->content['error'] = "Login não autorizado. E-mail ou senha informado inválido.";
            $status = 401;
        }
        return response()->json($this->content, $status);
    }

}
