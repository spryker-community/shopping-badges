<?php

namespace Pyz\Zed\Shipment\Communication\Plugin\DeliveryTime;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodDeliveryTimePluginInterface;

class DHLExpressPlugin extends AbstractPlugin implements ShipmentMethodDeliveryTimePluginInterface
{

    const HALF_DAY_IN_SECONDS = 43200;

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return int
     */
    public function getTime(QuoteTransfer $quoteTransfer)
    {
        $count = 0;

        foreach ($quoteTransfer->getItems() as $item) {
            $count += $item->getQuantity();
        }

        return ($count < 4) ? self::HALF_DAY_IN_SECONDS : self::HALF_DAY_IN_SECONDS * 2;
    }

}
