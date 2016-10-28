<?php 

namespace App\Services\UrlShort\Google;

use App\Exceptions\GoogleHashException;
use App\Services\UrlShort\UrlShortInterface;
use App\Services\UrlShort\UrlShortAbstract;

/**
 * Class GoogleShorter the driver of the Gogle URL shortener provider.
 *
 * @category Google Driver
 *
 */
class GoogleShorter  extends UrlShortAbstract implements UrlShortInterface
{   
/**
     * google app access token collected from the config file.
     *
     * @var string
     */
    public $apiKey = $this->config->get('urlshort::google_api_key');

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
        if ( ! $url) throw new GoogleHashException;
        return $url->url;
    }
    /**
     * make shorted version.
     *
     * @param $url
     *
     * @return mixed
     */
    public function makeHash($url)
    {
        $hash = $this->urlHasher->make($url);
        event('link.creating', compact('url', 'hash'));
        $this->url->create($url);
        return $hash;
    }   
    /**
     * get response
     *
     * @param $url
     *
     * @return mixed
     */
    private function getResponse($response){
        return $response = $response->post(
            $this->apiURL.'?key='.$this->apiKey, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode(["shortUrl"=>link_to($newUrl)])
            ]
        );
    } 
}
