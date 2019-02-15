<?php


namespace Snenko\NewsBlock\Model\ResourceModel\Labels;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Snenko\NewsBlock\Model\Labels::class,
            \Snenko\NewsBlock\Model\ResourceModel\Labels::class
        );
    }

    public function toOptionArray()
    {
        return $this->_toOptionArray('labels_id', 'name');
    }
}
