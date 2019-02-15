<?php


namespace Snenko\NewsBlock\Api\Data;

interface PostsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Posts list.
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface[]
     */
    public function getItems();

    /**
     * Set Name list.
     * @param \Snenko\NewsBlock\Api\Data\PostsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
