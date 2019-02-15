<?php

namespace Snenko\NewsBlock\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $_template = "widget/banner.phtml";

    protected $postsRepository;
    protected $postsFactory;

    protected $_items;
    protected $_labelItems;


    /** @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder */
    protected $searchCriteriaBuilder;
    protected $filterBuilder;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Snenko\NewsBlock\Api\PostsRepositoryInterface $postsRepository,
        \Snenko\NewsBlock\Api\Data\PostsInterfaceFactory $postsFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->postsRepository = $postsRepository;
        $this->postsFactory = $postsFactory;

        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getItems()
    {

        if(!isset($this->_items)){

            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('is_active', 1, 'eq')
                ->create();

            $products = $this->postsRepository->getList($searchCriteria);

            $this->_items = $products->getItems();

        }
        return $this->_items;
    }

    public function getLocationData($number)
    {
        if($items = $this->getItems()) {
            foreach ($items as $item)
                if ($item->getLocation() == $number) {
                    return $item->getData();
                }

        }
        return null;
    }

    /**
     * Get store identifier
     *
     * @return  int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getMediaUrl($file)
    {
        return $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $file;
    }


    public function getTitle()
    {
        return $this->getData("widget_title");
    }

    public function getShowMoreLabel()
    {
        return $this->getData('widget_show_more_label');
    }

    public function getShowMoreUrl()
    {
        return $this->getData('widget_show_more_url');
    }
}