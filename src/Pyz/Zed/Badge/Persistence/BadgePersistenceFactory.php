<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Persistence;

use Orm\Zed\Badge\Persistence\PyzBadgeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\Badge\Persistence\BadgeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface getRepository()
 */
class BadgePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Badge\Persistence\PyzBadgeQuery
     */
    public function getBadgePropelQuery(): PyzBadgeQuery
    {
        return PyzBadgeQuery::create();
    }
}
