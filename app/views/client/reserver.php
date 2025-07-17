<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation de Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f0f2f5, #dfe9f3);
            font-family: 'Segoe UI', sans-serif;
        }

        .reservation-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            max-width: 700px;
            margin: 2rem auto;
        }

        .form-title {
            text-align: center;
            font-weight: bold;
            color: #4e73df;
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        select, input {
            border-radius: 10px;
        }

        .prix-box {
            background-color: #e9f0fc;
            padding: 1rem;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #1c4fc5;
            text-align: center;
            margin-top: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border: none;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
        }
    </style>
</head>
<body>

<div class="reservation-card">
    <h2 class="form-title">Réservation de Ticket</h2>

    <form method="POST" action="index.php?action=paiementTicket">
        <div class="mb-3">
            <label for="ligne" class="form-label">Ligne</label>
            <select name="ligne" id="ligne" class="form-select" required>
                <option value="" hidden>Choisissez une ligne</option>
                <?php for ($i = 1; $i <= 15; $i++): ?>
                    <option value="LIG-<?= str_pad($i, 3, '0', STR_PAD_LEFT) ?>">
                        LIG-<?= str_pad($i, 3, '0', STR_PAD_LEFT) ?>
                    </option>
                <?php endfor; ?>
            </select>
            <div id="tempsBus" class="form-text mt-1 text-success d-none">Le bus arrive dans 15 minutes.</div>
        </div>

        <div class="mb-3">
            <label for="type_trajet" class="form-label">Type de trajet</label>
            <select name="type_trajet" id="type_trajet" class="form-select" required>
                <option value="" hidden>Aller ou Retour</option>
                <option value="Aller">Aller</option>
                <option value="Retour">Retour</option>
            </select>
        </div>

        <?php
        $arrets = [
            "Avenue Pl 52, 122", "Avenue Peytavin 64", "Rue Du Liban, 56", "Rue Pl 70, 132",
            "Avenue Jean Jaures, 4", "Av. Diagne / Rue Marsat", "Rue M'Baye Worre, 112",
            "Rue Gornarov Gueye, 23", "Rue 18, 17", "Avenue Cheikh Anta Diop, 19",
            "Avenue Cheikh Anta Diop, 4", "Boulevard Canal Vi, 7", "Rue Fa 29, 55",
            "École Nationale", "Rue 98, 102", "Rue Gd 60, 347", "Rue Diourom, 12",
            "Rue Gd 22, 81", "Arrêt De Bus", "Rue Lib 240, 1322", "Rue Lib 160, 5424",
            "Rue Dd 44, 5467", "Rue Dd 20, 5482", "Gy-101, 13", "Samu Municipal",
            "Voie De Degagement Nord, 44", "Rue Yf 170, 123", "École Japonaise"
        ];
        ?>

        <div class="mb-3">
            <label for="arret_depart" class="form-label">Arrêt de départ</label>
            <select name="arret_depart" id="arret_depart" class="form-select" required>
                <option value="" hidden>Choisissez un arrêt</option>
                <?php foreach ($arrets as $arret): ?>
                    <option value="<?= htmlspecialchars($arret) ?>"><?= htmlspecialchars($arret) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="arret_arrivee" class="form-label">Arrêt d’arrivée</label>
            <select name="arret_arrivee" id="arret_arrivee" class="form-select" required>
                <option value="" hidden>Choisissez un arrêt</option>
                <?php foreach ($arrets as $arret): ?>
                    <option value="<?= htmlspecialchars($arret) ?>"><?= htmlspecialchars($arret) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="prix-box" id="prixBox" style="display: none;">
            Prix : <span id="prix">0</span> FCFA
        </div>

        <input type="hidden" name="prix" id="prixInput" value="">

        <div class="form-actions">
            <a href="index.php?action=clientDashboard" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> Réserver
            </button>
        </div>
    </form>
</div>

<script>
    const ligneSelect = document.getElementById("ligne");
    const arretArriveeSelect = document.getElementById("arret_arrivee");
    const prixBox = document.getElementById("prixBox");
    const prixSpan = document.getElementById("prix");
    const prixInput = document.getElementById("prixInput");
    const tempsBus = document.getElementById("tempsBus");

    ligneSelect.addEventListener("change", () => {
        tempsBus.classList.remove("d-none");
    });

    arretArriveeSelect.addEventListener("change", () => {
        const prix = [200, 250, 300, 350][Math.floor(Math.random() * 4)];
        prixSpan.textContent = prix;
        prixInput.value = prix;
        prixBox.style.display = "block";
    });
</script>

</body>
</html>
