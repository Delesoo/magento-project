<?php

namespace Kapana\MySignup\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        // Set the active menu item (this is optional)
        $resultPage->setActiveMenu('Kapana_MySignup::mysignup');
        $resultPage->getConfig()->getTitle()->prepend(__('Sign Ups'));
        return $resultPage;
    }
}
