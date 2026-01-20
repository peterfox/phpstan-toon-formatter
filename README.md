# A TOON output formatter for PHPStan

[![Latest Version on Packagist](https://img.shields.io/packagist/v/peterfox/phpstan-toon-formatter.svg?style=flat-square)](https://packagist.org/packages/peterfox/phpstan-toon-formatter)
[![Tests](https://img.shields.io/github/actions/workflow/status/peterfox/phpstan-toon-formatter/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/peterfox/phpstan-toon-formatter/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/peterfox/phpstan-toon-formatter.svg?style=flat-square)](https://packagist.org/packages/peterfox/phpstan-toon-formatter)

A PHPStan error formatter that outputs errors in the [TOON](https://github.com/helgesverre/toon) (Typed Object-Oriented Notation) format.

The purpose of this package is to make it easier to integrate PHPStan into your CI pipeline and reduce the amount of tokens spent
when working with AI agents.

## Installation

You can install the package via composer:

```bash
composer require peterfox/phpstan-toon-formatter --dev
```

If you have `phpstan/extension-installer` installed, you're all set! The formatter will be automatically registered.

If you don't use the extension installer, you can manually include the configuration in your `phpstan.neon` or `phpstan.neon.dist` file:

```neon
includes:
    - vendor/peterfox/phpstan-toon-formatter/extension.neon
```

## Usage

To use the TOON formatter, run PHPStan with the `--error-format=toon` option:

```bash
vendor/bin/phpstan analyse --error-format=toon
```

## Testing

If you want to further develop this package, please refer to the [CONTRIBUTING](https://github.com/peterfox/phpstan-toon-formatter/blob/main/CONTRIBUTING.md) guide.

Tests can be run using:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Peter Fox](https://github.com/peterfox)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
