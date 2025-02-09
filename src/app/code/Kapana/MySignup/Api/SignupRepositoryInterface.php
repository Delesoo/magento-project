<?php

namespace Kapana\MySignup\Api;

use Kapana\MySignup\Api\Data\SignupInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface SignupRepositoryInterface
{
    /**
     * Save a Signup
     *
     * @param \Kapana\MySignup\Api\Data\SignupInterface $signup
     * @return \Kapana\MySignup\Api\Data\SignupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(SignupInterface $signup);

    /**
     * Retrieve a Signup by ID
     *
     * @param int $signupId
     * @return \Kapana\MySignup\Api\Data\SignupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($signupId);

    /**
     * Retrieve signups matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a Signup
     *
     * @param \Kapana\MySignup\Api\Data\SignupInterface $signup
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(SignupInterface $signup);

    /**
     * Delete a Signup by its ID
     *
     * @param int $signupId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($signupId);
}
