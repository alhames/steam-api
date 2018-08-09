<?php

namespace Alhames\SteamApi\Section;

use Alhames\SteamApi\AbstractSteamApiSection;

/**
 * Class StoreApiSection.
 */
class StoreApiSection extends AbstractSteamApiSection
{
    /**
     * @see https://wiki.teamfortress.com/wiki/User:RJackson/StorefrontAPI#appdetails
     *
     * @param array       $appIds
     * @param array       $filters
     * @param null|string $currencyCountry
     *
     * @return object
     */
    public function appDetails(array $appIds, array $filters = [], ?string $currencyCountry = null)
    {
        $query = ['appids' => implode(',', $appIds)];
        if ($filters) {
            $query['filters'] = implode(',', $filters);
        }
        if (null !== $currencyCountry) {
            $query['cc'] = $currencyCountry;
        }

        return $this->request('appdetails', $query);
    }

    /**
     * {@inheritdoc}
     */
    protected function getApiUri(string $method): string
    {
        return 'https://store.steampowered.com/api/'.$method.'/';
    }
}
