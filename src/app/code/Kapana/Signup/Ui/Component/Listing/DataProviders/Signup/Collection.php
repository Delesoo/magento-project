<?php

namespace Kapana\Signup\Ui\Component\Listing\DataProviders\Signup;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Kapana\Signup\Model\ResourceModel\Signup\CollectionFactory;

class Collection extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (!$this->getCollection()) {
            return [];
        }
        return parent::getData();
    }
}
