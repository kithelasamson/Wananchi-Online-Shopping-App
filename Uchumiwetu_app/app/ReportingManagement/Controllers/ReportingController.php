<?php
namespace App\Reporting\Controllers;
use App\Http\Controllers\Controller;
use App\Reporting\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function generateSalesReport()
    {
        $salesReport = $this->reportService->generateSalesReport();
        return response()->json($salesReport);
    }

    public function generateProductReport()
    {
        $productReport = $this->reportService->generateProductReport();
        return response()->json($productReport);
    }
}
