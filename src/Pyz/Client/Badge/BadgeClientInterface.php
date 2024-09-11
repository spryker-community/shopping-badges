<?php

declare(strict_types=1);

namespace Pyz\Client\Badge;

use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;

interface BadgeClientInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadge(int $idCustomer): CustomerBadgeCollectionTransfer;
}
