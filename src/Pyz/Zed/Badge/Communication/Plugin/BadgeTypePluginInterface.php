<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Communication\Plugin;

use Generated\Shared\Transfer\CustomerBadgeTransfer;

interface BadgeTypePluginInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function checkCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer;
}
