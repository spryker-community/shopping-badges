<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Communication\Controller;

use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\Badge\Business\BadgeFacadeInterface getFacade()
 * @method \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadgesAction(CustomerTransfer $customerTransfer): CustomerBadgeCollectionTransfer
    {
        return $this->getFacade()->getCustomerBadges(
            (new CustomerBadgeCriteriaTransfer())->setIdCustomer($customerTransfer->getIdCustomer()),
        );
    }
}
