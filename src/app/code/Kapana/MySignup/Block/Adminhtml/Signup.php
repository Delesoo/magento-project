<?php

namespace Kapana\MySignup\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Kapana\MySignup\Model\ResourceModel\Signup\CollectionFactory as SignupCollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Signup extends Template
{
    /**
     * @var SignupCollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        Context                 $context,
        SignupCollectionFactory $collectionFactory,
        ScopeConfigInterface    $scopeConfig,
        array                   $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve signup collection.
     *
     * @return \Kapana\MySignup\Model\ResourceModel\Signup\Collection
     */
    public function getSignupCollection()
    {
        $collection = $this->collectionFactory->create();
        $request = $this->getRequest();

        // name searching
        $searchName = $request->getParam('search_name');
        if ($searchName) {
            $collection->addFieldToFilter('name', ['like' => '%' . $searchName . '%']);
        }
        // sorting by date
        $direction = $request->getParam('direction');
        if ($direction && in_array(strtolower($direction), ['asc', 'desc'])) {
            $collection->setOrder('date', $direction);
        }
        return $collection;
    }

    /**
     * Check if the signup form is enabled in system config.
     *
     * @return bool
     */
    public function isSignupEnabled()
    {
        return (bool)$this->scopeConfig->getValue(
            'kapana_mysignup/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

    }
}
