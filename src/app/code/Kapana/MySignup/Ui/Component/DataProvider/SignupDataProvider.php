<?php

namespace Kapana\MySignup\Ui\Component\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Kapana\MySignup\Model\ResourceModel\Signup\CollectionFactory;

class SignupDataProvider extends AbstractDataProvider
{
    /**
     * Constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
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

    /**
     * Get Data.
     *
     * @return array
     */
    public function getData()
    {
        // Instead of calling the parent, let's build the array manually to see what's coming from the collection
        $itemsArray = [];
        foreach ($this->collection->getItems() as $item) {
            $itemsArray[] = $item->getData();
        }

        $data = [
            'totalRecords' => count($itemsArray),
            'items' => $itemsArray,
        ];

        error_log("SignupDataProvider::getData() output: " . print_r($data, true));

        return $data;
    }

}
