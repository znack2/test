<?php

namespace App\Services\UrlShort\Bitly;

use App\Exceptions\BitlyHashException;
use App\Services\UrlShort\UrlShortInterface;
use App\Services\UrlShort\UrlShortAbstract;

/**
 * Class BitlyShorter the driver of the Bitly URL shortener provider.
 *
 * @category Bitly Driver
 *
 */
class BitlyShorter extends UrlShortAbstract implements UrlShortInterface
{
    /**
     * bitly app access token collected from the config file.
     *
     * @var string
     */
    public $apiKey = $this->config->get('urlshort::bitly_api_key');

    public function __construct($parameters, $httpClient = null)
    {
        // must call the constructor of the abstracted class (the Client)
        parent::__construct();
    }
    /**
     * Fetch a url by hash
     *
     * @param $hash
     *
     * @return mixed
     * @throws App\Exceptions\NonExistentHashException
     */
    public function getUrlByHash($hash)
    {
        $url = $this->url->byHash($hash);
        if ( ! $url) throw new BitlyHashException;
        return $url->url;
    }
    /**
     * make shorten version
     *
     * @param $url
     *
     * @return mixed
     */
    public function makeHash($url)
    {
        // make the API call through the extended client
        $response = $this->fetchUrl($this->url(), $this->parameters($url));

        // read the shorted url from the response object
        $shorter_url = $this->parse($response);

        return $shorter_url;
    }
    /**
     * get a response object and return the short URL form the result.
     *
     * @param $response_object
     *
     * @return mixed
     * @throws App\Exceptions\ResponseErrorException
     */
    public function getResponse(){
        // 'http://bit.ly/'.

        // //create the URL
        // $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$this->login.'&apiKey='.$this->appkey.'&format='.$format;

        // //get the url //could also use cURL here
        // return file_get_contents($bitly);

        // will throw an exception if not valid
        $this->validateResponseCode($response_object->status_code);

        // return only the short generated url
        return $response_object->data->url;

        return $response = $response->post(
            $this->apiURL.'?key='.$this->apiKey, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode(["shortUrl"=>link_to($newUrl)])
            ]
        );
    }
    /**
     * get the bitly shorten URL.
     *
     * @return string
     */
    private function url()
    {
        return $this->domain.$this->endpoint;
    }

}
