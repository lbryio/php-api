<?php

namespace lbry;

use \lyoshenka\Curl;
use \lyoshenka\CurlException;

class BaseApi
{
  protected static $requestId = 0;

  /**
   * @param string $url       The url to connect to
   * @param string $method    The name of the command to call
   * @param array  $params    Parameters for the command
   * @param array  $basicAuth Credentials to connect to lbrycrd (as ["username","password"]
   *
   * @return array The result of the method call
   * @throws ConnectionException when connecting to the daemon fails
   * @throws ResponseException when the daemon returns an error or an invalid response
   */
  protected static function makeRequest($url, $method, array $params = [], array $basicAuth = [])
  {
    try
    {
      $response = Curl::post($url, [
        'id'      => ++static::$requestId,
        'jsonrpc' => '2.0',
        'method'  => $method,
        'params'  => $params,
      ], [
        'timeout'          => 600,
        'send_json_body'   => true,
        'follow_redirects' => true,
        'user_agent'       => 'LBRY php-api',
        'basic_auth'       => $basicAuth,
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
      throw new ConnectionException('Unable to connect (' . $e->getMessage() . ')');
    }
  }
}