<?php


namespace Snenko\NewsBlock\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Snenko\NewsBlock\Model\ResourceModel\Posts\CollectionFactory as PostsCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Snenko\NewsBlock\Api\Data\PostsInterfaceFactory;
use Snenko\NewsBlock\Model\ResourceModel\Posts as ResourcePosts;
use Snenko\NewsBlock\Api\Data\PostsSearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Snenko\NewsBlock\Api\PostsRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class PostsRepository implements PostsRepositoryInterface
{

    protected $dataPostsFactory;

    private $storeManager;
    protected $resource;

    protected $postsFactory;

    protected $searchResultsFactory;

    protected $postsCollectionFactory;

    protected $dataObjectProcessor;

    protected $dataObjectHelper;


    /**
     * @param ResourcePosts $resource
     * @param PostsFactory $postsFactory
     * @param PostsInterfaceFactory $dataPostsFactory
     * @param PostsCollectionFactory $postsCollectionFactory
     * @param PostsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourcePosts $resource,
        PostsFactory $postsFactory,
        PostsInterfaceFactory $dataPostsFactory,
        PostsCollectionFactory $postsCollectionFactory,
        PostsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->postsFactory = $postsFactory;
        $this->postsCollectionFactory = $postsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPostsFactory = $dataPostsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Snenko\NewsBlock\Api\Data\PostsInterface $posts
    ) {
        /* if (empty($posts->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $posts->setStoreId($storeId);
        } */
        try {
            $this->resource->save($posts);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the posts: %1',
                $exception->getMessage()
            ));
        }
        return $posts;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($postsId)
    {
        $posts = $this->postsFactory->create();
        $this->resource->load($posts, $postsId);
        if (!$posts->getId()) {
            throw new NoSuchEntityException(__('Posts with id "%1" does not exist.', $postsId));
        }
        return $posts;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->postsCollectionFactory->create();
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

        $collection->addLabelFields();
        
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
        \Snenko\NewsBlock\Api\Data\PostsInterface $posts
    ) {
        try {
            $this->resource->delete($posts);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Posts: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($postsId)
    {
        return $this->delete($this->getById($postsId));
    }
}
