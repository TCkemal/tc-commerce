<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner\src;

use JTL\Plugin\PluginInterface;
use JTL\Smarty\JTLSmarty;
use JTL\Shop;

class FrontendController
{
    private PluginInterface $plugin;

    public function __construct(PluginInterface $plugin)
    {
        $this->plugin = $plugin;
    }

    public function handle(array $args): void
    {
        $smarty = $args['smarty'] ?? Shop::Smarty();

        if (!$smarty instanceof JTLSmarty) {
            return;
        }

        if (!$this->isArticlePage($smarty)) {
            return;
        }

        $this->assignAssets($smarty);

        $template = $this->plugin->getPaths()->getFrontendPath() . 'template/calculator.tpl';
        $html     = $smarty->fetch($template);

        $this->injectHtml($html);
    }

    private function isArticlePage(JTLSmarty $smarty): bool
    {
        $pageType = (int)($smarty->getTemplateVars('nSeitenTyp') ?? 0);

        if (defined('PAGE_ARTIKEL') && $pageType === (int)PAGE_ARTIKEL) {
            return true;
        }

        return Shop::getPageType() === (defined('PAGE_ARTIKEL') ? (int)PAGE_ARTIKEL : 1);
    }

    private function assignAssets(JTLSmarty $smarty): void
    {
        $smarty->assign('tcBedarfsrechner', [
            'version' => '0.2.1',
            'cssUrl'  => $this->plugin->getPaths()->getFrontendURL() . 'css/calculator.css',
            'jsUrl'   => $this->plugin->getPaths()->getFrontendURL() . 'js/calculator.js',
        ]);
    }

    private function injectHtml(string $html): void
    {
        if (!function_exists('pq')) {
            return;
        }

        \pq('head')->append('<link rel="stylesheet" href="' . htmlspecialchars($this->plugin->getPaths()->getFrontendURL() . 'css/calculator.css', ENT_QUOTES) . '">');
        \pq('body')->append('<script src="' . htmlspecialchars($this->plugin->getPaths()->getFrontendURL() . 'js/calculator.js', ENT_QUOTES) . '" defer></script>');

        if (\pq('#add-to-cart')->length > 0) {
            \pq('#add-to-cart')->before($html);
            return;
        }

        if (\pq('[data-toggle="basket-add"]').length > 0) {
            \pq('[data-toggle="basket-add"]')->closest('form')->before($html);
            return;
        }

        if (\pq('.product-info')->length > 0) {
            \pq('.product-info')->append($html);
            return;
        }

        \pq('body')->append($html);
    }
}
