<?php

namespace Kapana\WeatherApp\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use dompdf\dompdf;

class Pdf extends Action
{
    /**
     * @var FileFactory
     */
    protected $fileFactory;

    public function __construct(
        Context     $context,
        FileFactory $fileFactory
    )
    {
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
    }

    public function execute()
    {
        $htmlContent = '<h1>Weather History</h1>';
        $htmlContent .= '<table border="1"><tr><th>City</th><th>Date</th><th>Data</th></tr>';
        $htmlContent .= '</table>';

        $pdfContent = $this->generatePdfFromHtml($htmlContent);

        $fileName = 'weather_history.pdf';
        return $this->fileFactory->create(
            $fileName,
            $pdfContent,
            \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
            'application/pdf'
        );
    }

    protected function generatePdfFromHtml($html)
    {
        // Instantiate DomPDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}
