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

use Alhames\Api\Authentication\AbstractOpenId2Client;
use Alhames\Api\Exception\AuthenticationException;
use PhpHelper\Str;

/**
 * Class SteamApiClient.
 *
 * @see http://api.steampowered.com/ISteamWebAPIUtil/GetSupportedAPIList/v0001/
 * @see http://steamwebapi.azurewebsites.net/
 * @see https://wiki.teamfortress.com/wiki/User:RJackson/StorefrontAPI
 * @see https://wiki.teamfortress.com/wiki/WebAPI
 *
 * @property Section\SteamUserApiSection      $steamUser
 * @property Section\SteamUserStatsApiSection $steamUserStats
 * @property Section\PlayerServiceApiSection  $playerService
 * @property Section\SteamAppsApiSection      $steamApps
 * @property Section\StoreApiSection          $store
 */
class SteamApiClient extends AbstractOpenId2Client
{
    use SteamApiTrait;

    /** @var AbstractSteamApiSection[] */
    protected $sections = [];

    /**
     * SteamApiClient constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->key = $config['key'] ?? null;
        $this->locale = $config['locale'] ?? null;
    }

    /**
     * @param string $name
     *
     * @return AbstractSteamApiSection
     */
    public function __get(string $name): AbstractSteamApiSection
    {
        $section = Str::convertCase($name, Str::CASE_CAMEL_UPPER);
        if (isset($this->sections[$section])) {
            return $this->sections[$section];
        }

        $class = 'Alhames\SteamApi\Section\\'.$section.'ApiSection';
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Section %s is not found.', $section));
        }

        return $this->sections[$section] = new $class($this->httpClient, $this->key, $this->locale);
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(array $options = []): array
    {
        $data = parent::authenticate($options);
        $identity = $data['openid.claimed_id'] ?? $data['openid.identity'] ?? null;
        if (empty($identity)) {
            throw new AuthenticationException($data, 'OpendID authentication is failed.');
        }

        if (!preg_match('#https?://steamcommunity.com/openid/id/(?<id>\d+)#i', $identity, $matches)) {
            throw new AuthenticationException($data, 'OpendID authentication is failed.');
        }

        $this->accountId = (int) $matches['id'];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthEndpoint(): string
    {
        return 'https://steamcommunity.com/openid/login';
    }
}
