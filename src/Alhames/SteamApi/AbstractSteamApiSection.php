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
