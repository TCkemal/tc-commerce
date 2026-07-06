<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner;

use JTL\Events\Dispatcher;
use JTL\Plugin\Bootstrapper;

class Bootstrap extends Bootstrapper
{
    public function boot(Dispatcher $dispatcher): void
    {
        parent::boot($dispatcher);
    }
}
