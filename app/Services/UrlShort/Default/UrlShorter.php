<?php 

namespace App\Services\UrlShort\Default;

use App\Exceptions\NonExistentHashException;
use App\Services\UrlShort\UrlHasher;
use App\Services\UrlShort\UrlShortInterface;
use App\Services\UrlShort\UrlShortAbstract;

use App\Repositories\Url\UrlInterface;

/**
 * Class UrlShorter the default driver.
 *
 * @category Default Driver
 *
 */
class UrlShorter extends UrlShortAbstract implements UrlShortInterface
{
    /**
     * @var \App\Services\UrlShort\Default\urlHasher
     */
    protected $urlHasher;
    /**
     * @var \App\Repositories\Url\UrlInterface
     */
    protected $url;

    public function __construct(UrlInterface $url, UrlHasher $urlHasher) 
    {
        // must call the constructor of the abstracted class (the Client)
        parent::__construct();
        $this->url = $url;
        $this->urlHasher = $urlHasher;
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
        if ( ! $url) throw new NonExistentHashException;
        return $url->url;
    }
    /**
    * @param $url
    *
    * @return hash
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
    public function getResponse($response){
        return $response = $response->post(
            $this->apiURL.'?key='.$this->apiKey, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode(["shortUrl"=>link_to($newUrl)])
            ]
        );
    } 
}
