<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Communication\Plugin;

use Generated\Shared\Transfer\CustomerBadgeTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\Badge\Business\BadgeFacadeInterface getFacade()
 */
class OrdersAmountBadgeTypePlugin extends AbstractPlugin implements BadgeTypePluginInterface
{
    /**
     * @var string
     */
    private const NAME = 'OrdersAmountBadgeTypePlugin';
    public function getName(): string
    {
        return self::NAME;
    }
    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function checkCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer
    {
        return $this->getFacade()->checkCustomerBadgeOrdersAmountType($customerBadgeTransfer);
    }
}
