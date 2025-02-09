<?php

namespace Kapana\MySignup\Model;

use Kapana\MySignup\Api\SignupRepositoryInterface;
use Kapana\MySignup\Api\Data\SignupInterface;
use Kapana\MySignup\Model\ResourceModel\Signup as SignupResource;
use Kapana\MySignup\Model\ResourceModel\Signup\CollectionFactory as SignupCollectionFactory;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class SignupRepository implements SignupRepositoryInterface
{
    /**
     * @var SignupResource
     */
    protected $resource;

    /**
     * @var \Kapana\MySignup\Model\SignupFactory
     */
    protected $signupFactory;

    /**
     * @var SignupCollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    public function __construct(
        SignupResource                       $resource,
        \Kapana\MySignup\Model\SignupFactory $signupFactory,
        SignupCollectionFactory              $collectionFactory,
        SearchResultsInterfaceFactory        $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->signupFactory = $signupFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save a Signup
     *
     * @param SignupInterface $signup
     * @return SignupInterface
     * @throws CouldNotSaveException
     */
    public function save(SignupInterface $signup)
    {
        try {
            $this->resource->save($signup);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $signup;
    }

    /**
     * Retrieve a Signup by ID
     *
     * @param int $signupId
     * @return SignupInterface
     * @throws NoSuchEntityException
     */
    public function getById($signupId)
    {
        $signup = $this->signupFactory->create();
        $this->resource->load($signup, $signupId);
        if (!$signup->getId()) {
            throw new NoSuchEntityException(__('Signup with id "%1" does not exist.', $signupId));
        }
        return $signup;
    }

    /**
     * Retrieve signups matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete a Signup
     *
     * @param SignupInterface $signup
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(SignupInterface $signup)
    {
        try {
            $this->resource->delete($signup);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * Delete a Signup by ID
     *
     * @param int $signupId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($signupId)
    {
        $signup = $this->getById($signupId);
        return $this->delete($signup);
    }
}
