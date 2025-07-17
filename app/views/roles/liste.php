<?php
$role = $_SESSION['role'] ?? null;

$dashboardLink = 'index.php?action=dashboard';
if ($role == 1) $dashboardLink = 'index.php?action=adminDashboard';
elseif ($role == 2) $dashboardLink = 'index.php?action=parcDashboard';
elseif ($role == 3) $dashboardLink = 'index.php?action=trajetDashboard';
?>

<?php if (!empty($successMessage)): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    showSuccessMessage('<?= $successMessage ?>');
});
</script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Rôles</title>
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
        
        /* Modal styling */
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
                <h2 class="fw-bold mb-1"><i class="fas fa-id-badge me-2"></i>Gestion des Rôles</h2>
                <p class="mb-0">Administration des rôles système</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= $dashboardLink ?>" class="btn btn-outline-light btn-add">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <a href="index.php?action=addRole" class="btn btn-light btn-add">
                    <i class="fas fa-plus me-2"></i>Nouveau rôle
                </a>
            </div>
        </div>
    </div>

    <div class="management-card">
        <div class="card-header bg-white border-0 py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 text-primary"><i class="fas fa-list me-2"></i>Liste des rôles</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        <button class="btn btn-primary" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-management table-hover" id="rolesTable">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th>Libellé</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= htmlspecialchars($role['id']) ?></td>
                            <td><?= htmlspecialchars($role['libelle']) ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="index.php?action=editRole&id=<?= $role['id'] ?>" class="btn-action btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="index.php?action=deleteRole&id=<?= $role['id'] ?>" class="btn-action btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Supprimer ce rôle ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Affichage <strong><?= $start ?>-<?= $end ?></strong> sur <strong><?= $total ?></strong> rôles
                </div>
                <?php if ($totalPages > 1) : ?>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="index.php?action=roles&page=<?= $page - 1 ?>">&laquo; Précédent</a></li>
                        <?php else: ?>
                            <li class="page-item disabled"><span class="page-link">&laquo; Précédent</span></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="index.php?action=roles&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="index.php?action=roles&page=<?= $page + 1 ?>">Suivant &raquo;</a></li>
                        <?php else: ?>
                            <li class="page-item disabled"><span class="page-link">Suivant &raquo;</span></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchButton').addEventListener('click', function () {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#rolesTable tbody tr');
    rows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(searchText) ? '' : 'none';
    });
});

document.getElementById('searchInput').addEventListener('keyup', () => {
    document.getElementById('searchButton').click();
});

function showSuccessMessage(message) {
    const alert = document.createElement('div');
    alert.className = 'alert alert-success position-fixed top-0 end-0 m-3';
    alert.style.zIndex = '9999';
    alert.textContent = message;
    document.body.appendChild(alert);
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }, 3000);
}
</script>
</body>
</html>
