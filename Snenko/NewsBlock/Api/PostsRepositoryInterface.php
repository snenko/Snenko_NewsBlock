<?php


namespace Snenko\NewsBlock\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PostsRepositoryInterface
{

    /**
     * Save Posts
     * @param \Snenko\NewsBlock\Api\Data\PostsInterface $posts
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Snenko\NewsBlock\Api\Data\PostsInterface $posts
    );

    /**
     * Retrieve Posts
     * @param string $postsId
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postsId);

    /**
     * Retrieve Posts matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Snenko\NewsBlock\Api\Data\PostsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Posts
     * @param \Snenko\NewsBlock\Api\Data\PostsInterface $posts
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Snenko\NewsBlock\Api\Data\PostsInterface $posts
    );

    /**
     * Delete Posts by ID
     * @param string $postsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postsId);
}
