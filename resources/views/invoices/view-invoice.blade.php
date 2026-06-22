<x-filament-panels::page>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
                background: #ffffff;
                font-family: 'Battambang', 'Poppins', sans-serif;
            }

            body * {
                visibility: hidden;
            }

            #invoice-print-area,
            #invoice-print-area * {
                visibility: visible;
            }

            #invoice-print-area {
                position: absolute;
                inset: 0;
                width: 100%;
                max-width: none;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>

    <div id="invoice-print-area" class="w-full max-w-6xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="bg-gray-100 px-10 py-8 flex justify-between border-b border-gray-200">

        {{-- Company --}}
        <div class="flex gap-4">
            <div class="flex items-start flex-col gap-3">
                <div class="flex align-center justify-center gap-2">
                    <!-- <div class="w-10 h-10 rounded-xl bg-indigo-600"></div> -->
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ auth()->user()->company_name ?? auth()->user()->name }}
                    </h2>
                </div>
                <div>
                    <p class="text-gray-500 mt-1">
                        {{ auth()->user()->phone_number }}
                    </p>
                    <p class="text-gray-500 mt-1">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Invoice --}}
        <div class="text-right">

            <p class="uppercase text-xs tracking-widest text-gray-500">
                Invoice
            </p>

            <h2 class="text-4xl font-bold mt-1">
                {{ $invoice->invoice_number }}
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                 {{ __('invoice.issued_at') }}
                    {{ \Carbon\Carbon::parse($invoice->created_at)->translatedFormat('d-M-Y') }}
            </p>

        </div>

    </div>



    {{-- Client --}}
    <div class="grid grid-cols-2 gap-20 px-10 py-10">

        <div>

            <p class="text-xs uppercase text-gray-400 tracking-wide mb-1">
                {{ __('invoice.bill_to') }}
            </p>

            <h3 class="font-semibold text-lg">
                {{ $invoice->project->client->name }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ $invoice->project->client->email }}
            </p>

        </div>


        <div>

            <p class="text-xs uppercase text-gray-400 tracking-wide mb-1">
                {{ __('invoice.project') }}
            </p>

            <h3 class="font-semibold text-lg">
                {{ $invoice->project->title }}
            </h3>

        </div>

    </div>



    {{-- Items --}}
    <div class="px-10">

        <table class="w-full">

            <thead>

            <tr class="bg-gray-100 text-gray-500 text-xs uppercase">

                <th class="text-left py-3 px-3">
                    {{ __('invoice.description') }}
                </th>

                <th class="text-center">
                    {{ __('invoice.qty') }}
                </th>

                <th class="text-right">
                    {{ __('invoice.price') }}
                </th>

                <th class="text-right pr-3">
                    {{ __('invoice.total') }}
                </th>

            </tr>

            </thead>

            <tbody>

            @foreach($invoice->invoiceItems as $item)

                <tr class="border-b border-gray-200">

                    <td class="py-4 px-3">

                        <div class="font-medium">
                            {{ $item->name }}
                        </div>

                        @if($item->description)
                            <div class="text-sm text-gray-500 mt-1">
                                {{ $item->description }}
                            </div>
                        @endif

                    </td>

                    <td class="text-center">
                        {{ $item->qty }}
                    </td>

                    <td class="text-right">
                        ${{ number_format($item->price,2) }}
                    </td>

                    <td class="text-right pr-3 font-semibold">
                        ${{ number_format($item->qty * $item->price,2) }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>




    {{-- Summary --}}
    <div class="flex justify-end px-10 mt-6">

        <div class="w-80">

            <div class="flex justify-between py-1">

                <span class="text-gray-500">
                    {{ __('invoice.sub_total') }}
                </span>

                <span>
                    ${{ number_format($invoice->invoiceItems->sum(fn($i)=>$i->qty*$i->price),2) }}
                </span>

            </div>
            <div class="flex justify-between py-1">

                <span class="text-gray-500">
                    {{ __('invoice.discount') }}
                </span>

                <span>
                    ${{ $invoice->discount }}
                </span>

            </div>
            <div class="flex justify-between py-1">

                <span class="text-gray-500">
                    {{ __('invoice.tax') }}
                </span>

                <span>
                    %{{ $invoice->tax }}
                </span>

            </div>

            <div class="border-t my-3"></div>

            <div class="flex justify-between items-center">

                <span class="text-3xl font-bold">
                    {{ __('invoice.total') }}
                </span>

                <span class="text-3xl font-bold text-indigo-600">
                    ${{ number_format($invoice->total,2) }}
                </span>

            </div>

            <div class="flex justify-between mt-4">

                <span class="text-gray-500">
                    {{ __('invoice.paid') }}
                </span>

                <span class="text-green-600">
                    ${{ number_format($invoice->paid_amount,2) }}
                </span>

            </div>

            <div class="flex justify-between">

                <span class="font-semibold">
                    {{ __('invoice.due') }}
                </span>

                <span class="font-semibold">
                    ${{ number_format($invoice->due_amount,2) }}
                </span>

            </div>

        </div>

    </div>




    {{-- Push Footer --}}
    <div class="h-[340px]"></div>




    {{-- Notes --}}
    <!-- <div class="px-10">

        <div class="border-t pt-6">

            <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                Notes
            </p>

            <p class="text-sm text-gray-600">
                Please reference the invoice number when making your payment.
                Late payments may incur a monthly fee.
            </p>

        </div>

    </div> -->




    {{-- Footer --}}
    <!-- <div class="flex justify-between text-xs text-gray-500 px-10 py-8">

        <span>
            {{ auth()->user()->company_name }}
            •
            {{ $invoice->invoice_number }}
        </span>

        <span>
            Generated with Your App
        </span>

    </div> -->

</div>
</x-filament-panels::page>
