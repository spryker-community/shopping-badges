<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge;

use Pyz\Zed\Badge\Communication\Plugin\OrdersAmountBadgeTypePlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class BadgeDependencyProvider extends  AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_BADGE_TYPE = 'PLUGINS_BADGE_TYPE';

    /**
     * @var string
     */
    public const FACADE_SALES = 'FACADE_SALES';

    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addBadgeTypePlugins($container);
        $container = $this->addSalesFacade($container);

        return $container;
    }

    private function addBadgeTypePlugins(Container $container): Container
    {
        $container->set(self::PLUGINS_BADGE_TYPE, function (): array {
            return $this->getBadgeTypePlugins();
        });

        return  $container;
    }

    /**
     * @return array<\Pyz\Zed\Badge\Communication\Plugin\OrdersAmountBadgeTypePlugin>
     */
    private function getBadgeTypePlugins(): array
    {
        return [
            new OrdersAmountBadgeTypePlugin(),
        ];
    }

    private function addSalesFacade(Container $container): Container
    {
        $container->set(self::FACADE_SALES, static function (Container $container): SalesFacadeInterface {
            return $container->getLocator()->sales()->facade();
        });

       return  $container;
    }
}
