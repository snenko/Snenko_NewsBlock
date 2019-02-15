<?php


namespace Snenko\NewsBlock\Api\Data;

interface LabelsInterface
{

    const TEXT_COLOR = 'text_color';
    const CONTENT = 'content';
    const BACKGROUND_COLOR = 'background_color';
    const LABELS_ID = 'labels_id';
    const NAME = 'name';
    const STORE_ID = 'store_id';

    /**
     * Get labels_id
     * @return string|null
     */
    public function getLabelsId();

    /**
     * Set labels_id
     * @param string $labelsId
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setLabelsId($labelsId);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setContent($content);

    /**
     * Get background_color
     * @return string|null
     */
    public function getBackgroundColor();

    /**
     * Set background_color
     * @param string $backgroundColor
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setBackgroundColor($backgroundColor);

    /**
     * Get text_color
     * @return string|null
     */
    public function getTextColor();

    /**
     * Set text_color
     * @param string $textColor
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setTextColor($textColor);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set text_color
     * @param string $name
     * @return \Snenko\NewsBlock\Api\Data\LabelsInterface
     */
    public function setName($name);

    /**
     * Set Store Id
     * @param string $tag
     * @return \Snenko\TagSlider\Api\Data\TagsliderInterface
     */
    public function setStoreId($storeId);

    /**
     * Get Store Id
     * @return string|null
     */
    public function getStoreId();

}
