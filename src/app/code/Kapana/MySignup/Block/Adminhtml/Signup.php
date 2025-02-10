<?php

namespace Kapana\MySignup\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Kapana\MySignup\Model\ResourceModel\Signup\CollectionFactory as SignupCollectionFactory;

class Signup extends Template
{
    /**
     * @var SignupCollectionFactory
     */
    protected $collectionFactory;

    public function __construct(
        Context                 $context,
        SignupCollectionFactory $collectionFactory,
        array                   $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve signup collection
     *
     * @return \Kapana\MySignup\Model\ResourceModel\Signup\Collection
     */
    public function getSignupCollection()
    {
        $collection = $this->collectionFactory->create();
        // Optionally, add filters or sorting here.
        return $collection;
    }
}
