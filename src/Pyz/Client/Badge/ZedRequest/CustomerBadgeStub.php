<?php

declare(strict_types=1);

namespace Pyz\Client\Badge\ZedRequest;

use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class CustomerBadgeStub
{
    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(
        private readonly ZedRequestClient $zedStub,
    ) {
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadges(int $idCustomer): CustomerBadgeCollectionTransfer
    {
        $customerTransfer = (new CustomerTransfer())->setIdCustomer($idCustomer);
        /** @var \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer $customerBadgeCollectionTransfer */
        $customerBadgeCollectionTransfer = $this->zedStub->call('/badge/gateway/get-customer-badges', $customerTransfer);

        return $customerBadgeCollectionTransfer;
    }
}
