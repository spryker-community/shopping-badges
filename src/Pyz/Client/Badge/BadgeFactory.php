<?php

declare(strict_types=1);

namespace Pyz\Client\Badge;

use Pyz\Client\Badge\ZedRequest\CustomerBadgeStub;
use Spryker\Client\Kernel\AbstractFactory;

class BadgeFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\Badge\ZedRequest\CustomerBadgeStub
     */
    public function createZedRequestCustomerBadgeStub()
    {
        return new CustomerBadgeStub($this->getProvidedDependency(BadgeDependencyProvider::CLIENT_ZED_REQUEST));
    }
}
