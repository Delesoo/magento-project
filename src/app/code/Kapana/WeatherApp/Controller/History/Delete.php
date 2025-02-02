<?php

namespace Kapana\WeatherApp\Controller\History;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Kapana\WeatherApp\Model\WeatherHistory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;

class Delete extends Action
{
    /**
     * @var WeatherHistory
     */
    protected $weatherHistory;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        Context          $context,
        WeatherHistory   $weatherHistory,
        RedirectFactory  $resultRedirectFactory,
        ManagerInterface $messageManager
    )
    {
        $this->weatherHistory = $weatherHistory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        // Get the record ID from the request parameter
        $recordId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($recordId) {
            try {
                // Load and delete the record
                $record = $this->weatherHistory->load($recordId);
                if ($record->getId()) {
                    $record->delete();
                    $this->messageManager->addSuccessMessage(__('Record deleted successfully.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Record not found.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error deleting record: %1', $e->getMessage()));
            }
        } else {
            $this->messageManager->addErrorMessage(__('No record ID provided.'));
        }

        // Redirect back to your historical data page (adjust the path as needed)
        return $resultRedirect->setPath('weather/index/index');
    }
}
