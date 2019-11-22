<?php

namespace App\Middlewares;

use Psr\Http\Message\{
  ServerRequestInterface as Request,
  ResponseInterface as Response
};
use App\DAO\TokensDAO;
use App\Models\TokenModel;

final class JwtDateTimeMiddleware
{
  public function __invoke(Request $request, Response $response, callable $next): Response
  {
    $token = $request->getAttribute('jwt');
    $expireDate = new \DateTime($token['expire_at']);
    $now = new \DateTime();
    if ($expireDate < $now) {
      $tokenDAO = new TokensDAO();
      $tokenDAO->inactiveToken($token['token']);
      return $response->withStatus(401);
    }
    $response = $next($request, $response);
    return $response;
  }
}