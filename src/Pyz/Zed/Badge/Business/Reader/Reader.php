<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business\Reader;

use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;
use Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface;

class Reader implements ReaderInterface
{
    /**
     * @param \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface $badgeRepository
     */
    public function __construct(
        private readonly BadgeRepositoryInterface $badgeRepository,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\BadgeCollectionTransfer
     */
    public function get(BadgeCriteriaTransfer $badgeCriteriaTransfer): BadgeCollectionTransfer
    {
        return $this->badgeRepository->get($badgeCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadges(CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer): CustomerBadgeCollectionTransfer
    {
        return $this->badgeRepository->getCustomerBadges($customerBadgeCriteriaTransfer);
    }
}
