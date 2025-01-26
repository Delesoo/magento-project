<?php

namespace Kapana\Signup\Model\Data;

interface SignupInterface
{
    const SIGNUP_ID = 'signup_id';
    const NAME = 'name';
    const SIGNUP_DATE = 'signup_date';

    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getSignupDate();

    public function setSignupDate($date);
}
