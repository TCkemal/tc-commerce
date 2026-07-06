<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner;

use JTL\Events\Dispatcher;
use JTL\Plugin\Bootstrapper;
use JTL\Shop;
use Plugin\tc_bedarfsrechner\src\HookManager;

class Bootstrap extends Bootstrapper
{
    public function boot(Dispatcher $dispatcher): void
    {
        parent::boot($dispatcher);

        if (!Shop::isFrontend()) {
            return;
        }

        $config = $this->getPlugin()->getConfig();

        if ((string)$config->getValue('active') !== '1') {
            return;
        }

        $dispatcher->listen('shop.hook.' . \HOOK_SMARTY_OUTPUTFILTER, function (): void {
            if (Shop::getPageType() !== \PAGE_ARTIKEL) {
                return;
            }

            try {
                $manager = new HookManager($this->getPlugin());
                $manager->render();
            } catch (\Throwable $e) {
                // In Version 0.2 bewusst still, damit der Shop nicht bricht.
            }
        });
    }
}
