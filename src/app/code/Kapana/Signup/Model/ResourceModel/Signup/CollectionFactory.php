<?php

namespace Kapana\Signup\Model\ResourceModel\Signup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\ObjectManagerInterface;

/**
 * Factory class for Signup Collection
 */
class CollectionFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $instanceName;

    /**
     * CollectionFactory constructor.
     *
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
                               $instanceName = Collection::class
    )
    {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    /**
     * Create a new instance of Signup Collection
     *
     * @param array $data
     * @return AbstractCollection
     */
    public function create(array $data = []): AbstractCollection
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
