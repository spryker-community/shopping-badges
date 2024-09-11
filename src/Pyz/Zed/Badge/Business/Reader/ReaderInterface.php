<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business\Reader;

use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;

interface ReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\BadgeCriteriaTransfer $badgeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\BadgeCollectionTransfer
     */
    public function get(BadgeCriteriaTransfer $badgeCriteriaTransfer): BadgeCollectionTransfer;
}
