<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business\Writer;

use Generated\Shared\Transfer\CustomerBadgeTransfer;
use Pyz\Zed\Badge\Persistence\BadgeEntityManagerInterface;

class Writer implements WriterInterface
{
    /**
     * @param \Pyz\Zed\Badge\Persistence\BadgeEntityManagerInterface $badgeEntityManager
     */
    public function __construct(
        private readonly BadgeEntityManagerInterface $badgeEntityManager,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function saveCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer
    {
        return $this->badgeEntityManager->saveCustomerBadge($customerBadgeTransfer);
    }
}
