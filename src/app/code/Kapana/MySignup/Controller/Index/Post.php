<?php

namespace Kapana\MySignup\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Kapana\MySignup\Api\SignupRepositoryInterface;
use Kapana\MySignup\Model\SignupFactory;

class Post extends Action
{
    /**
     * @var SignupRepositoryInterface
     */
    protected $signupRepository;

    /**
     * @var SignupFactory
     */
    protected $signupFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param SignupRepositoryInterface $signupRepository
     * @param SignupFactory $signupFactory
     */
    public function __construct(
        Context                   $context,
        SignupRepositoryInterface $signupRepository,
        SignupFactory             $signupFactory
    )
    {
        $this->signupRepository = $signupRepository;
        $this->signupFactory = $signupFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if (!$postData) {
            $this->messageManager->addErrorMessage(__('Invalid form data.'));
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $signup = $this->signupFactory->create();
        $signup->setName($postData['name']);
        $signup->setDate($postData['date']);

        try {
            $this->signupRepository->save($signup);
            $this->messageManager->addSuccessMessage(
                __('Thank you, %1. We received your signup on %2.', $signup->getName(), $signup->getDate())
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('Error saving signup: %1', $e->getMessage())
            );
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('mysignup');
        return $resultRedirect;
    }
}
