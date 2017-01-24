# PHP wrapper for [LBRY](https://github.com/lbryio/lbry) API

## Installation

`composer require lbryio/php-api`

## Example

```
$daemon = new lbry\DaemonApi();
$claimsForOne = $daemon->api('claim_list', ['name' => 'one']);
```

## License

MIT