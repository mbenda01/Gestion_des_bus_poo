<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .section-title {
            border-left: 5px solid #4e73df;
            padding-left: 10px;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 20px;
            color: #4e73df;
        }

        .notification-card {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            margin-bottom: 15px;
            padding: 1.2rem;
            transition: 0.2s;
        }

        .notification-card:hover {
            background-color: #f0f4ff;
        }

        .notification-title {
            font-weight: bold;
            color: #343a40;
        }

        .notification-text {
            margin-bottom: 10px;
            color: #555;
        }

        .notification-footer {
            font-size: 0.85rem;
            color: #888;
        }

        .notification-actions button {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4"><i class="fas fa-bell"></i> Notifications</h2>

    <div class="section-title">📬 Non lues</div>

    <div class="notification-card">
        <div class="notification-title">Bus en approche</div>
        <div class="notification-text">Votre bus LIG-003 arrive dans 10 minutes à Avenue Pl 52, 122.</div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="notification-footer">07/07/2025 09:10</div>
            <div class="notification-actions">
                <button class="btn btn-sm btn-outline-success">Marquer comme lue</button>
                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
            </div>
        </div>
    </div>

    <div class="notification-card">
        <div class="notification-title">Maintenance terminée</div>
        <div class="notification-text">Le bus affecté à votre trajet retour est à nouveau disponible.</div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="notification-footer">06/07/2025 15:00</div>
            <div class="notification-actions">
                <button class="btn btn-sm btn-outline-success">Marquer comme lue</button>
                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
            </div>
        </div>
    </div>

    <div class="section-title">📖 Lues</div>

    <div class="notification-card bg-light">
        <div class="notification-title">Confirmation de réservation</div>
        <div class="notification-text">Votre ticket pour LIG-005 a été confirmé.</div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="notification-footer">05/07/2025 08:30</div>
            <div class="notification-actions">
                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
            </div>
        </div>
    </div>

    <div class="notification-card bg-light">
        <div class="notification-title">Paiement reçu</div>
        <div class="notification-text">Le paiement de 250 FCFA a bien été reçu.</div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="notification-footer">04/07/2025 10:15</div>
            <div class="notification-actions">
                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
