<?php

namespace Kapana\MySignup\Model\ResourceModel\Signup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kapana\MySignup\Model\Signup as SignupModel;
use Kapana\MySignup\Model\ResourceModel\Signup as SignupResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SignupModel::class, SignupResource::class);
    }
}
