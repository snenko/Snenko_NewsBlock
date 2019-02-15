<?php


namespace Snenko\NewsBlock\Model;

use Snenko\NewsBlock\Api\Data\PostsInterface;

class Posts extends \Magento\Framework\Model\AbstractModel implements PostsInterface
{

    protected $_eventPrefix = 'snenko_newsblock_posts';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {

        $this->_storeManager = $storeManager;

        parent::__construct($context, $registry, $resource, $resourceCollection);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Snenko\NewsBlock\Model\ResourceModel\Posts::class);
    }

    /**
     * Get posts_id
     * @return string
     */
    public function getPostsId()
    {
        return $this->getData(self::POSTS_ID);
    }

    /**
     * Set posts_id
     * @param string $postsId
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setPostsId($postsId)
    {
        return $this->setData(self::POSTS_ID, $postsId);
    }

    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name
     * @param string $name
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get description
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set description
     * @param string $description
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get label
     * @return string
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Set label
     * @param string $label
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * Get location
     * @return string
     */
    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * Set location
     * @param string $location
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * Get is_active
     * @return string
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set is_active
     * @param string $isActive
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get active_from
     * @return string
     */
    public function getActiveFrom()
    {
        return $this->getData(self::ACTIVE_FROM);
    }

    /**
     * Set active_from
     * @param string $activeFrom
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setActiveFrom($activeFrom)
    {
        return $this->setData(self::ACTIVE_FROM, $activeFrom);
    }

    /**
     * Get active_to
     * @return string
     */
    public function getActiveTo()
    {
        return $this->getData(self::ACTIVE_TO);
    }

    /**
     * Set active_to
     * @param string $activeTo
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setActiveTo($activeTo)
    {
        return $this->setData(self::ACTIVE_TO, $activeTo);
    }

    /**
     * Get image
     * @return string
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Set image
     * @param string $image
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }


    const BASE_MEDIA_PATH = 'newsblock';



    /**
     * Retrieve media url
     * @param string $file
     * @return string
     */
    protected function getMediaUrl($file)
    {
        return $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $file;
    }

    public function getImageFullUrl()
    {
        if (!$this->hasData('image_full_url')) {
            if ($file = $this->getImage()) {
                $image = $this->getMediaUrl($file);
            } else {
                $image = false;
            }
            $this->setData('image_full_url', $image);
        }

        return $this->getData('image_full_url');
    }

    public function getLinkUrl(){
        return $this->setData(self::LINK_URL);
    }

    public function setLinkUrl($linkUrl){
        return $this->setData(self::LINK_URL, $linkUrl);
    }
}
