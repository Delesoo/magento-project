<?php

namespace Kapana\Signup\Model;

use Magento\Framework\Model\AbstractModel;
use Kapana\Signup\Model\Data\SignupInterface;

class Signup extends AbstractModel implements SignupInterface
{
    protected function _construct()
    {
        $this->_init(\Kapana\Signup\Model\ResourceModel\Signup::class);
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

    public function getSignupDate()
    {
        return $this->getData(self::SIGNUP_DATE);
    }

    public function setSignupDate($date)
    {
        return $this->setData(self::SIGNUP_DATE, $date);
    }
}
