<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *    title="Your super TornsAulaApi",
 *    version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */
abstract class Controller
{
    //
}
