<?php
declare(strict_types=1);

namespace Juno\Theme\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config;

class AddParentBodyClass implements ObserverInterface
{
    public function __construct(
        private readonly Config $config,
    )
    {
    }

    public function execute(Observer $observer)
    {
        $config = $this->config;
        if ($config->getPageLayout() === 'cms-article') {
            $config->addBodyClass('page-layout-1column');
        }
    }
}
