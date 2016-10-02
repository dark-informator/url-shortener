# PHP-Url-Shortener
### Description:
This library for simple to take short url.
Usind Google Shortener API. 
#### Install this package with Composer
Require this package with Composer.
```js
composer require monster3d/php-url-shortener
```
Or add your dependencies to composer.json file
```js
"require": {
    "monster3d/php-url-shortener": "*"
    }
```
#### How to use:
```php
<?php
//include composer
require __DIR__ . '/vendor/autoload.php';
use Monster3D\Shortener\Short;

//Set google api key
Short::setGoogleAPIKey('YOUR-GOOGLE-API-KEY');
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