<?php

namespace Snenko\NewsBlock\Ui\Component\Listing\Column\Label;


use Magento\Framework\Data\OptionSourceInterface;
use Snenko\NewsBlock\Model\ResourceModel\Labels\CollectionFactory;

/**
 * @api
 * @since 100.1.0
 */
class Options implements OptionSourceInterface
{

    /**
     * @var array
     */
    protected $options;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options === null) {
            $this->options = $this->collectionFactory->create()->toOptionArray();
        }
        return $this->options;
    }
}

