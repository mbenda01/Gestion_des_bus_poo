<?php
$role = $_SESSION['role'] ?? null;

$dashboardLink = 'index.php?action=dashboard';
if ($role == 1) $dashboardLink = 'index.php?action=adminDashboard';
elseif ($role == 2) $dashboardLink = 'index.php?action=parcDashboard';
elseif ($role == 3) $dashboardLink = 'index.php?action=trajetDashboard';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Lignes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        .management-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .management-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .management-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: white;
        }
        
        .table-management {
            --bs-table-bg: transparent;
            margin-bottom: 0;
        }
        
        .table-management thead th {
            background-color: #f8f9fc;
            border-bottom-width: 1px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: var(--secondary-color);
        }
        
        .table-management tbody tr {
            transition: all 0.2s;
        }
        
        .table-management tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.03);
            transform: translateX(5px);
        }
        
        .badge-role {
            padding: 0.35em 0.65em;
            font-weight: 600;
            border-radius: 0.375rem;
        }
        
        .badge-admin {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
        
        .badge-parc {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
        }
        
        .badge-trajet {
            background-color: rgba(246, 194, 62, 0.1);
            color: var(--warning-color);
        }
        
        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }
        
        .btn-action:hover {
            transform: scale(1.1);
        }
        
        .btn-add {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(78, 115, 223, 0.2);
        }
        
        .modal-user {
            --bs-modal-border-radius: 15px;
        }
        
        .modal-user .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            border-bottom: none;
        }
        
        .modal-user .btn-close {
            filter: invert(1);
        }
        .btn-add {
            position: relative;
            z-index: 9999 !important;
            pointer-events: auto !important;
        }

        .alert {
            min-width: 250px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            opacity: 1;
            transform: translateX(0);
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .pagination {
            display: flex;
            gap: 5px;
        }

        .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .page-link {
            color: #4e73df;
            border: 1px solid #dee2e6;
            padding: 0.375rem 0.75rem;
        }

        .page-link:hover {
            color: #224abe;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }


    </style>
</head>
<body>

<div class="container py-5">

    <div class="management-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1"><i class="fas fa-road me-2"></i>Gestion des Lignes</h2>
                <p class="mb-0">Liste des lignes de transport</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= $dashboardLink ?>" class="btn btn-outline-light btn-add">
                    <i class="fas fa-arrow-left"></i> Retour au tableau de bord
                </a>
                <a href="index.php?action=addLigne"
                   class="btn btn-light btn-add"
                   onclick="event.stopPropagation(); return true;">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle ligne
                </a>
            </div>
        </div>
    </div>

    <div class="management-card">
        <div class="card-header border-0 py-3 d-flex justify-content-between">
            <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i>Liste des lignes</h5>
            <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                <button class="btn btn-primary" id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0" id="lignesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Numéro</th>
                        <th>Tarif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignes as $ligne): ?>
                        <tr>
                            <td><?= htmlspecialchars($ligne['id']) ?></td>
                            <td><?= htmlspecialchars($ligne['numero']) ?></td>
                            <td><?= number_format($ligne['tarif'], 0, '', ' ') ?> F</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="index.php?action=editLigne&id=<?= $ligne['id'] ?>" class="btn btn-outline-primary btn-action" title="Modifier">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="index.php?action=deleteLigne&id=<?= $ligne['id'] ?>" onclick="return confirm('Confirmer la suppression ?')" class="btn btn-outline-danger btn-action" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($lignes)) : ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Aucune ligne trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchButton').addEventListener('click', () => {
        const input = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#lignesTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    });

    document.getElementById('searchInput').addEventListener('keyup', () => {
        document.getElementById('searchButton').click();
    });
</script>

</body>
</html>
