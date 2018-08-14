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
