<?php

namespace App\Http\Controller;

use App\Exceptions\Exception;
use App\MissingConfigurationException;


use App\Http\Controllers\Controller;
use App\Services\UrlShort\UrlShortInterface;

class UrlShortController extends Controller 
{
	/**
	 * @var integer
	 */
	public $url;
	/**
	 * @var App\Services\Url\UrlShorter
	 */
    protected $urlService;
    /**
     * get new instance 
     *
     * @var App\Repositories\Url\UrlInterface
     * @var App\Services\Url\UrlShorter
     * 
     */
	public function __construct(UrlInterface $url,UrlShortInterface $urlService){
		$this->url = $url;
		$this->urlService = $urlService;
	}
	/**
	 * user send long link
	 *
	 * @var App\Http\Request\UrlRequest
	 * @param $service
	 * @param $format
	 * 
	 * @return Response
	 */
	public function postUrl(UrlRequest $request,$service = null,$format = null)
	{
		//get url
		$url = $request->only('url');
		return $this->convert($url,$service,$format);
	}
	/**
	 * user send short link
	 *
	 * @var App\Http\Request\UrlRequest
	 * @param $service
	 * @param $format
	 * 
	 * @return Response
	 */
	public function getHash(UrlRequest $request,$service = null,$format = null)
	{
		//get hash
		$hash = $request->only('hash');
		return $this->convert($hash,$service,$format);
	}
	/**
	 * user send long or short get short or long
	 *
	 * @var App\Http\Request\UrlRequest
	 * @param $service
	 * @param $format
	 * 
	 * @return Response
	 */
	private function convert($urlRequest,$service = null, $format = 'xml')//json
	{
		try
		{
		    $newUrl = $this->urlService->make($urlRequest,$service);
		    return $this->getFormat($newUrl,$format);
		}
		catch ( Exception $e )
		{
			if ($e instanceof DriverException) {
				$message = 'problem with driver';
			} 
			else if($e instanceof MissingConfigurationException){
				$message = 'problem with config file';
			}
			else {
			    $message = 'could not find your desired URL';
			}
		    return $response->link_to($newUrl)
				->header('Content-Type', 'application/json')
				->with('flash.message', 'Sorry ,'.$message);
		}
	}
	/**
	 * user send long or short get short or long
	 *
	 * @param $newUrl
	 * @param $format
	 * 
	 * @return string
	 */
	private function getFormat($newUrl, $format)
	{
		if(strtolower($format) == 'json')
		{
			$json = @json_decode($newUrl,true);
			// $response->body()
			return $json['results'][$url]['shortUrl'];
			//return $response->link_to($newUrl);->header('Content-Type', 'application/json')
		}
		else //xml
		{
			$xml = simplexml_load_string($response);
			return $xml->results->nodeKeyVal->hash;
		}
	}
}

