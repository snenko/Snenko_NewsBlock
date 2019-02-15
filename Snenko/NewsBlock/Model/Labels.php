<?php


namespace Snenko\NewsBlock\Model;

use Snenko\NewsBlock\Api\Data\LabelsInterface;

class Labels extends \Magento\Framework\Model\AbstractModel implements LabelsInterface
{

    protected $_eventPrefix = 'snenko_newsblock_labels';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Snenko\NewsBlock\Model\ResourceModel\Labels::class);
    }

    /**
     * Get labels_id
     * @return string
     */
    public function getLabelsId()
    {
        return $this->getData(self::LABELS_ID);
    }

    /**
     * Set labels_id
     * @param string $labelsId
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setLabelsId($labelsId)
    {
        return $this->setData(self::LABELS_ID, $labelsId);
    }

    /**
     * Get content
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set content
     * @param string $content
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get background_color
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->getData(self::BACKGROUND_COLOR);
    }

    /**
     * Set background_color
     * @param string $backgroundColor
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setBackgroundColor($backgroundColor)
    {
        return $this->setData(self::BACKGROUND_COLOR, $backgroundColor);
    }

    /**
     * Get text_color
     * @return string
     */
    public function getTextColor()
    {
        return $this->getData(self::TEXT_COLOR);
    }

    /**
     * Set text_color
     * @param string $textColor
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setTextColor($textColor)
    {
        return $this->setData(self::TEXT_COLOR, $textColor);
    }


    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @param string $isActive
     * @return \Snenko\TagSlider\Api\Data\TagsliderInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    public function getStores()
    {
        return $this->hasData('stores') ? $this->getData('stores') : $this->getData('store_id');
    }

}
