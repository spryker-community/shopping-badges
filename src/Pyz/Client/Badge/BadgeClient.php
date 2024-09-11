<?php

declare(strict_types=1);

namespace Pyz\Client\Badge;

use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\Badge\BadgeFactory getFactory()
 */
class BadgeClient extends AbstractClient implements BadgeClientInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadge(int $idCustomer): CustomerBadgeCollectionTransfer
    {
        return $this->getFactory()->createZedRequestCustomerBadgeStub()->getCustomerBadges($idCustomer);
    }
}
