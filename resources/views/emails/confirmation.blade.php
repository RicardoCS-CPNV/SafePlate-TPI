<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de commande</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 2rem; color: #1f2937;">

    <div style="max-width: 600px; margin: auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="background-color: #10b981; color: white; padding: 1.25rem 2rem;">
            <h1 style="margin: 0;">Merci pour votre commande !</h1>
        </div>

        <div style="padding: 2rem;">
            <p>Bonjour {{ $order->user->firstname ?? 'client' }},</p>

            <p>Nous avons bien reçu votre commande. Voici les détails :</p>

            <ul style="margin: 1.5rem 0; padding: 0; list-style: none;">
                <li><strong>Numéro de commande :</strong> {{ $order->id }}</li>
                <li><strong>Date :</strong> {{ $order->ordered_at->format('d.m.Y à H:i') }}</li>
                <li><strong>Total :</strong> {{ number_format($order->total_price, 2) }} CHF</li>
            </ul>

            <h3 style="margin-top: 2rem; font-size: 1.1rem;">Plats commandés :</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                <thead>
                    <tr style="background-color: #f3f4f6;">
                        <th align="left" style="padding: 8px;">Plat</th>
                        <th align="left" style="padding: 8px;">Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->dishes as $dish)
                        <tr>
                            <td style="padding: 8px;">{{ $dish->name }}</td>
                            <td style="padding: 8px;">{{ $dish->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p style="margin-top: 2rem;">Nous allons la préparer avec soin. Vous recevrez une notification dès qu’elle sera prête.</p>

            <p style="margin-top: 2rem;">Cordialement,<br>L’équipe SafePlate</p>
        </div>

        <div style="background-color: #f3f4f6; text-align: center; padding: 1rem; font-size: 0.875rem; color: #6b7280;">
            © {{ now()->year }} SafePlate – Tous droits réservés.
        </div>
    </div>

</body>
</html>
