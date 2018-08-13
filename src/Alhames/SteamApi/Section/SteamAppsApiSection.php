<?php

namespace Alhames\SteamApi\Section;

use Alhames\SteamApi\AbstractSteamApiSection;

/**
 * Class SteamAppsApiSection.
 */
class SteamAppsApiSection extends AbstractSteamApiSection
{
    /**
     * @see https://wiki.teamfortress.com/wiki/WebAPI/GetAppList
     *
     * @return object
     */
    public function getAppList()
    {
        return $this->request('ISteamApps/GetAppList/v2');
    }
}
