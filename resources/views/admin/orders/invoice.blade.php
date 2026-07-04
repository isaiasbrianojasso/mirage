<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .item-row td {
            text-align: left !important;
        }
        .item-row td.right {
            text-align: right !important;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                @if($company && $company->logo_path)
                                    <img src="{{ public_path('storage/' . $company->logo_path) }}" style="max-height: 80px;" alt="Logo" />
                                @else
                                    <strong>{{ $company->company_name ?? 'Nuestra Empresa' }}</strong>
                                @endif
                            </td>
                            <td>
                                <strong>Factura #:</strong> {{ $order->id }}<br />
                                <strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y') }}<br />
                                <strong>Estado:</strong> {{ ucfirst($order->status) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong>Datos de la Empresa:</strong><br />
                                {{ $company->company_name ?? 'Empresa' }}<br />
                                {{ $company->address ?? 'Dirección no configurada' }}<br />
                                {{ $company->contact_email ?? '' }}<br />
                                {{ $company->contact_phone ?? '' }}
                            </td>
                            <td>
                                <strong>Facturar a:</strong><br />
                                {{ $invoiceAddress->first_name ?? $user->name }} {{ $invoiceAddress->last_name ?? '' }}<br />
                                {{ $invoiceAddress->address1 ?? 'Sin dirección' }}<br />
                                {{ $invoiceAddress->city ?? '' }}, {{ $invoiceAddress->state ?? '' }} {{ $invoiceAddress->zip_code ?? '' }}<br />
                                {{ $user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">Método de Pago</td>
                <td colspan="2" class="text-right">Transportista</td>
            </tr>
            <tr class="details">
                <td colspan="2">{{ $order->payment_method ?? 'Pendiente' }}</td>
                <td colspan="2" class="text-right">{{ $order->carrier->name ?? 'No especificado' }}</td>
            </tr>

            <tr class="heading">
                <td>Artículo</td>
                <td class="text-center" style="text-align: center !important;">Precio Unitario</td>
                <td class="text-center" style="text-align: center !important;">Cantidad</td>
                <td class="text-right">Total</td>
            </tr>

            @foreach($order->items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }} item-row">
                <td>{{ $item->product_name }}</td>
                <td class="text-center" style="text-align: center !important;">${{ number_format($item->unit_price, 2) }}</td>
                <td class="text-center" style="text-align: center !important;">{{ $item->quantity }}</td>
                <td class="text-right right">${{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="3" class="text-right right"><strong>Subtotal:</strong></td>
                <td class="text-right right">${{ number_format($order->subtotal, 2) }}</td>
            </tr>
            
            <tr class="item-row">
                <td colspan="3" class="text-right right">Costo de Envío:</td>
                <td class="text-right right">${{ number_format($order->shipping_cost, 2) }}</td>
            </tr>
            
            @if($order->tax_amount > 0)
            <tr class="item-row">
                <td colspan="3" class="text-right right">Impuestos:</td>
                <td class="text-right right">${{ number_format($order->tax_amount, 2) }}</td>
            </tr>
            @endif

            <tr class="total">
                <td colspan="3" class="text-right right"><strong>Gran Total:</strong></td>
                <td class="text-right right"><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
