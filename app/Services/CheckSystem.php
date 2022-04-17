<?php

namespace App\Services;

use Illuminate\Http\Request;



class CheckSystem
{
    public function handle($login, $password, $loginService, $authenticator, $authWS)
    {

        if($loginService->login($login, $password)){
            return "BAR";
        }

        try{
            $authWS->authenticate($login, $password);
            return "FOO";
        }catch(\Exception|\Throwable $ex){
        }

        if( preg_match("/^BAZ_.*/", $login, $matches)){
            if($authenticator->auth($login, $password)){
                return "BAZ";
            }
        }


        return false;

    }
}
