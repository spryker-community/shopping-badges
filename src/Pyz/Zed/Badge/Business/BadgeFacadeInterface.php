<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business;

use Generated\Shared\Transfer\BadgeCheckCriteriaTransfer;
use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeTransfer;

interface BadgeFacadeInterface
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

    /**
     * @param \Generated\Shared\Transfer\BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer
     *
     * @return void
     */
    public function checkBadges(BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function checkCustomerBadgeOrdersAmountType(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer;
}
