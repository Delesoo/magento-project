<?php

namespace Kapana\WeatherApp\Model\ResourceModel\WeatherHistory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kapana\WeatherApp\Model\WeatherHistory as WeatherHistoryModel;
use Kapana\WeatherApp\Model\ResourceModel\WeatherHistory as WeatherHistoryResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(WeatherHistoryModel::class, WeatherHistoryResource::class);
    }
}
