<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    private static string $secretKey = 'freshora_secret_key_2024';
    private static string $algorithm  = 'HS256';

    public static function generateToken(array $payload): string
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + (60 * 60 * 24 * 7); // 7 hari
        return JWT::encode($payload, self::$secretKey, self::$algorithm);
    }

    public static function validateToken(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key(self::$secretKey, self::$algorithm));
        } catch (\Exception $e) {
            return null;
        }
    }
}