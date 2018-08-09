<?php

namespace Alhames\SteamApi;

use Alhames\Api\HttpClient;
use Alhames\Api\HttpInterface;

/**
 * Trait SteamApiTrait.
 */
trait SteamApiTrait
{
    /** @var HttpClient */
    protected $httpClient;
    /** @var string */
    protected $key;
    /** @var string */
    protected $locale;

    /**
     * @param string $method
     * @param array  $query
     * @param string $httpMethod
     *
     * @return mixed
     */
    public function request(string $method, array $query = [], string $httpMethod = HttpInterface::METHOD_GET)
    {
        $query['format'] = 'json';
        if (null !== $this->key) {
            $query['key'] = $this->key;
        }
        if (null !== $this->locale) {
            $query['l'] = $this->locale;
        }

        return $this->httpClient->requestJson($httpMethod, $this->getApiUri($method), $query);
    }

    /**
     * @param string $method
     *
     * @return string
     */
    protected function getApiUri(string $method): string
    {
        return sprintf('http://api.steampowered.com/%s/', trim($method, '/'));
    }
}
