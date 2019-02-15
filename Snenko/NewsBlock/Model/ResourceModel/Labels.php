<?php


namespace Snenko\NewsBlock\Model\ResourceModel;

class Labels extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('snenko_newsblock_labels', 'labels_id');
    }
}
