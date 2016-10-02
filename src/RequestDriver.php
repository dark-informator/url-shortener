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
use Monster3D\Shortener\Config;

/**
 * @package         RequestDriver
 * @author          Nikolay Baev <gametester3d@gmail.com>
 * @copyright       Nikolay Baev <gametester3d@gmail.com>
 * @license         http://opensource.org/licenses/mit-license.php  The MIT License (MIT)
 * @link            https://github.com/Monster3D/php-url-shortenert
 */

class RequestDriver implements DriverInterface 
{
    
    /**
    * Inited request driver
    *
    * @var object
    *
    */
    private $driver;
    
    /**
    * @param array
    *
    */
    public function __construct($setting)
    {
        $this->init($setting);
    }

    /**
    * Clear stack memory 
    *
    */
    public function __destruct()
    {
        curl_close($this->driver);
        unset($this->driver);
    }

    /**
    * Initialization request driver
    *
    * @param array
    * 
    * @throw Monster3D\Shortener\Exceptions\DriverException
    *
    */
    public function init($setting)
    {
        if (!function_exists('curl_init')) {
            throw new DriverException('Ext. curl not instaled');
        }

        $curl = curl_init();
        curl_setopt_array($curl, $setting);
        $this->driver = $curl;
    }

    /**
    * Get current inited driver
    * 
    * @return object
    *
    */
    public function getDriver()
    {
        return $this->driver;
    }

     /**
     * Execute prepare driver
     *
     * @return \stdClass
     *
     * @throw Monster3D\Shortener\Exceptions\Driver\Exception
     */
    public function execute()
    {
        $result = curl_exec($this->driver);
        if ($result === false) {
            throw new DriverException('Curl exec error: ' . "\r\n" . 
                'Code: ' . curl_errno($this->driver) . "\n\r" . 'Message: ' . curl_error($this->driver));
        }
        return json_decode($result);
    }
}