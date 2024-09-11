<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Communication\Plugin;

use Generated\Shared\Transfer\BadgeCheckCriteriaTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPostSaveInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\Badge\Business\BadgeFacadeInterface getFacade()
 */
class BadgeCheckCheckoutPostSaveHookPlugin extends AbstractPlugin implements CheckoutPostSaveInterface
{
    /**
     * @inheritDoc
     */
    public function executeHook(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        if (!$quoteTransfer->getCustomer() || !$quoteTransfer?->getCustomer()->getIdCustomer()) {
            return;
        }

        $this->getFacade()->checkBadges(
            (new BadgeCheckCriteriaTransfer())->setIdCustomer(
                $quoteTransfer->getCustomer()->getIdCustomer(),
            ),
        );
    }
}
