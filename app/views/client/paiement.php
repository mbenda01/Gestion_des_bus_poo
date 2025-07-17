<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement du Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #d1d8e0);
            font-family: 'Segoe UI', sans-serif;
        }

        .payment-card {
            max-width: 700px;
            margin: 3rem auto;
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            text-align: center;
        }

        .payment-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #224abe;
            margin-bottom: 1rem;
        }

        .amount-box {
            font-size: 1.4rem;
            font-weight: 600;
            color: #1e88e5;
            margin-bottom: 2rem;
            background-color: #f0f7ff;
            border-radius: 10px;
            padding: 1rem;
            display: inline-block;
        }

        .payment-options img {
            width: 120px;
            height: auto;
            margin: 0 1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .payment-options img:hover {
            transform: scale(1.1);
        }

        .btn-retour {
            margin-top: 2rem;
        }

        .qr-code {
            width: 200px;
        }
    </style>
</head>
<body>

<?php
$prix = $_POST['prix'] ?? '0';
?>

<div class="payment-card">
    <h2 class="payment-title">Paiement du ticket</h2>
    <div class="amount-box">
        Montant : <strong><?= htmlspecialchars($prix) ?> FCFA</strong>
    </div>

    <p class="mb-4">Choisissez un moyen de paiement :</p>

    <div class="payment-options d-flex justify-content-center gap-4">
        <img src="../assets/uploads/OM.png" alt="Orange Money" data-bs-toggle="modal" data-bs-target="#qrModal" style="height: 80px; cursor: pointer;">
        <img src="../assets/uploads/WE.png" alt="Wave" data-bs-toggle="modal" data-bs-target="#qrModal" style="height: 80px; cursor: pointer;">
    </div>


    <a href="index.php?action=clientDashboard" class="btn btn-secondary btn-retour">
        <i class="fas fa-arrow-left me-1"></i> Retour au tableau de bord
    </a>
</div>

<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Paiement effectué</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <img src="https://api.qrserver.com/v1/create-qr-code/?data=TransitFlow-Ticket&size=200x200" alt="QR Code" class="qr-code mb-3">
                <p class="text-success fw-bold">✅ Paiement réussi !</p>
                <p class="text-muted">Voici votre code QR à présenter au contrôleur.</p>
            </div>
            <div class="modal-footer">
                <a href="index.php?action=clientDashboard" class="btn btn-primary">
                    <i class="fas fa-home me-1"></i> Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
