<?php

namespace Kapana\Linkedin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ResourceConnection;
use Psr\Log\LoggerInterface;

class ValidateLinkedinObserver implements ObserverInterface
{
    protected $customerRepository;
    protected $resource;
    protected $logger;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        ResourceConnection          $resource,
        LoggerInterface             $logger
    )
    {
        $this->customerRepository = $customerRepository;
        $this->resource = $resource;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        if (!$customer) {
            return null;
        }
        
        $this->logger->info('Customer Data Before Saving:', $customer->getData());

        $linkedinProfile = $customer->getData('linkedin_profile');

        if ($linkedinProfile) {
            $linkedinProfile = trim($linkedinProfile);

            // validation of URL
            if (!filter_var($linkedinProfile, FILTER_VALIDATE_URL)) {
                throw new LocalizedException(__('Invalid LinkedIn profile URL.'));
            }

            // log before saving
            $this->logger->info('Saving LinkedIn Profile:', ['linkedin_profile' => $linkedinProfile]);

            // save data in customer_entity
            $customer->setData('linkedin_profile', $linkedinProfile);
            $this->customerRepository->save($customer);

            // DI injection
            $connection = $this->resource->getConnection();
            $customerId = $customer->getId();

            if ($customerId) {
                $connection->update(
                    'customer_entity',
                    ['linkedin_profile' => $linkedinProfile],
                    ['entity_id = ?' => $customerId]
                );
            }

            // log after saving
            $this->logger->info('Customer Data After Saving:', ['linkedin_profile' => $linkedinProfile]);
        } else {
            $this->logger->info('linkedin_profile is missing in Customer Data.');
        }

        return $this;
    }
}



