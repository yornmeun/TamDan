<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
       body {
            margin: 0;
            padding: 20px;
            background: #ffffff;
            font-family: 'Battambang', 'Poppins', sans-serif;
        }

        @page { margin: 32px; }
        body { color: #111827; font-family: 'KhmerOSBattambang', DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.5; }
        table { border-collapse: collapse; width: 100%; }
        th { background: #f3f4f6; color: #4b5563; font-size: 10px; letter-spacing: .04em; text-transform: uppercase; }
        th, td { border-bottom: 1px solid #e5e7eb; padding: 10px; vertical-align: top; }
        .header { background: #f3f4f6; border-bottom: 1px solid #e5e7eb; margin: -32px -32px 32px; padding: 28px 32px; }
        .muted { color: #6b7280; }
        .title { font-size: 28px; font-weight: 700; margin: 0; }
        .company { font-size: 20px; font-weight: 700; margin: 0 0 8px; }
        .right { text-align: right; }
        .center { text-align: center; }
        .section { margin-bottom: 28px; }
        .grid { width: 100%; }
        .grid td { border: 0; padding: 0; width: 50%; }
        .label { color: #6b7280; font-size: 10px; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; }
        .summary { margin-left: auto; margin-top: 24px; width: 280px; }
        .summary td { border: 0; padding: 4px 0; }
        .summary .divider td { border-top: 1px solid #d1d5db; padding-top: 12px; }
        .total { color: #4f46e5; font-size: 22px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="border:0; padding:0;">
                    <p class="company">{{ $user->company_name ?? $user->name }}</p>
                    <div class="muted">{{ $user->phone_number }}</div>
                    <div class="muted">{{ $user->email }}</div>
                </td>
                <td class="right" style="border:0; padding:0;">
                    <div class="label">Invoice</div>
                    <h1 class="title">{{ $invoice->invoice_number }}</h1>
                    <div class="muted">{{ __('invoice.issued_at') }} {{ \Carbon\Carbon::parse($invoice->created_at)->translatedFormat('d-M-Y') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="grid section">
        <tr>
            <td>
                <div class="label">{{ __('invoice.bill_to') }}</div>
                <h2>{{ $invoice->project->client->name }}</h2>
                <div class="muted">{{ $invoice->project->client->email }}</div>
                <div class="muted">{{ $invoice->project->client?->phone }}</div>
                <div class="muted">{{ $invoice->project->client?->address }}</div>
            </td>
            <td>
                <div class="label">{{ __('invoice.project') }}</div>
                <h2>{{ $invoice->project->title }}</h2>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="text-align:left;">{{ __('invoice.description') }}</th>
                <th class="center" style="width:70px;">{{ __('invoice.qty') }}</th>
                <th class="right" style="width:100px;">{{ __('invoice.price') }}</th>
                <th class="right" style="width:110px;">{{ __('invoice.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->invoiceItems as $item)
                <tr>
                    <td>
                        <strong>{{ $item->name }}</strong>
                        @if($item->description)
                            <div class="muted">{{ $item->description }}</div>
                        @endif
                    </td>
                    <td class="center">{{ $item->qty }}</td>
                    <td class="right">${{ number_format($item->price, 2) }}</td>
                    <td class="right"><strong>${{ number_format($item->qty * $item->price, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td class="muted">{{ __('invoice.sub_total') }}</td>
            <td class="right">${{ number_format($invoice->invoiceItems->sum(fn ($item) => $item->qty * $item->price), 2) }}</td>
        </tr>
        <tr>
            <td class="muted">{{ __('invoice.discount') }}</td>
            <td class="right">${{ $invoice->discount }}</td>
        </tr>
        <tr>
            <td class="muted">{{ __('invoice.tax') }}</td>
            <td class="right">%{{ $invoice->tax }}</td>
        </tr>
        <tr class="divider">
            <td><strong>{{ __('invoice.total') }}</strong></td>
            <td class="right total">${{ number_format($invoice->total, 2) }}</td>
        </tr>
    </table>
</body>
</html>
