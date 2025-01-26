<?php

namespace Kapana\Signup\Model\ResourceModel\Signup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kapana\Signup\Model\Signup as SignupModel;
use Kapana\Signup\Model\ResourceModel\Signup as SignupResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'signup_id';

    protected function _construct()
    {
        $this->_init(SignupModel::class, SignupResource::class);
    }
}
