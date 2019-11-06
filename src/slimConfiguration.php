<?php

namespace src;

function slimConfiguration(): \Slim\Container
{
  //System error handler
  $configuration = [
    'settings' => [
      'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
    ],
  ];
  return new \Slim\Container($configuration);
}