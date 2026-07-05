<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Pedido</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 20px; color: #374151; }
        .container { max-w-2xl mx-auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #111827; font-size: 24px; }
        .details { margin-bottom: 20px; }
        .details h3 { margin-bottom: 10px; color: #111827; }
        .details p { margin: 5px 0; }
        table { w-full border-collapse; width: 100%; margin-bottom: 20px; }
        th, td { border-bottom: 1px solid #e5e7eb; padding: 12px 8px; text-align: left; }
        th { background-color: #f3f4f6; color: #374151; font-weight: 600; }
        .total-row td { font-weight: bold; font-size: 16px; border-top: 2px solid #d1d5db; }
        .footer { text-align: center; font-size: 12px; color: #6b7280; margin-top: 30px; border-top: 1px solid #e5e7eb; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Gracias por tu compra, {{ $order->customer_name }}!</h1>
            <p>Tu pedido ha sido procesado exitosamente.</p>
        </div>

        <div class="details">
            <h3>Detalles del Pedido #{{ $order->id }}</h3>
            <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Método de pago:</strong> {{ ucfirst($order->payment_method) }}</p>
            @if($order->transaction_id)
                <p><strong>ID Transacción:</strong> {{ $order->transaction_id }}</p>
            @endif
            <p><strong>Estado:</strong> {{ ucfirst($order->payment_status) }}</p>
        </div>

        <div class="details">
            <h3>Datos de Envío</h3>
            <p>{{ $order->shipping_address }}</p>
            <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
            <p>Tel: {{ $order->customer_phone }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Costo de Envío</td>
                    <td>${{ number_format($order->shipping_cost, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Total Pagado</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
            <p>&copy; {{ date('Y') }} Mirage. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
