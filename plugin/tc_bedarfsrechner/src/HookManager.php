<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner\src;

use JTL\Plugin\PluginInterface;
use JTL\Shop;

class HookManager
{
    private PluginInterface $plugin;

    public function __construct(PluginInterface $plugin)
    {
        $this->plugin = $plugin;
    }

    public function render(): void
    {
        $smarty = Shop::Smarty();

        $templatePath = $this->plugin->getPaths()->getFrontendPath() . 'template/calculator.tpl';
        $cssPath      = $this->plugin->getPaths()->getFrontendURL() . 'css/calculator.css';
        $jsPath       = $this->plugin->getPaths()->getFrontendURL() . 'js/calculator.js';

        $html = $smarty->fetch($templatePath);

        $html .= '<link rel="stylesheet" href="' . $cssPath . '">';
        $html .= '<script src="' . $jsPath . '" defer></script>';

        $this->injectBeforeAddToCart($html);
    }

    private function injectBeforeAddToCart(string $html): void
    {
        $smarty = Shop::Smarty();

        $output = $smarty->getTemplateVars('__smarty_output');
        if (!is_string($output) || $output === '') {
            return;
        }

        $selector = 'id="add-to-cart"';
        $position = strpos($output, $selector);

        if ($position === false) {
            return;
        }

        $formStart = strrpos(substr($output, 0, $position), '<form');

        if ($formStart === false) {
            return;
        }

        $output = substr($output, 0, $formStart) . $html . substr($output, $formStart);

        $smarty->assign('__smarty_output', $output);
    }
}
