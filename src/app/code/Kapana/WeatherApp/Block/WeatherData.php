<?php

namespace Kapana\WeatherApp\Block;

use Magento\Framework\View\Element\Template;
use Kapana\WeatherApp\Model\ResourceModel\WeatherHistory\CollectionFactory;

class WeatherData extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $historyCollectionFactory;

    public function __construct(
        Template\Context  $context,
        CollectionFactory $historyCollectionFactory,
        array             $data = []
    )
    {
        $this->historyCollectionFactory = $historyCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve weather history collection.
     *
     * @return \Kapana\WeatherApp\Model\ResourceModel\WeatherHistory\Collection
     */
    public function getHistoryCollection()
    {
        $city = $this->getData('city');
        $collection = $this->historyCollectionFactory->create();
        if ($city) {
            $collection->addFieldToFilter('city', ['eq' => $city]);
        }
        return $collection;
    }
}
