<?php

namespace Alhames\SteamApi\Section;

use Alhames\SteamApi\AbstractSteamApiSection;

/**
 * Class PlayerServiceApiSection.
 */
class PlayerServiceApiSection extends AbstractSteamApiSection
{
    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetOwnedGames_.28v0001.29
     *
     * @param int   $steamId
     * @param bool  $includeAppInfo
     * @param bool  $includePlayedFreeGames
     * @param array $appIds
     *
     * @return object
     */
    public function getOwnedGames(int $steamId, bool $includeAppInfo = false, bool $includePlayedFreeGames = false, array $appIds = [])
    {
        $query = [
            'steamid' => $steamId,
            'include_appinfo' => $includeAppInfo,
            'include_played_free_games' => $includePlayedFreeGames,
        ];
        if ($appIds) {
            $query['appids_filter'] = $appIds;
            $query = ['input_json' => \GuzzleHttp\json_encode($query)];
        }

        return $this->request('PlayerService/GetOwnedGames/v1', $query);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetRecentlyPlayedGames_.28v0001.29
     *
     * @param int      $steamId
     * @param int|null $count
     *
     * @return object
     */
    public function getRecentlyPlayedGames(int $steamId, int $count = null)
    {
        $query = ['steamid' => $steamId];
        if (null !== $count) {
            $query['count'] = $count;
        }

        return $this->request('PlayerService/GetRecentlyPlayedGames/v1', $query);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#IsPlayingSharedGame_.28v0001.29
     *
     * @param int $steamId
     * @param int $appId
     *
     * @return object
     */
    public function isPlayingSharedGame(int $steamId, int $appId)
    {
        return $this->request('PlayerService/IsPlayingSharedGame/v1', ['steamid' => $steamId, 'appid_playing' => $appId]);
    }

    /**
     * @param int $steamId
     *
     * @return object
     */
    public function getSteamLevel(int $steamId)
    {
        return $this->request('PlayerService/GetSteamLevel/v1', ['steamid' => $steamId]);
    }

    /**
     * @param int $steamId
     *
     * @return object
     */
    public function getBadges(int $steamId)
    {
        return $this->request('PlayerService/GetBadges/v1', ['steamid' => $steamId]);
    }

    /**
     * @param int $steamId
     * @param int $badgeId
     *
     * @return object
     */
    public function getCommunityBadgeProgress(int $steamId, int $badgeId)
    {
        return $this->request('PlayerService/GetCommunityBadgeProgress/v1', ['steamid' => $steamId, 'badgeid' => $badgeId]);
    }
}
