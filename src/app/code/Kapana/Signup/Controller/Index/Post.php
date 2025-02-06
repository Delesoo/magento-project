<?php

namespace Kapana\Signup\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use Kapana\Signup\Api\SignupRepositoryInterface;
use Kapana\Signup\Model\SignupFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Post extends Action
{
    protected $resultRedirectFactory;
    protected $signupFactory;
    protected $signupRepository;
    protected $scopeConfig;

    public function __construct(
        Context                   $context,
        RedirectFactory           $resultRedirectFactory,
        SignupFactory             $signupFactory,
        SignupRepositoryInterface $signupRepository,
        ScopeConfigInterface      $scopeConfig
    )
    {
        parent::__construct($context);
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->signupFactory = $signupFactory;
        $this->signupRepository = $signupRepository;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        // Check if enabled
        $enabled = $this->scopeConfig->getValue(
            'signup_config/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if (!$enabled) {
            $this->messageManager->addErrorMessage(__('Form not enabled'));
            return $this->resultRedirectFactory->create()->setPath('*/*/index');
        }

        $postData = $this->getRequest()->getPostValue();
        if (!$postData) {
            $this->messageManager->addErrorMessage(__('Invalid form data.'));
            return $this->resultRedirectFactory->create()->setPath('*/*/index');
        }

        try {
            $signup = $this->signupFactory->create();
            $signup->setName($postData['name']);
            $signup->setSignupDate($postData['date']);

            $this->signupRepository->save($signup);

            $this->messageManager->addSuccessMessage(__('Signup saved successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong: %1', $e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
