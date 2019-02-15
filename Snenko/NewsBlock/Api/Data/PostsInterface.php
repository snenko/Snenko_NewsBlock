<?php


namespace Snenko\NewsBlock\Api\Data;

interface PostsInterface
{

    const POSTS_ID = 'posts_id';
    const IS_ACTIVE = 'is_active';
    const LABEL = 'label';
    const LOCATION = 'location';
    const ACTIVE_FROM = 'active_from';
    const NAME = 'name';
    const ACTIVE_TO = 'active_to';
    const IMAGE = 'image';
    const DESCRIPTION = 'description';
    const LINK_URL = 'link_url';

    /**
     * Get posts_id
     * @return string|null
     */
    public function getPostsId();

    /**
     * Set posts_id
     * @param string $postsId
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setPostsId($postsId);

    /**
     * Get Name
     * @return string|null
     */
    public function getName();

    /**
     * Set Name
     * @param string $name
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setName($name);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setDescription($description);

    /**
     * Get label
     * @return string|null
     */
    public function getLabel();

    /**
     * Set label
     * @param string $label
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setLabel($label);

    /**
     * Get location
     * @return string|null
     */
    public function getLocation();

    /**
     * Set location
     * @param string $location
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setLocation($location);

    /**
     * Get is_active
     * @return string|null
     */
    public function getIsActive();

    /**
     * Set is_active
     * @param string $isActive
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setIsActive($isActive);

    /**
     * Get active_from
     * @return string|null
     */
    public function getActiveFrom();

    /**
     * Set active_from
     * @param string $activeFrom
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setActiveFrom($activeFrom);

    /**
     * Get active_to
     * @return string|null
     */
    public function getActiveTo();

    /**
     * Set active_to
     * @param string $activeTo
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setActiveTo($activeTo);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Snenko\NewsBlock\Api\Data\PostsInterface
     */
    public function setImage($image);


    public function getLinkUrl();

    public function setLinkUrl($linkUrl);
}
