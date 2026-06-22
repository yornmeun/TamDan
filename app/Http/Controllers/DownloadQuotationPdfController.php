<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class DownloadQuotationPdfController extends Controller
{
    public function __invoke(Request $request, Quotation $quotation)
    {
        Gate::authorize('view', $quotation);

        Gate::authorize('view', $quotation);

        $quotation->loadMissing([
            'quotationItems',
            'project.client',
        ]);

        $html = view('quotations.pdf', [
            'quotation' => $quotation,
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
                Str::slug($quotation->quotation_number ?: 'quotation') . '.pdf',
                \Mpdf\Output\Destination::STRING_RETURN
            ),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . Str::slug($quotation->quotation_number ?: 'quotation') . '.pdf"',
            ]
        );
    }
}
