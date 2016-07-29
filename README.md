# detect-environment
Detect an application's environment.

```php
use Jstewmc\DetectEnvironment\Detect;

// put an environment variable
putenv('environment=development');

// detect the environment (requires the variable's name)
$evironment = (new Detect('environment'))();

// get the environment name
$environment->getName();  // returns "development"

// check the environment
$environment->isDevelopment();  // returns true
$environment->isTesting();      // returns false
$environment->isStaging();      // returns false
$environment->isProduction();   // returns false
```

## Environment variable

In the example above, the environment variable was set using the `putenv()` function. However, in the real world, the environment variable should be defined somewhere in your server configuration (e.g., `.htaccess` or `httpd.conf`).

The environment variable's _name_ MAY be any string (e.g., `ENV`, `environment`, `APP_ENV`, etc). 

However, the environment variable's _value_ MUST be one of the following strings: 

1. `development`, 
2. `testing`, 
3. `staging`, or 
4. `production`.

That's it!

## Author

[Jack Clayton](mailto:jack@jahuty.com)

## Version

### 0.1.0, June 25, 2016

* Initial release (moved from Jahuty)
