<?php

namespace Kapana\Signup\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Signup extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('kapana_signup', 'signup_id');
    }
}
