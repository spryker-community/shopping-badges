<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Persistence;

use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;

interface BadgeRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\BadgeCollectionTransfer
     */
    public function get(BadgeCriteriaTransfer $badgeCriteriaTransfer): BadgeCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadges(CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer): CustomerBadgeCollectionTransfer;
}
