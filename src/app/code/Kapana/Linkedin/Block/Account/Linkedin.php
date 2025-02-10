<?php

namespace Kapana\Linkedin\Block\Account;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Api\CustomerRepositoryInterface;

class Linkedin extends Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $data
     */
    public function __construct(
        Template\Context                $context,
        \Magento\Customer\Model\Session $customerSession,
        CustomerRepositoryInterface     $customerRepository,
        array                           $data = []
    )
    {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $data);
    }

    /**
     * Get current customer
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer()
    {
        $customer = $this->customerSession->getCustomer();
        // Reload customer data from the repository to include all custom attributes
        return $this->customerRepository->getById($customer->getId());
    }
}

