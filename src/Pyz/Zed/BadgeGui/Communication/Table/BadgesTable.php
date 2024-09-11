<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\BadgeGui\Communication\Table;

use Orm\Zed\Badge\Persistence\Map\PyzBadgeTableMap;
use Orm\Zed\Badge\Persistence\PyzBadgeQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAttributeKeyTableMap;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class BadgesTable extends AbstractTable
{
    public const COL_NAME = SpyProductAttributeKeyTableMap::COL_KEY;

    /**
     * @var string
     */
    public const COL_TITLE = 'title';

    /**
     * @var string
     */
    public const COL_IMAGE_URL = 'imageUrl';

    /**
     * @var string
     */
    public const COL_DATE_FROM = 'dateFrom';

    /**
     * @var string
     */
    public const COL_DATE_TO = 'dateTo';

    /**
     * @var string
     */
    public const ACTIONS = 'actions';

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader($this->getHeaderFields());
        return $config;
    }

    /**
     * @return array
     */
    protected function getHeaderFields()
    {
        return [
            PyzBadgeTableMap::COL_ID_BADGE => 'Badge Id',
            PyzBadgeTableMap::COL_TITLE => 'Title',
            PyzBadgeTableMap::COL_IMAGE_URL => 'Image Url',
            PyzBadgeTableMap::COL_IS_ACTIVE => 'Is Active',
            PyzBadgeTableMap::COL_DESCRIPTION => 'Description',
            PyzBadgeTableMap::COL_TYPE => 'Plugin Name',
            PyzBadgeTableMap::COL_AMOUNT => 'Threshold',
        ];
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $result = [];

        $badgeKeys = $this->getBadgeKeys($config);

        foreach ($badgeKeys as $badgeEntity) {
            $result[] = [
                PyzBadgeTableMap::COL_ID_BADGE => $badgeEntity->getIdBadge(),
                PyzBadgeTableMap::COL_TITLE => $badgeEntity->getTitle(),
                PyzBadgeTableMap::COL_IMAGE_URL => $badgeEntity->getImageUrl(),
                PyzBadgeTableMap::COL_IS_ACTIVE => $badgeEntity->getIsActive(),
                PyzBadgeTableMap::COL_DESCRIPTION => $badgeEntity->getDescription(),
                PyzBadgeTableMap::COL_TYPE => $badgeEntity->getType(),
                PyzBadgeTableMap::COL_AMOUNT => $badgeEntity->getAmount(),
            ];
        }

        return $result;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array<\Orm\Zed\Badge\Persistence\PyzBadge>
     */
    protected function getBadgeKeys(TableConfiguration $config)
    {
        $query = PyzBadgeQuery::create();

        /** @var array<\Orm\Zed\Badge\Persistence\PyzBadge> $badgeIdKey */
        $badgeIdKey = $this->runQuery($query, $config, true);

        /** @phpstan-var array<\Orm\Zed\Badge\Persistence\PyzBadge> */
        return $badgeIdKey;
    }
}