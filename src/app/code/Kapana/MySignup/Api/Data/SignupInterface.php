<?php

namespace Kapana\MySignup\Api\Data;

interface SignupInterface
{
    const SIGNUP_ID = 'signup_id';
    const NAME = 'name';
    const DATE = 'date';

    /**
     * Get the Signup ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set the Signup ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get the Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set the Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get the Date
     *
     * @return string
     */
    public function getDate();

    /**
     * Set the Date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date);
}
