<?php

/*
 * This file is part of the Steam API Interface package.
 *
 * (c) Pavel Logachev <alhames@mail.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alhames\SteamApi;

use Alhames\Api\Exception\ApiExceptionInterface;
use Alhames\Api\HttpClient;
use Alhames\Api\HttpInterface;
use GuzzleHttp\Exception\GuzzleException;

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
     * @throws ApiExceptionInterface
     * @throws GuzzleException
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

        return $this->httpClient->requestJson($httpMethod, $this->getApiEndpoint($method), $query);
    }

    /**
     * @param string $method
     *
     * @return string
     */
    protected function getApiEndpoint(string $method): string
    {
        return sprintf('http://api.steampowered.com/%s/', trim($method, '/'));
    }
}
