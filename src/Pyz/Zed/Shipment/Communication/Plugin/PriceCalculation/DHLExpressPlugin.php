<?php

namespace Pyz\Zed\Shipment\Communication\Plugin\PriceCalculation;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

class DHLExpressPlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{

    const DHL_EXPRESS_ITEM_PRICE = 4;

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return int
     */
    public function getPrice(QuoteTransfer $quoteTransfer)
    {
        $count = 0;

        foreach ($quoteTransfer->getItems() as $item) {
            $count += $item->getQuantity();
        }

        return self::DHL_EXPRESS_ITEM_PRICE * $count;
    }

}
