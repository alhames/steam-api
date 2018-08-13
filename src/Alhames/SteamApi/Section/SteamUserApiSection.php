<?php

namespace Alhames\SteamApi\Section;

use Alhames\SteamApi\AbstractSteamApiSection;

/**
 * Class SteamUserApiSection.
 */
class SteamUserApiSection extends AbstractSteamApiSection
{
    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0002.29
     *
     * @param int[] $steamIds
     *
     * @return object
     */
    public function getPlayerSummaries(array $steamIds)
    {
        return $this->request('ISteamUser/GetPlayerSummaries/v2', ['steamids' => implode(',', $steamIds)]);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetFriendList_.28v0001.29
     *
     * @param int         $steamId
     * @param string|null $relationship
     *
     * @return object
     */
    public function getFriendList(int $steamId, ?string $relationship = null)
    {
        $query = ['steamid' => $steamId];
        if (null !== $relationship) {
            $query['relationship'] = $relationship;
        }

        return $this->request('ISteamUser/GetFriendList/v1', $query);
    }

    /**
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerBans_.28v1.29
     *
     * @param int[] $steamIds
     *
     * @return object
     */
    public function getPlayerBans(array $steamIds)
    {
        return $this->request('ISteamUser/GetPlayerBans/v1', ['steamids' => implode(',', $steamIds)]);
    }

    /**
     * @param int $steamId
     *
     * @return object
     */
    public function getUserGroupList(int $steamId)
    {
        return $this->request('ISteamUser/GetUserGroupList/v1', ['steamid' => $steamId]);
    }
}
