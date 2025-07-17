<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Parc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), #224abe);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .dashboard-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            opacity: 0.2;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
        }

        .btn-dashboard {
            border-radius: 10px;
            padding: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-success {
            border-left: 5px solid var(--success-color);
        }

        .card-danger {
            border-left: 5px solid var(--danger-color);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="dashboard-header position-relative">
            <h1 class="fw-bold"><i class="fas fa-warehouse me-2"></i>Tableau de bord - Parc</h1>
            <p class="lead">Gestion des bus et conducteurs</p>

            <div class="position-absolute top-0 end-0 p-3">
                <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6 col-md-6">
                <div class="dashboard-card card card-success">
                    <div class="card-body">
                        <i class="fas fa-user-tie card-icon text-success"></i>
                        <h5 class="card-title fw-bold text-success">Conducteurs</h5>
                        <p class="card-text">Liste et gestion des conducteurs</p>
                        <a href="index.php?action=conducteurs" class="btn btn-success btn-dashboard">
                            <i class="fas fa-id-card"></i> Voir les conducteurs
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="dashboard-card card card-danger">
                    <div class="card-body">
                        <i class="fas fa-bus card-icon text-danger"></i>
                        <h5 class="card-title fw-bold text-danger">Bus</h5>
                        <p class="card-text">Inventaire et maintenance des bus</p>
                        <a href="index.php?action=bus" class="btn btn-danger btn-dashboard">
                            <i class="fas fa-tachometer-alt"></i> Voir les bus
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="h1 text-success">28</div>
                                <div class="text-muted">Conducteurs enregistrés</div>
                            </div>
                            <div class="col-md-6">
                                <div class="h1 text-danger">24</div>
                                <div class="text-muted">Bus en service</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-chart-bar me-2"></i>Bus par type</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-success"><i class="fas fa-chart-pie me-2"></i>Conducteurs par zone</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-danger"><i class="fas fa-chart-line me-2"></i>Bus en maintenance par semaine</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Tata', 'Car Rapide', 'DDK'],
                datasets: [{
                    label: 'Nombre de bus',
                    data: [10, 8, 6],
                    backgroundColor: '#e74a3b'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Nord', 'Sud', 'Centre'],
                datasets: [{
                    data: [12, 10, 6],
                    backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
                datasets: [{
                    label: 'Bus en maintenance',
                    data: [2, 4, 1, 3],
                    fill: true,
                    borderColor: '#e74a3b',
                    backgroundColor: 'rgba(231, 74, 59, 0.2)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>
</body>
</html>
