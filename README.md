# PHP-Url-Shortener
### Description:
This library for simple to take short url.
Usind Google Shortener API. 
#### Install this package with Composer
@todo add package to Composer after beta testing
#### How to use:
Edit file Config.php, add your GOOGLE-API-KEY
```php
<?php
     public static $apiKey = 'GOOGLE-API-KEY';
```
After:

```php
<?php
//include composer
require __DIR__ . '/vendor/autoload.php';
use Monster3D\Shortener\Short;

$result = Short::link('http://mylongurl.ru/');
print_r($result);
```
in the var: $result will be stdClass object.
```js
stdClass object
(
    [kind]    => urlshortener#url
    [id]      => https://goo.gl/VQ5T
    [longUrl] => http://mylongurl.ru/
)