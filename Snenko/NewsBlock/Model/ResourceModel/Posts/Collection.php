<?php


namespace Snenko\NewsBlock\Model\ResourceModel\Posts;

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
            \Snenko\NewsBlock\Model\Posts::class,
            \Snenko\NewsBlock\Model\ResourceModel\Posts::class
        );
    }

    public function addLabelFields($storeId=null)
    {
        $this->getSelect()->joinleft(
            ['labels_table' => $this->getTable('snenko_newsblock_labels')],
            'main_table.label = labels_table.labels_id',
            ['label_content'=>'content', 'label_name'=>'name']
        );
    }
}
