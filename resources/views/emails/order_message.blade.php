<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Actualización de Pedido - Mirage</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f5; color: #333; margin: 0; padding: 0; }
        .container { max-w-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 2px solid #f3f4f6; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #1f2937; font-size: 24px; margin: 0; }
        .content { line-height: 1.6; color: #4b5563; }
        .message-box { background-color: #f9fafb; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 0 8px 8px 0; }
        .message-text { font-size: 16px; font-style: italic; color: #1f2937; margin: 0; white-space: pre-wrap; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 30px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Actualización de tu pedido #{{ $order->id }}</h1>
        </div>
        
        <div class="content">
            <p>Hola <strong>{{ $order->customer_name }}</strong>,</p>
            <p>Se ha añadido un nuevo mensaje a tu pedido en nuestra tienda. Aquí tienes los detalles:</p>
            
            <div class="message-box">
                <p class="message-text">{{ $orderMessage->message }}</p>
            </div>
            
            <p>Si tienes alguna pregunta adicional, no dudes en responder a este correo o contactarnos directamente.</p>
            
            <p>Atentamente,<br>El equipo de Mirage</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Mirage. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
