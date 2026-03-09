<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $query = Invoice::whereBetween('invoice_date', [$startDate, $endDate]);

        $totals = [
            'daily_sales' => Invoice::whereDate('invoice_date', now()->toDateString())->sum('total_amount'),
            'monthly_sales' => Invoice::whereMonth('invoice_date', now()->month)->whereYear('invoice_date', now()->year)->sum('total_amount'),
            'eyeglass_sales' => (clone $query)->sum('eyeglass_charges'),
            'medicine_sales' => (clone $query)->sum('medicine_charges'),
            'total_revenue' => (clone $query)->sum('total_amount'),
        ];

        $chartData = Invoice::selectRaw('invoice_date, SUM(total_amount) as total')
            ->whereBetween('invoice_date', [$startDate, $endDate])
            ->groupBy('invoice_date')
            ->orderBy('invoice_date')
            ->get();

        return view('reports.sales', compact('totals', 'chartData', 'startDate', 'endDate'));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $rows = Invoice::with(['patient', 'doctor'])
            ->whereBetween('invoice_date', [$startDate, $endDate])
            ->orderBy('invoice_date')
            ->get();

        $callback = function () use ($rows): void {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Invoice', 'Date', 'Patient', 'Doctor', 'Eye Test', 'Eyeglass', 'Medicine', 'Total', 'Status']);
            foreach ($rows as $row) {
                fputcsv($file, [
                    $row->invoice_number,
                    $row->invoice_date->format('Y-m-d'),
                    optional($row->patient)->name,
                    optional($row->doctor)->name,
                    $row->eye_test_charges,
                    $row->eyeglass_charges,
                    $row->medicine_charges,
                    $row->total_amount,
                    $row->payment_status,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=sales-report.csv',
        ]);
    }
}
