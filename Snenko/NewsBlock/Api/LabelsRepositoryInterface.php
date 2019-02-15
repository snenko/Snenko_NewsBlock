<?php


namespace Snenko\NewsBlock\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LabelsRepositoryInterface
{

    /**
     * Save Labels
     * @param \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
    );

    /**
     * Retrieve Labels
     * @param string $labelsId
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($labelsId);

    /**
     * Retrieve Labels matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Snenko\NewsBlock\Api\Data\LabelsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Labels
     * @param \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
    );

    /**
     * Delete Labels by ID
     * @param string $labelsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($labelsId);
}
