<?php 

namespace App\Services\UrlShort;

use Config;
/**
 * abstract class UrlShortAbstract.
 */
abstract class UrlShortAbstract()
{
	/**
	 * the response data format.
	 */
	const RESPONSE_FORMAT = 'json';
	/**
	 * @var url
	 */
    protected $url;
	/**
	 * the bitly API domain.
	 */
	protected $domain;
	/**
	 * bitly endpoint to shorten URL.
	 */
	protected $endpoint;
	/**
	 * @var Config
	 */
	protected $config;
	/**
	 * @param array  $parameters
	 * @param Object $httpClient
	 */
	public function __construct($parameters,$httpClient = null) 
	{
		$this->config = $config;
	    // set the HTTP client
	    if($httpClient || in_array($config->get('urlshort'), $httpClient))
	    {
	    	// Config
	    	$this->setClient($httpClient);
	    }
	    // read the configuration parameters and set them as attributes of this class
	    $this->setParameters($parameters);
	}
	/**
	 * Build the request parameters.
	 *
	 * @param $url
	 *
	 * @return array
	 */
	protected function parameters($url)
	{
	    return [
	        'apiKey' => $this->apiKey,
	        'format' => self::RESPONSE_FORMAT,
	        'url' => urlencode($url),
	    ];
	}
	/**
	 * set the attributes on the class after validating them.
	 *
	 * @param $parameters
	 */
	private function setParameters($parameters)
	{
	    $this->domain = $this->validateConfiguration($parameters['domain']);
	    $this->endpoint = $this->validateConfiguration($parameters['endpoint']);
	    $this->apiKey = $this->validateConfiguration($parameters['token']);
	}
	/**
	 * Fetch a url by hash
	 *
	 * @param $hash
	 *
	 * @return mixed
	 * @throws App\Exceptions\NonExistentHashException
	 */
	public function check($urlRequest)
	//$url, $parameters = [], $json_formatted = true, $verb = 'get'
	{
	    $link = $this->url->byUrl($urlRequest['url']);
	    $response = $link 
	     ? $this->getUrlByHash($urlRequest['hash'])
	     : $this->makeHash($urlRequest['url']);
	     return $this->getResponse($response);
	}
}