<?php

namespace lbry;

use \lyoshenka\Curl;
use \lyoshenka\CurlException;

class DaemonApi
{
  const LBRY_SERVER_ADDRESS = 'http://localhost:5279/lbryapi';

  protected static $requestId = 0;

  /**
   * @param string $method The name of the command to call
   * @param array  $params Parameters for the command
   *
   * @return array The result of the method call
   * @throws ConnectionException when connecting to the daemon fails
   * @throws ResponseException when the daemon returns an error or an invalid response
   */
  public static function call($method, array $params = [])
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

      $json = $response->getJson();

      if ($json)
      {
        if (array_key_exists('result', $json))
        {
          return $json['result'];
        }

        if (array_key_exists('error', $json))
        {
          throw new ResponseException($json['error']['message'], $json['error']['code']);
        }
      }

      throw new ResponseException('Invalid API response');
    }
    catch (CurlException $e)
    {
      throw new ConnectionException('Unable to connect to LBRY daemon ('. $e->getMessage() . ')');
    }
  }

  /**
   * @deprecated
   */
  public static function api($method, array $params = [])
  {
    return static::call($method, $params);
  }
}
