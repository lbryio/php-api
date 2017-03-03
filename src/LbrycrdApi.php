<?php

namespace lbry;

class LbrycrdApi extends BaseApi
{
  const LBRY_SERVER_ADDRESS = 'http://localhost:9245';

  /**
   * @param string $method    The name of the command to call
   * @param array  $params    Parameters for the command
   * @param array  $basicAuth Credentials to connect to lbrycrd (as ["username","password"]
   *
   * @return array The result of the method call
   */
  public static function call($method, array $params = [], array $basicAuth = [])
  {
    return static::makeRequest(static::LBRY_SERVER_ADDRESS, $method, $params, $basicAuth);
  }
}
