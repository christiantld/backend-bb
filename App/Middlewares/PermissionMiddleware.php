<?php

namespace App\Middlewares;

use Psr\Http\Message\{
  ServerRequestInterface as Request,
  ResponseInterface as Response
};

final class PermissionMiddleware
{
  public function __invoke(Request $request, Response $response, callable $next): Response
  {
    $token = $request->getAttribute('jwt');
    $permission = $token['cargo'];
    $admin = 1;
    if ($permission !== $admin)
      return $response->withStatus(401);
    $response = $next($request, $response);
    return $response;
  }
}