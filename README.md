# PHP wrapper for [LBRY](https://github.com/lbryio/lbry) and [LBRYcrd](https://github.com/lbryio/lbrycrd) APIs

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
  $claims = lbry\DaemonApi::call('claim_list', ['name' => 'bellflower']);
  var_export($claims);
}
catch (lbry\Exception $e)
{
  echo $e->getMessage() . "\n";
}
```

## License

MIT