<?php

namespace lbry;

use \lyoshenka\Curl;
use \lyoshenka\CurlException;

class DaemonApi
{
  const LBRY_SERVER_ADDRESS = 'http://localhost:5279/lbryapi';

  protected static $requestId = 0;

  public static function api($method, array $params = [])
  {
    try
    {
      $response = Curl::post(static::LBRY_SERVER_ADDRESS, [
        'id'      => ++static::$requestId,
        'jsonrpc' => '2.0',
        'method'  => $method,
        'params'  => $params ? [$params] : []
      ], [
        'timeout'          => 600,
        'send_json_body'   => true,
        'follow_redirects' => true,
        'user_agent'       => 'LBRY php-api',
      ]);

      return $response->getJson() ?: [];
    }
    catch (CurlException $e)
    {
      throw new DaemonException(
        'Unable to connect to LBRY daemon at ' . static::LBRYNET_SERVER_ADDR . "\n" .
        'Error: ' . $e->getMessage());
    }
  }
}
