<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Mpdf\Mpdf;

class DownloadInvoicePdfController extends Controller
{
     public function __invoke(Request $request, Invoice $invoice)
    {
        Gate::authorize('view', $invoice);

        $invoice->loadMissing([
            'invoiceItems',
            'project.client',
        ]);

        $html = view('invoices.pdf', [
            'invoice' => $invoice,
            'user' => auth()->user()
        ])->render();

        $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'orientation' => 'P',
                'fontDir' => array_merge((new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'], [
                    storage_path('fonts'),
                ]),
                'fontdata' => (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'] + [
                    'KhmerOSBattambang' => [
                        'R' => 'KhmerOSBattambang.ttf',
                    ],
                ],
                'default_font' => 'KhmerOSBattambang',
            ]);

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output(
                Str::slug($invoice->invoice_number ?: 'invoice') . '.pdf',
                \Mpdf\Output\Destination::STRING_RETURN
            ),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . Str::slug($invoice->invoice_number ?: 'invoice') . '.pdf"',
            ]
        );
    }
}
