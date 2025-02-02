<?php

namespace Kapana\WeatherApp\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class WeatherHistory extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('kapana_weather_history', 'entity_id');
    }
}
