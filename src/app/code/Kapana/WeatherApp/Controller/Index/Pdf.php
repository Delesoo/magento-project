<?php

namespace Kapana\WeatherApp\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Dompdf\Dompdf;

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
        // 1. Retrieve filtered data (this can be based on parameters or session storage)
        // For this example, we'll assume we already have our HTML content prepared.
        $htmlContent = '<h1>Weather History</h1>';
        $htmlContent .= '<table border="1"><tr><th>City</th><th>Date</th><th>Data</th></tr>';
        // Loop through your data and build table rows here:
        // foreach ($data as $row) { ... }
        $htmlContent .= '</table>';

        // 2. Generate PDF using DomPDF
        $pdfContent = $this->generatePdfFromHtml($htmlContent);

        // 3. Force download using FileFactory
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
