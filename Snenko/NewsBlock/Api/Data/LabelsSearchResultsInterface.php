<?php


namespace Snenko\NewsBlock\Api\Data;

interface LabelsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Labels list.
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface[]
     */
    public function getItems();

    /**
     * Set content list.
     * @param \Snenko\NewsBlock\Api\Data\LabelsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
