<?php namespace App\Service\UrlShort;
/**
 * Interface ShortenInterface.
 */
interface UrlShortInterface {
    /**
     * Fetch link by hash
     *
     * @param $hash
     */
    public function getUrlByHash($hash);
    /**
     * Make hash
     *
     * @param  $url
     */
    public function makeHash($url);    
    /**
     * get Response 
     *
     * @param $response
     */
    public function getResponse($url);
}
