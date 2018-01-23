<?php

namespace lbry;

class DaemonApi extends BaseApi
{
  const LBRY_SERVER_ADDRESS = 'http://localhost:5279';

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
    return static::makeRequest(static::LBRY_SERVER_ADDRESS, $method, $params);
  }

  /**
   * @deprecated
   */
  public static function api($method, array $params = [])
  {
    return static::call($method, $params);
  }
}
