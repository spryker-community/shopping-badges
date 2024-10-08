<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business;

use Pyz\Zed\Badge\BadgeDependencyProvider;
use Pyz\Zed\Badge\Business\Assigner\Assigner;
use Pyz\Zed\Badge\Business\Assigner\AssignerInterface;
use Pyz\Zed\Badge\Business\Checker\BadgeChecker;
use Pyz\Zed\Badge\Business\Checker\CustomerOrderChecker;
use Pyz\Zed\Badge\Business\Deleter\Deleter;
use Pyz\Zed\Badge\Business\Deleter\DeleterInterface;
use Pyz\Zed\Badge\Business\Reader\Reader;
use Pyz\Zed\Badge\Business\Reader\ReaderInterface;
use Pyz\Zed\Badge\Business\Writer\Writer;
use Pyz\Zed\Badge\Business\Writer\WriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

/**
 * @method \Pyz\Zed\Badge\Persistence\BadgeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface getRepository()
 */
class BadgeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Badge\Business\Reader\ReaderInterface
     */
    public function createBadgeReader(): ReaderInterface
    {
        return new Reader($this->getRepository());
    }

    /**
     * @return \Pyz\Zed\Badge\Business\Writer\WriterInterface
     */
    public function createWriter(): WriterInterface
    {
        return new Writer($this->getEntityManager());
    }

    /**
     * @return \Pyz\Zed\Badge\Business\Deleter\DeleterInterface
     */
    public function createDeleter(): DeleterInterface
    {
        return new Deleter($this->getEntityManager());
    }

    /**
     * @return \Pyz\Zed\Badge\Business\Assigner\AssignerInterface
     */
    public function createAssigner(): AssignerInterface
    {
        return new Assigner();
    }

    /**
     * @return \Pyz\Zed\Badge\Business\Checker\BadgeChecker
     */
    public function createBadgeChecker(): BadgeChecker
    {
        return new BadgeChecker(
            $this->getRepository(),
            $this->getBadgeTypePlugins(),
            $this->createWriter(),
        );
    }

    public function createCustomerOrderChecker(): CustomerOrderChecker
    {
        return new CustomerOrderChecker($this->getSalesFacade());
    }

    /**
     * @return array<\Pyz\Zed\Badge\Communication\Plugin\OrdersAmountBadgeTypePlugin>
     */
    private function getBadgeTypePlugins(): array
    {
        return $this->getProvidedDependency(BadgeDependencyProvider::PLUGINS_BADGE_TYPE);
    }

    /**
     * @return \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    private function getSalesFacade(): SalesFacadeInterface
    {
        return $this->getProvidedDependency(BadgeDependencyProvider::FACADE_SALES);
    }
}
