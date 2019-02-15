<?php


namespace Snenko\NewsBlock\Controller\Adminhtml\Posts;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Model\Block;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Snenko\NewsBlock\Model\Posts;

class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Snenko_NewsBlock::posts_save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $postsRepository;
    protected $postsFactory;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor
//        \Snenko\NewsBlock\Api\PostsRepositoryInterface $postsRepository,
//        \Snenko\NewsBlock\Model\PostsFactory $postsFactory
    ) {
        $this->dataPersistor = $dataPersistor;
//        $this->postsRepository = $postsRepository;
//        $this->postsFactory = $postsFactory;
        parent::__construct($context);
    }

    protected function _beforeSave($model, $request)
    {

        /* Prepare images */
        $data = $model->getData();
        foreach (['image'] as $key) {
            if (isset($data[$key]) && is_array($data[$key])) {
                if (!empty($data[$key]['delete'])) {
                    $model->setData($key, null);
                } else {
                    if (isset($data[$key][0]['name']) && isset($data[$key][0]['tmp_name'])) {
                        $image = $data[$key][0]['name'];
                        $model->setData($key, Posts::BASE_MEDIA_PATH . '/' . $image);
                        $imageUploader = $this->_objectManager->get(
                            \Snenko\NewsBlock\ImageUpload::class
                        );
                        $imageUploader->moveFileFromTmp($image);

                    } else {
                        if (isset($data[$key][0]['name'])) {
                            $model->setData($key, $data[$key][0]['name']);
                        }
                    }
                }
            } else {
                $model->setData($key, null);
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
            $id = $this->getRequest()->getParam('posts_id');
        
            $model = $this->_objectManager->create(\Snenko\NewsBlock\Model\Posts::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Posts no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);

            $this->_beforeSave($model, $this->getRequest());

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Posts.'));
                $this->dataPersistor->clear('snenko_newsblock_posts');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['posts_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Posts.'));
            }
        
            $this->dataPersistor->set('snenko_newsblock_posts', $data);
            return $resultRedirect->setPath('*/*/edit', ['posts_id' => $this->getRequest()->getParam('posts_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
