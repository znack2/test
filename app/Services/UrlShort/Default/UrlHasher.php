<?php 

namespace App\Services\UrlShort\Default;

class UrlHasher {
    /**
     * @var integer
     */
    protected $hash;
    /**
     * user send long or short get short or long
     *
     * @param $hash
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }
    /**
     * function convert string to hash
     *
     * @param $url
     * 
     * @return string
     */
    public function make($url)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        //version 2
        // return base_convert(rand(10000,99999), 10, 36);

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $this->hash);
    }
}
