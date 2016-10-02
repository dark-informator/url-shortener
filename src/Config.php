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

/**
 * @package         Config
 * @author          Nikolay Baev <gametester3d@gmail.com>
 * @copyright       Nikolay Baev <gametester3d@gmail.com>
 * @license         http://opensource.org/licenses/mit-license.php  The MIT License (MIT)
 * @link            https://github.com/Monster3D/php-url-shortenert
 */

 class Config  
 {
     /**
     * Temp long url before shortind
     * 
     * @var string
     *
     */
     private static $longUrl;
     
     /**
     *
     * Google service url
     *
     * @var string
     * 
     */
     public static $url = 'https://www.googleapis.com/';
     
     /**
     * Google API Key
     *
     * @var string
     * 
     */
     
     public static $apiKey;
     /**
     * File log name
     *
     * @var string
     *
     */
     public static $logName = 'ShortenerLog';
     
     /**
     * Get curl base settings
     *
     * @depending setLongUrl
     *
     * @return array
     *
     */
     public static function getOptions()
     {          
         return [
                    CURLOPT_URL => self::$url . 'urlshortener/v1/url?key=' . self::$apiKey,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HEADER         => false,
                    CURLOPT_HTTPHEADER     => ['Content-type:application/json'],
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => json_encode(['longUrl' => self::$longUrl])
        ];
     }

     /**
     * Set long url before init settings curl driver 
     *
     * @var string
     *
     */
     public static function setLongUrl($longUrl)
     {
         self::$longUrl = $longUrl;
     }

     /**
     * Set Google API KEY
     *
     * @param string
     *
     */
     public static function setApiKey($key)
     {
         self::$apiKey = $key;
     }
 } 