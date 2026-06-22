<x-filament-panels::page>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            html,
            body,
            #quotation-print-area,
            #quotation-print-area * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            body {
                margin: 0;
                padding: 20px;
                background: #ffffff;
                font-family: 'Battambang', 'Poppins', sans-serif;
            }

            body * {
                visibility: hidden;
            }

            #quotation-print-area,
            #quotation-print-area * {
                visibility: visible;
            }

            #quotation-print-area {
                position: absolute;
                inset: 0;
                width: 100%;
                max-width: none;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            #quotation-print-area .print-document-header {
                background-color: #f3f4f6 !important;
            }

            #quotation-print-area .print-table-header {
                background-color: #f9fafb !important;
            }
        }
    </style>

    <div id="quotation-print-area" class="w-full max-w-6xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="print-document-header bg-gray-100 flex justify-between items-start p-10 border-b border-gray-200">

            <div>
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

            <div class="text-right">

                <p class="uppercase tracking-widest text-xs text-gray-500 font-semibold">
                    QUOTATION
                </p>

                <h1 class="text-3xl font-bold mt-1">
                    {{ $quotation->quote_number }}
                </h1>

                <p class="text-gray-500 mt-3">
                    {{ __('quotation.issued_at') }}
                    {{ \Carbon\Carbon::parse($quotation->issued_at)->translatedFormat('d-M-Y') }}
                    -
                    {{ __('quotation.expired_at') }}
                    {{ \Carbon\Carbon::parse($quotation->expired_at)->translatedFormat('d-M-Y') }}
                </p>

            </div>

        </div>



        {{-- Client & Project --}}
        <div class="grid grid-cols-2 border-b border-gray-200">

            {{-- Client --}}
            <div class="p-10">

                <p class="uppercase text-xs tracking-widest text-gray-500 font-semibold">
                    {{ __('quotation.bill_to') }}
                </p>

                <h3 class="text-3xl font-bold text-gray-900 mt-3">
                    {{ $quotation->client->name }}
                </h3>

                <div class="mt-3 space-y-1 text-gray-500">
                    <p>{{ $quotation->client->email }}</p>

                    <p>{{ $quotation->client->phone }}</p>

                    <p>{{ $quotation->client->address }}</p>
                </div>
            </div>

            {{-- Project --}}
            <div class="p-10">

                <p class="uppercase text-xs tracking-widest text-gray-500 font-semibold">
                    {{ __('quotation.project') }}
                </p>

                <h3 class="text-3xl font-bold text-gray-900 mt-3">
                    {{ $quotation->project?->title }}
                </h3>

                <p class="text-gray-500 mt-2">
                    {{ $quotation->description }}
                </p>

            </div>

        </div>



        {{-- Items --}}
        <table class="w-full">
            <thead class="print-table-header bg-gray-50">
            <tr class="text-left">
                <th class="px-8 py-5 uppercase text-xs text-gray-500">
                    {{ __('quotation.description') }}
                </th>
                <th class="px-8 py-5 text-center uppercase text-xs text-gray-500 w-28">
                    {{ __('quotation.qty') }}
                </th>
                <th class="px-8 py-5 text-right uppercase text-xs text-gray-500 w-40">
                    {{ __('quotation.price') }}
                </th>
                <th class="px-8 py-5 text-right uppercase text-xs text-gray-500 w-40">
                    {{ __('quotation.total') }}
                </th>

            </tr>
            </thead>
            <tbody>

            @foreach($quotation->quotationItems as $item)
                <tr class="border-t border-gray-200">
                    <td class="px-8 py-5">
                        <h4 class="font-semibold text-gray-900 text-lg">
                            {{ $item->name }}
                        </h4>
                        <p class="text-gray-500 mt-1">
                            {{ $item->description }}
                        </p>
                    </td>
                    <td class="text-center">
                        {{ $item->qty }}
                    </td>
                    <td class="text-right pr-8">
                        ${{ number_format($item->price,2) }}
                    </td>
                    <td class="text-right pr-8 font-semibold text-lg">
                        ${{ number_format($item->qty * $item->price,2) }}
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>



        {{-- Total --}}
        <div class="flex justify-end border-t border-gray-200">
            <div class="w-96 p-10">
                <div class="flex justify-between py-2">
                    <span class="text-gray-500">
                        {{ __('quotation.sub_total') }}
                    </span>
                    <span>
                        ${{ number_format($quotation->quotationItems->sum(fn($i)=>$i->qty*$i->price),2) }}
                    </span>
                </div>

                <div class="flex justify-between py-2">

                    <span class="text-gray-500">
                        {{ __('quotation.discount') }}
                    </span>

                    <span>
                        ${{ $quotation->discount }}
                    </span>

                </div>

                <div class="flex justify-between py-2">

                    <span class="text-gray-500">
                        {{ __('quotation.tax') }}
                    </span>

                    <span>
                        %{{ $quotation->tax }}
                    </span>

                </div>

                <div class="border-t mt-4 pt-5 flex justify-between">

                    <span class="text-3xl font-bold">
                        {{ __('quotation.total') }}
                    </span>

                    <span class="text-4xl font-bold text-indigo-600">
                        ${{ number_format($quotation->total,2) }}
                    </span>

                </div>

            </div>

        </div>

    </div>
</x-filament-panels::page>
