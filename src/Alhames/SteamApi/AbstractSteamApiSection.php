<?php

namespace Alhames\SteamApi;

use Alhames\Api\HttpClient;

/**
 * Class AbstractSteamApiSection.
 */
abstract class AbstractSteamApiSection
{
    use SteamApiTrait;

    /**
     * AbstractSteamApiSection constructor.
     *
     * @param HttpClient $httpClient
     * @param string     $key
     * @param string     $locale
     */
    public function __construct(HttpClient $httpClient, string $key, ?string $locale)
    {
        $this->httpClient = $httpClient;
        $this->key = $key;
        $this->locale = $locale;
    }
}
