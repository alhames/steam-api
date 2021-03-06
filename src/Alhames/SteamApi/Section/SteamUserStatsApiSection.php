<?php

/*
 * This file is part of the Steam API Interface package.
 *
 * (c) Pavel Logachev <alhames@mail.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alhames\SteamApi\Section;

use Alhames\SteamApi\AbstractSteamApiSection;

/**
 * Class SteamUserStatsApiSection.
 */
class SteamUserStatsApiSection extends AbstractSteamApiSection
{
    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetGlobalAchievementPercentagesForApp_.28v0002.29
     *
     * @param int $appId
     *
     * @return object
     */
    public function getGlobalAchievementPercentagesForApp(int $appId)
    {
        return $this->request('ISteamUserStats/GetGlobalAchievementPercentagesForApp/v2', ['gameid' => $appId]);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetGlobalStatsForGame_.28v0001.29
     *
     * @param int                     $appId
     * @param string[]                $names
     * @param \DateTimeInterface|null $startDate
     * @param \DateTimeInterface|null $endDate
     *
     * @return object
     */
    public function getGlobalStatsForGame(int $appId, array $names, ?\DateTimeInterface $startDate = null, ?\DateTimeInterface $endDate = null)
    {
        $query = ['appid' => $appId, 'count' => count($names), 'name' => $names];
        if (null !== $startDate) {
            $query['startdate'] = $startDate->getTimestamp();
        }
        if (null !== $endDate) {
            $query['enddate'] = $endDate->getTimestamp();
        }

        return $this->request('ISteamUserStats/GetGlobalStatsForGame/v1', $query);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerAchievements_.28v0001.29
     *
     * @param int $steamId
     * @param int $appId
     *
     * @return object
     */
    public function getPlayerAchievements(int $steamId, int $appId)
    {
        return $this->request('ISteamUserStats/GetPlayerAchievements/v1', ['steamid' => $steamId, 'appid' => $appId]);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetUserStatsForGame_.28v0002.29
     *
     * @param int $steamId
     * @param int $appId
     *
     * @return object
     */
    public function getUserStatsForGame(int $steamId, int $appId)
    {
        return $this->request('ISteamUserStats/GetUserStatsForGame/v2', ['steamid' => $steamId, 'appid' => $appId]);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetSchemaForGame_.28v2.29
     *
     * @param int $appId
     *
     * @return object
     */
    public function getSchemaForGame(int $appId)
    {
        return $this->request('ISteamUserStats/GetSchemaForGame/v2', ['appid' => $appId]);
    }

    /**
     * @param int $appId
     *
     * @return object
     */
    public function getNumberOfCurrentPlayers(int $appId)
    {
        return $this->request('ISteamUserStats/GetNumberOfCurrentPlayers/v1', ['appid' => $appId]);
    }
}
