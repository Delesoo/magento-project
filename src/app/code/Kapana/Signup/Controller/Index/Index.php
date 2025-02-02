<?php

namespace Kapana\Signup\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    protected $resultPageFactory;
    protected $scopeConfig;

    public function __construct(
        Context              $context,
        PageFactory          $resultPageFactory,
        ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        // Retrieve the form enabled config value
        $formEnabled = $this->scopeConfig->isSetFlag(
            'signup_config/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        if (!$formEnabled) {
            die("Form is disabled in configuration.");
        }

        return $this->resultPageFactory->create();
    }
}
