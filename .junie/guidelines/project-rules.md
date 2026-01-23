### Project Guidelines

#### Testing
- All changes must be accompanied by appropriate tests.
- Existing tests must pass after any modifications.
- You can run the tests using:
  ```bash
  composer test
  ```
  or
  ```bash
  vendor/bin/phpunit
  ```

#### Static Analysis (PHPStan)
- All changes must pass PHPStan analysis.
- The project uses PHPStan at level 6 (as defined in `phpstan.neon.dist`).
- You can run PHPStan using:
  ```bash
  vendor/bin/phpstan analyze --error-format=toon
  ```

#### Code Formatting
- Ensure code follows the project's formatting standards.
- You can format the code using:
  ```bash
  ./vendor/bin/php-cs-fixer fix -nq --format=json
  ```
