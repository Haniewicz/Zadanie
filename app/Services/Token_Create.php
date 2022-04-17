<?php

namespace App\Services;

use Illuminate\Http\Request;

use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Token_Create
{
    public function handle($login, $system)
    {
        $config = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText($login.$system));
        $token = $config->builder()
            ->withHeader('login', $login)
            ->withHeader('system', $system)
            ->getToken(
                $config->signer(),
                $config->signingKey(),
            ); // Retrieves the generated token


        return $token;

        //return $token->toString();
    }
}
