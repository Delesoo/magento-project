<?php

namespace Kapana\WeatherApp\Controller\Index;

use AllowDynamicProperties;
use Kapana\WeatherApp\Model\Weather;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


#[AllowDynamicProperties] class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory,
        Weather     $weatherModel
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->weatherModel = $weatherModel;
    }

    public function execute()
    {
        // Get the city parameter; default to 'Tbilisi'
        $city = $this->getRequest()->getParam('city', 'Tbilisi');

        // Get current weather data
        $weatherData = $this->weatherModel->getWeatherByCity($city);

        // Save historical data only if the request method is POST.
        // Delete existing historical records for this city to ensure only one record remains.
        if ($this->getRequest()->getMethod() === \Magento\Framework\App\Request\Http::METHOD_POST) {
            $collection = $this->_objectManager
                ->create(\Kapana\WeatherApp\Model\ResourceModel\WeatherHistory\Collection::class)
                ->addFieldToFilter('city', ['eq' => $city]);
            foreach ($collection as $record) {
                $record->delete();
            }

            // Save the new record.
            $data = [
                'city' => $city,
                'weather_data' => json_encode($weatherData),
            ];
            $weatherHistoryModel = $this->_objectManager->create(\Kapana\WeatherApp\Model\WeatherHistory::class);
            $weatherHistoryModel->setData($data);
            $weatherHistoryModel->save();
        }


        $resultPage = $this->resultPageFactory->create();
        $block = $resultPage->getLayout()->getBlock('weather_data');
        if ($block) {
            $block->setData('city', $city);
            $block->setData('weather_data', $weatherData);
        }

        return $resultPage;

    }
}
