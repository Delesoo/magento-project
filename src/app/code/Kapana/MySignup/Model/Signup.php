<?php

namespace Kapana\MySignup\Model;

use Magento\Framework\Model\AbstractModel;
use Kapana\MySignup\Api\Data\SignupInterface;

class Signup extends AbstractModel implements SignupInterface
{
    protected function _construct()
    {
        $this->_init(\Kapana\MySignup\Model\ResourceModel\Signup::class);
    }

    public function getId()
    {
        return $this->getData(self::SIGNUP_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::SIGNUP_ID, $id);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }
}
