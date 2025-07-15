<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function generateReport()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('admin.report_pdf', compact('complaints'));
        return $pdf->download('complaints_report.pdf');
    }

    public function exportData()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        $csv = "ID,Subject,Status,Student,Date\n";
        foreach ($complaints as $c) {
            $csv .= "{$c->id},\"{$c->subject}\",{$c->status},\"{$c->student}\",{$c->created_at}\n";
        }
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=\"cms_data_export.csv\"');
    }
}
