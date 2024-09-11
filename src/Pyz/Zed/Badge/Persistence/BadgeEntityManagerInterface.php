<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Persistence;

use Generated\Shared\Transfer\CustomerBadgeTransfer;

interface BadgeEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function saveCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer;
}
