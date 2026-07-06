<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner;

use JTL\Events\Dispatcher;
use JTL\Plugin\Bootstrapper;
use JTL\Shop;
use Plugin\tc_bedarfsrechner\src\FrontendController;

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

        $dispatcher->listen('shop.hook.' . \HOOK_SMARTY_OUTPUTFILTER, function (array $args): void {
            $controller = new FrontendController($this->getPlugin());
            $controller->handle($args);
        });
    }
}
