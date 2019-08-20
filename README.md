# PHPinnacle ULID

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

Pure PHP [ulid](https://github.com/ulid/spec) implementation with binary encoding support.

## Install

Via Composer

```bash
$ composer require phpinnacle/ulid
```

## Basic Usage

```php
<?php

use PHPinnacle\Ulid\Generator;

echo Generator::now();
echo Generator::fromDateTime(new \DateTimeImmutable('2019-01-22 23:33:45'));
echo Generator::fromTimestamp(1566310070);

```

## Testing

```bash
$ composer test
```

## Benchmarks

We run benchmarks as follow:

```bash
$ composer bench
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email dev@phpinnacle.com instead of using the issue tracker.

## Credits

- [PHPinnacle][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpinnacle/ulid.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpinnacle/ulid.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpinnacle/ulid
[link-downloads]: https://packagist.org/packages/phpinnacle/ulid
[link-author]: https://github.com/phpinnacle
[link-contributors]: ../../contributors
