<?php

namespace Kapana\Signup\Model;

use Kapana\Signup\Api\SignupRepositoryInterface;
use Kapana\Signup\Model\ResourceModel\Signup as SignupResource;
use Kapana\Signup\Model\SignupFactory;
use Kapana\Signup\Model\Data\SignupInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;

class SignupRepository implements SignupRepositoryInterface
{
    protected $resource;
    protected $signupFactory;

    public function __construct(
        SignupResource $resource,
        SignupFactory  $signupFactory
    )
    {
        $this->resource = $resource;
        $this->signupFactory = $signupFactory;
    }

    public function save(SignupInterface $signup)
    {
        try {
            $this->resource->save($signup);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $signup;
    }

    public function getById($signupId)
    {
        $signup = $this->signupFactory->create();
        $this->resource->load($signup, $signupId);
        if (!$signup->getId()) {
            throw new NoSuchEntityException(__('unable to find signup with ID "%1" homie', $signupId));
        }
        return $signup;
    }

    public function delete(SignupInterface $signup)
    {
        try {
            $this->resource->delete($signup);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return true;
    }

    public function deleteById($signupId)
    {
        $signup = $this->getById($signupId);
        return $this->delete($signup);
    }
}
