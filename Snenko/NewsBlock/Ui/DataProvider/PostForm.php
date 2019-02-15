<?php


namespace Snenko\NewsBlock\Ui\DataProvider;


use Magento\Framework\App\Request\DataPersistorInterface;
use Snenko\NewsBlock\Model\ResourceModel\Posts\CollectionFactory;


class PostForm extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $collection;

    protected $dataPersistor;


    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $model->getId();
            $data = $model->getData();

            /* Prepare Featured Image */
            if (isset($data['image'])) {
                $name = $data['image'];
                unset($data['image']);
                $data['image'][0] = [
                    'name' => $name,
                    'url' => $model->getImageFullUrl(),
                ];
            }

            if(isset($data['store_id']) && $data['store_id']) {
                if($storeId = $data['store_id']) {

                }
            }

            $this->loadedData[$model->getId()] = $data;
        }
        $data = $this->dataPersistor->get('snenko_newsblock');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('snenko_newsblock');
        }
        
        return $this->loadedData;
    }
}
