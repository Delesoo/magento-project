<?php

namespace Kapana\Signup\Api;

use Kapana\Signup\Model\Data\SignupInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SignupRepositoryInterface
{
    public function save(SignupInterface $signup);

    public function getById($signupId);

    public function delete(SignupInterface $signup);

    public function deleteById($signupId);
}
