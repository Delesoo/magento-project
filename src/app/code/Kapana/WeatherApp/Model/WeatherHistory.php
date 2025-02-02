<?php

namespace Kapana\WeatherApp\Model;

use Magento\Framework\Model\AbstractModel;

class WeatherHistory extends AbstractModel
{
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(\Kapana\WeatherApp\Model\ResourceModel\WeatherHistory::class);
    }
}
