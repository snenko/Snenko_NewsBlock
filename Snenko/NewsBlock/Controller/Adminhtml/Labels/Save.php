<?php


namespace Snenko\NewsBlock\Controller\Adminhtml\Labels;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }


    protected function _beforeSave($model, $request)
    {
        $data = $model->getData();
        if(isset($data['store_id']) && $data['store_id']){

            if(is_array($data['store_id'])){
                $model->setData('store_id', implode(",", $data['store_id']));
            }

        }

        return $model;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('labels_id');
        
            $model = $this->_objectManager->create(\Snenko\NewsBlock\Model\Labels::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Labels no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);

            $this->_beforeSave($model, $this->getRequest());

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Labels.'));
                $this->dataPersistor->clear('snenko_newsblock_labels');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['labels_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Labels.'));
            }
        
            $this->dataPersistor->set('snenko_newsblock_labels', $data);
            return $resultRedirect->setPath('*/*/edit', ['labels_id' => $this->getRequest()->getParam('labels_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
