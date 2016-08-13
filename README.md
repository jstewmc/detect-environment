# detect-environment
Detect an application's environment.

```php
use Jstewmc\DetectEnvironment\Detect;

// define our possible environments
$values = [
    'development' => 'foo',
    'testing'     => 'bar',
    'staging'     => 'baz',
    'production'  => 'qux'
];

// put the environment variable
putenv('APP_ENV=foo');

// instantiate the service
$service = new Detect('APP_ENV', $values);

// detect the environment
$environment->isDevelopment();  // returns true
$environment->isTesting();      // returns false
$environment->isStaging();      // returns false
$environment->isProduction();   // returns false
```

## Usage

To instantiate the service, you MUST pass the _environment variable name_ and the _environment variable values_, indexed by _application environment_ name:

```php
use Jstewmc\DetectEnvironment\Detect;

putenv('APP_ENV=foo');

$service = new Detect(
    'APP_ENV', 
    [
        'development' => 'foo',
        'testing'     => 'bar',
        'staging'     => 'baz',
        'production'  => 'qux'
    ]
);
```

In the example above, the service would detect the environment as _development_, _testing_, _staging_, and _production_ when the `APP_ENV` environment was `'foo'`, `'bar'`, `'baz'`, and `'qux'`, respectively.

Keep in mind, the _environment variable name_, the _environment variable values_, and the _application environment names_ MAY be any string. The _environment variable values_ and the _application environment names_ are case-insensitive.

You can check the application's environment using `isX()` methods, where `X` is any valid application environment name:

```php
use Jstewmc\DetectEnvironment\Detect;

putenv('APP_ENV=foo');

$service = new Detect(
    'APP_ENV', 
    [
        'development' => 'foo',
        'testing'     => 'bar',
        'staging'     => 'baz',
        'production'  => 'qux'
    ]
);

$service->isDevelopment();  // returns true
$service->isTesting();      // returns false
$service->isStaging();      // returns false
$service->isProduction();   // returns false
$service->foo();            // throws exception (MUST start with "is")
$service->isFoo();          // throws exception (MUST be valid environment name)
```

## Environment variable

In the examples above, the environment variable was set using the `putenv()` function. 

In the real world, you should define the environment variable in your server configuration (e.g., `.htaccess`, `httpd.conf`, etc). 

No matter where you define the environment variable, it MUST be accessible to PHP's [getenv](http://php.net/manual/en/function.getenv.php) function.

That's it!

## Author

[Jack Clayton](mailto:jack@jahuty.com)

## Version

### 0.2.0, August 13, 2016

* Refactor to support user-defined environments

### 0.1.0, June 25, 2016

* Initial release
