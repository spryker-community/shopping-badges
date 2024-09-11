<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business\Checker;

use Generated\Shared\Transfer\CustomerBadgeTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class CustomerOrderChecker
{
    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct(
        private readonly SalesFacadeInterface $salesFacade,
    ){
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function checkCustomerBadgeOrdersAmountType(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer
    {
        $orderListTransfer = $this->salesFacade->getCustomerOrders((new OrderListTransfer()), $customerBadgeTransfer->getIdCustomer());

        $ordersCount = $orderListTransfer->getOrders()->count();

        $customerBadgeTransfer->setAmount($ordersCount);
        if ($customerBadgeTransfer->getAmount() >= $customerBadgeTransfer->getTargetAmount()) {
            $customerBadgeTransfer->setIsAchieved(true);
        }

        return $customerBadgeTransfer;
    }
}
