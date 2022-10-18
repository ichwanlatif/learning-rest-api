<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserModel;

function getJWT($authHeader)
{
    if(is_null($authHeader))
    {
        throw new Exception("Otentikasi JWT gagal");
    }
    return explode(" ", $authHeader)[1];
}

function validateJWT($encodeToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodeToken = JWT::decode($encodeToken, new Key($key, 'HS256'));

    $user = new UserModel();
    $user->validateUser($decodeToken->user_id);
}

function createdJWT($user_id)
{
    $timeRequest = time();
    $timeToken = getenv('JWT_TIME_TO_LIVE');
    $expiredToken = $timeRequest + $timeToken;
    $payload = [
        'user_id' => $user_id,
        'time_login' => $timeRequest,
        'expired_token' => $expiredToken,
    ];

    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');

    return $jwt;
}