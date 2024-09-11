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

use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
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
}
