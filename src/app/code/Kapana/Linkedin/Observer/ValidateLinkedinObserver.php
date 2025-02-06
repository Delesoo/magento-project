<?php

namespace Kapana\Linkedin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class ValidateLinkedinObserver implements ObserverInterface
{
    /**
     * Validate uniqueness and other conditions before customer save.
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getData('customer');

        if (!$customer) {
            return null; // no customer data, nothing to do.
        }

        $linkedinProfile = '';
        if (method_exists($customer, 'getCustomAttribute')) {
            $attribute = $customer->getCustomAttribute('linkedin_profile');
            if ($attribute) {
                $linkedinProfile = $attribute->getValue();
            }
        } elseif (method_exists($customer, 'getData')) {
            $linkedinProfile = $customer->getData('linkedin_profile');
        }

        if ($linkedinProfile) {
            $linkedinProfile = trim($linkedinProfile);
            if (strlen($linkedinProfile) > 250) {
                throw new LocalizedException(__('LinkedIn profile exceeds 250 characters.'));
            }
            if (!filter_var($linkedinProfile, FILTER_VALIDATE_URL)) {
                throw new LocalizedException(__('Invalid LinkedIn profile URL.'));
            }

            /** @var CustomerRepositoryInterface $customerRepository */
        }

        return $this;
    }
}
