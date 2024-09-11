<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business;

use Generated\Shared\Transfer\BadgeCheckCriteriaTransfer;
use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Badge\Business\BadgeBusinessFactory getFactory()
 * @method \Pyz\Zed\Badge\Persistence\BadgeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface getRepository()
 */
class BadgeFacade extends AbstractFacade implements BadgeFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\BadgeCollectionTransfer
     */
    public function get(BadgeCriteriaTransfer $badgeCriteriaTransfer): BadgeCollectionTransfer
    {
        return $this->getFactory()->createBadgeReader()->get($badgeCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer
     *
     * @return void
     */
    public function checkBadges(BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer): void
    {
        $this->getFactory()->createBadgeChecker()->checkBadges($badgeCheckCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    public function getCustomerBadges(CustomerBadgeCriteriaTransfer $customerBadgeCriteriaTransfer): CustomerBadgeCollectionTransfer
    {
        return $this->getFactory()->createBadgeReader()->getCustomerBadges($customerBadgeCriteriaTransfer);
    }
}
