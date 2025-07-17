<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 4rem;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .table th {
            background-color: #f1f3f5;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header text-center py-4">
            <h3><i class="fas fa-history me-2"></i>Historique de mes réservations</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ligne</th>
                            <th>Type</th>
                            <th>Départ</th>
                            <th>Arrivée</th>
                            <th>Prix</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>LIG-003</td>
                            <td><span class="badge bg-primary">Aller</span></td>
                            <td>Avenue Pl 52, 122</td>
                            <td>Rue Fa 29, 55</td>
                            <td>250 FCFA</td>
                            <td>2025-07-01 09:15</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>LIG-007</td>
                            <td><span class="badge bg-success">Retour</span></td>
                            <td>Rue Du Liban, 56</td>
                            <td>École Japonaise</td>
                            <td>300 FCFA</td>
                            <td>2025-07-02 15:30</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>LIG-002</td>
                            <td><span class="badge bg-primary">Aller</span></td>
                            <td>Rue 98, 102</td>
                            <td>Rue Yf 170, 123</td>
                            <td>200 FCFA</td>
                            <td>2025-07-03 08:45</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>LIG-010</td>
                            <td><span class="badge bg-success">Retour</span></td>
                            <td>Voie De Degagement Nord, 44</td>
                            <td>Rue Lib 160, 5424</td>
                            <td>350 FCFA</td>
                            <td>2025-07-04 18:00</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>LIG-005</td>
                            <td><span class="badge bg-primary">Aller</span></td>
                            <td>Rue M'Baye Worre, 112</td>
                            <td>Rue Dd 44, 5467</td>
                            <td>250 FCFA</td>
                            <td>2025-07-06 07:40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a2e0ffb3d1.js" crossorigin="anonymous"></script>
</body>
</html>
