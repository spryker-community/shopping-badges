<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Persistence;

use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\BadgeTransfer;
use Orm\Zed\Badge\Persistence\PyzBadgeQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @method \Pyz\Zed\Badge\Persistence\BadgePersistenceFactory getFactory()
 */
class BadgeRepository implements BadgeRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\BadgeCollectionTransfer
     */
    public function get(BadgeCriteriaTransfer $badgeCriteriaTransfer): BadgeCollectionTransfer
    {
        $badgeQuery = $this->applyFilters(
            $this->getFactory()->getBadgePropelQuery(),
            $badgeCriteriaTransfer,
        );

        $badgeEntities = $badgeQuery->find();
        $badgeCollectionTransfer = new BadgeCollectionTransfer();

        if ($badgeEntities->count() === 0) {
            return $badgeCollectionTransfer;
        }

        foreach ($badgeEntities as $badgeEntity) {
            $badgeCollectionTransfer->addBadge(
                (new BadgeTransfer())->fromArray($badgeEntity->toArray(), true),
            );
        }

        return $badgeCollectionTransfer;
    }

    /**
     * @param \Orm\Zed\Badge\Persistence\PyzBadgeQuery $badgeQuery
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Orm\Zed\Badge\Persistence\PyzBadgeQuery
     */
    private function applyFilters(
        PyzBadgeQuery $badgeQuery,
        BadgeCriteriaTransfer $badgeCriteriaTransfer,
    ): PyzBadgeQuery {
        if ($badgeCriteriaTransfer->getBadgeExcludeIds()) {
            $badgeQuery->filterByIdBadge($badgeCriteriaTransfer->getBadgeExcludeIds(), Criteria::NOT_IN);
        }

        if ($badgeCriteriaTransfer->getIsActive() !== null) {
            $badgeQuery->filterByIsActive($badgeCriteriaTransfer->getIsActive());
        }

        return $badgeQuery;
    }
}
