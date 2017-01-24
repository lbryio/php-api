# PHP wrapper for [LBRY](https://github.com/lbryio/lbry) API

## Installation

```
composer require lbryio/php-api
```

## Example

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

try
{
  $daemon = new lbry\DaemonApi();
  $claims = $daemon->api('claim_list', ['name' => 'bellflower']);
  var_export($claims);
}
catch (lbry\DaemonException $e)
{
  echo $e->getMessage() . "\n";
}
```

## License

MIT