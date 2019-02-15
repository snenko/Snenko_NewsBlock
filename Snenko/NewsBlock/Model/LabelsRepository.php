<?php


namespace Snenko\NewsBlock\Model;

use Snenko\NewsBlock\Api\Data\LabelsSearchResultsInterfaceFactory;
use Snenko\NewsBlock\Api\Data\LabelsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Snenko\NewsBlock\Api\LabelsRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Snenko\NewsBlock\Model\ResourceModel\Labels\CollectionFactory as LabelsCollectionFactory;
use Snenko\NewsBlock\Model\ResourceModel\Labels as ResourceLabels;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;

class LabelsRepository implements LabelsRepositoryInterface
{

    protected $dataObjectHelper;

    protected $resource;

    protected $labelsCollectionFactory;

    protected $searchResultsFactory;

    protected $dataLabelsFactory;

    protected $labelsFactory;

    protected $dataObjectProcessor;

    private $storeManager;

    /**
     * @param ResourceLabels $resource
     * @param LabelsFactory $labelsFactory
     * @param LabelsInterfaceFactory $dataLabelsFactory
     * @param LabelsCollectionFactory $labelsCollectionFactory
     * @param LabelsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLabels $resource,
        LabelsFactory $labelsFactory,
        LabelsInterfaceFactory $dataLabelsFactory,
        LabelsCollectionFactory $labelsCollectionFactory,
        LabelsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->labelsFactory = $labelsFactory;
        $this->labelsCollectionFactory = $labelsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLabelsFactory = $dataLabelsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
    ) {
        /* if (empty($labels->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $labels->setStoreId($storeId);
        } */
        try {
            $this->resource->save($labels);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the labels: %1',
                $exception->getMessage()
            ));
        }
        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($labelsId)
    {
        $labels = $this->labelsFactory->create();
        $this->resource->load($labels, $labelsId);
        if (!$labels->getId()) {
            throw new NoSuchEntityException(__('Labels with id "%1" does not exist.', $labelsId));
        }
        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->labelsCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $fields[] = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $conditions[] = [$condition => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Snenko\NewsBlock\Api\Data\LabelsInterface $labels
    ) {
        try {
            $this->resource->delete($labels);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Labels: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($labelsId)
    {
        return $this->delete($this->getById($labelsId));
    }
}
