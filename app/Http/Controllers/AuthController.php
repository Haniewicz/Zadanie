<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use External\Bar\Auth\LoginService;
use External\Baz\Auth\Authenticator;
use External\Foo\Auth\AuthWS;

use App\Services\Token_Create;
use App\Services\CheckSystem;


class AuthController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request, LoginService $loginService, Authenticator $authenticator, AuthWS $authWS, Token_Create $token_Create, CheckSystem $checkSystem): JsonResponse
    {
        // TODO

        $data = $request->all();




        $system = $checkSystem->handle($data['login'], $data['password'], $loginService, $authenticator, $authWS);

        return response()->json([$system]);

        if($system == true){
            return response()->json([
                'status' => 'success',
                'token' => $token_Create->handle($data['login'], 'BAR')->toString(),
            ]);
        }

        return response()->json([
            'status' => 'failure',
        ]);
    }
}
