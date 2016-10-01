<?php
/**
 * Created by PhpStorm.
 * User: monster3d
 * Date: 10/23/15
 * Time: 12:14 PM
 */

class URLShortener {

    private static $instance;

    protected function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new URLShortenerAPI();
        }
        return self::$instance;
    }
}


class URLShortenerAPI
{
    /**
     * @var $errorMessage
     */
    private $errorMessage;
    /**
     * @var array Curl setting array
     */
    private $arraySetting = [];
    /*
     * @var $longUrl
     */
    public $longUrl;
    /**
     * @var $shortUrl
     */
    public $shortUrl;
    /**
     * @var string google api key for URL Shortener service
     */
    private $googleApiKey = '';
    /**
     * @var mixed $curl
     */
    public $curl;
    /**
     * this void construct
     */
    public function __construct()
    {

    }
    /**
     * this function set method and link - url to array configuration api
     * @param array|null $autoSettings give to method string data 'short' or 'long' and link
     * @param array|null $customSettings if give custom array setting
     * @return array $settings curl
     * @throws Exception
     */
    public function setApiSettings(array $autoSettings = null, array $customSettings = null)
    {
        if ($autoSettings === null && $customSettings === null) {
            throw new Exception('Not transferred to the processing method links');
        }

        if (is_array($customSettings)) {
            foreach ($customSettings as $curlOptions => $value) {
                $this->arraySetting[strtoupper($curlOptions)] = $value;
            }
            return (array)$this->arraySetting;
        }
            switch($autoSettings['method'])
            {
                case 'short':
                    $this->arraySetting = [
                        CURLOPT_URL            => 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->googleApiKey,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_HEADER         => false,
                        CURLOPT_HTTPHEADER     => ['Content-type:application/json'],
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => json_encode(['longUrl' => $autoSettings['url']])
            ];
                    break;
                case 'long':
                    $this->arraySetting = [
                        CURLOPT_URL            => 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->googleApiKey,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_HEADER         => false,
                        CURLOPT_HTTPHEADER     => ['Content-type:application/json']
                    ];
                    break;
                default :
                    throw new Exception('Not support method');
            }
        return true;
    }
    /**
     * functions get the link, which depends on the settings
     * @return object json data
     * @throws Exception
     */
    public function getUrl()
    {
       if ($this->curl === null) {
           throw new Exception('curl not initialize');
       }

        $curlResult = curl_exec($this->curl);

        if ($curlResult === false) {
            throw new Exception(curl_error($this->curl));
        }
        curl_close($this->curl);
        return json_decode($curlResult);
    }

    /**
     * function initialize object curl
     * @return void
     * @throws Exception
     */
    public function curlInit()
    {
        if(!is_array($this->arraySetting || count($this->arraySetting) === 0)) {
            throw new Exception('Curl setting not init');
        }
        $curl = curl_init();
        curl_setopt_array($curl, $this->arraySetting);
        $this->curl = $curl;
    }
    /**
     * function set api key for work API
     * @param $key
     * @return void
     *
     */
    public function setApiKey($key)
    {
        $this->googleApiKey = (string)$key;
    }

    /**
     * function get error message
     * @param void
     * @return string
     */

    public function getErrorMessage()
    {
        return (string)$this->errorMessage;
    }
    /**
     * this function do set error message
     * @param $eMsg string error message
     * @return void
     */
    private function setError($eMsg)
    {
        $this->errorMessage = $eMsg;
    }

}