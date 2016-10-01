<?php
/**
 * This file is part of the UrlShortener package.
 *
 * (c) Nikolay Baev aka Monster3D <gametester3d@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Monster3D\Shortener;

use Monster3D\Shortener\Interfaces\DriverInterface;
use Monster3D\Shortener\Exceptions\DriverException;
use Monster3D\Shortener\Exceptions\ShortenerException;
use Monster3D\Shortener\RequestDriver;
use Monster3D\Shortener\Config;
use Monster3D\Shortener\Shortener;
use Monolog\Logger;


/**
 * @package         Short
 * @author          Nikolay Baev <gametester3d@gmail.com>
 * @copyright       Nikolay Baev <gametester3d@gmail.com>
 * @license         http://opensource.org/licenses/mit-license.php  The MIT License (MIT)
 * @link            https://github.com/Monster3D/php-url-shortenert
 */

class Short
{
    /**
    * Wrapper shortener url
    * 
    * @return \stdClass
    *
    */
   public static function link($url) 
   {
       $logger = new Logger(Config::$logName);
       Config::setLongUrl($url);
       try {
           $driver = new RequestDriver(Config::getOptions());
           $shortener = new Shortener($url);
           return $shortener->execute($driver);
       } catch (ShortenerException $e) {
           $logger->log('ERROR', $e->getMessage());
       } catch (DriverException $e) {
           $logger->log('ERROR', $e->getMessage());
       }

   }

}