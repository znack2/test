<?php namespace App\Repositories\Url;

use App\Url;
use App\Repositories\Url\UrlInterface;

class UrlRepository implements UrlInterface {

    protected $url;
    
    public function __construct( Url $url)
    {
        $this->url = $url;
    }
    /**
     * Create new link in db
     *
     * @param array $data
     *
     * @return mixed
     */

    public function create(array $data)
    {
        return $this->url->create($data);

    }
    /**
     * Fetch link by hash
     *
     * @param $hash
     *
     * @return mixed
     */
    public function byHash($hash)
    {
        return $this->url->whereHash($hash)->first();
    }
    /**
     * Fetch link by url
     *
     * @param $url
     *
     * @return mixed
     */
    public function byUrl($url)
    {
        return $this->url->whereUrl($url)->first();
    }
}
