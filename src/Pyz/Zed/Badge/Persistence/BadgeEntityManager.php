<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Persistence;

use Generated\Shared\Transfer\CustomerBadgeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Badge\Persistence\BadgePersistenceFactory getFactory()
 */
class BadgeEntityManager extends AbstractEntityManager implements BadgeEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    public function saveCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer
    {
        $customerBadgeEntity = $this->getFactory()
            ->getCustomerBadgePropelQuery()
            ->filterByIdCustomerBadge($customerBadgeTransfer->getIdCustomerBadge())
            ->findOneOrCreate();

        $customerBadgeEntity->setFkCustomer($customerBadgeTransfer->getIdCustomer())
            ->setFkBadge($customerBadgeTransfer->getIdBadge())
            ->setCurrentAmount($customerBadgeTransfer->getAmount())
            ->setIsAchieved($customerBadgeTransfer->getIsAchieved());

        if ($customerBadgeEntity->isModified()) {
            $customerBadgeEntity->save();
        }

        $customerBadgeTransfer->setIdCustomerBadge($customerBadgeEntity->getIdCustomerBadge());

        return $customerBadgeTransfer;
    }
}
