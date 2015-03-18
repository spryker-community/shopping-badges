<?php

namespace Pyz\Zed\Glossary\Business\Internal\DemoData;

use Generated\Zed\Ide\AutoCompletion;
use ProjectA\Zed\Glossary\Dependency\Plugin\GlossaryInstallerPluginInterface;
use ProjectA\Zed\Installer\Business\Model\AbstractInstaller;
use ProjectA\Zed\Kernel\Locator;

class GlossaryInstall extends AbstractInstaller
{

    /**
     * @var GlossaryInstallerPluginInterface[]
     */
    protected $installers;

    /**
     * @param Locator|AutoCompletion $locator
     */
    public function __construct(Locator $locator)
    {
        $this->installers = [
            $locator->glossary()->pluginYamlInstallerPlugin()
        ];
    }

    public function install()
    {
        $this->info("This will install a standard set of translations in the demo shop ");

        foreach ($this->installers as $installer) {
            $installer->installGlossaryData();
        }
    }
}
