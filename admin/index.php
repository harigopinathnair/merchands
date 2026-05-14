<?php
// merchands/admin/index.php

require_once '../includes/db.php';
require_once '../includes/auth-guard.php';

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

$pdo = getDbConnection();

// AJAX Handlers
if (isset($_GET['action'])) {
    header('Content-Type: application/json');

    if ($_GET['action'] === 'save_notes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE leads SET notes = ? WHERE id = ?');
        $stmt->execute([$data['notes'], $data['lead_id']]);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($_GET['action'] === 'delete_lead' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('DELETE FROM leads WHERE id = ?');
        $stmt->execute([$data['lead_id']]);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($_GET['action'] === 'update_status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE leads SET status = ? WHERE id = ?');
        $stmt->execute([$data['status'], $data['lead_id']]);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($_GET['action'] === 'stats') {
        $stats = [
            'total' => $pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn(),
            'today' => $pdo->query("SELECT COUNT(*) FROM leads WHERE DATE(created_at) = CURDATE() AND status = 'new'")->fetchColumn(),
            'contacted' => $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'contacted'")->fetchColumn(),
            'quoted' => $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'quoted'")->fetchColumn(),
        ];
        echo json_encode($stats);
        exit;
    }
}

// Filter Logic
$where = ['1=1'];
$params = [];

if (!empty($_GET['search'])) {
    $where[] = '(name LIKE ? OR email LIKE ? OR company LIKE ? OR ref_id LIKE ?)';
    $s = '%' . $_GET['search'] . '%';
    $params = array_merge($params, [$s, $s, $s, $s]);
}
if (!empty($_GET['status']) && $_GET['status'] !== 'all') {
    $where[] = 'status = ?';
    $params[] = $_GET['status'];
}
if (!empty($_GET['shipment_type']) && $_GET['shipment_type'] !== 'all') {
    $where[] = 'shipment_type = ?';
    $params[] = $_GET['shipment_type'];
}
if (!empty($_GET['date_from'])) {
    $where[] = 'DATE(created_at) >= ?';
    $params[] = $_GET['date_from'];
}
if (!empty($_GET['date_to'])) {
    $where[] = 'DATE(created_at) <= ?';
    $params[] = $_GET['date_to'];
}

$whereSQL = implode(' AND ', $where);
$perPage  = 25;
$page     = max(1, (int)($_GET['page'] ?? 1));
$offset   = ($page - 1) * $perPage;

$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM leads WHERE $whereSQL");
$totalStmt->execute($params);
$totalRows = $totalStmt->fetchColumn();

$stmt = $pdo->prepare("SELECT * FROM leads WHERE $whereSQL ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$leads = $stmt->fetchAll();

// Stats for Header Cards
$totalLeads = $pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn();
$newToday = $pdo->query("SELECT COUNT(*) FROM leads WHERE DATE(created_at) = CURDATE() AND status = 'new'")->fetchColumn();
$contactedCount = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'contacted'")->fetchColumn();
$quotedCount = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'quoted'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Dashboard | Merchands.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0A2240;
            --accent-blue: #1E6FBB;
            --cta-orange: #E8620A;
            --slate: #F4F6F9;
            --white: #FFFFFF;
        }

        body { font-family: 'Inter', sans-serif; background: var(--slate); margin: 0; color: #1a1a1a; }

        header {
            background: var(--navy);
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-logo { color: white; font-weight: 700; font-size: 1.25rem; text-decoration: none; }
        .header-title { color: rgba(255,255,255,0.7); font-size: 0.875rem; }
        .header-user { color: white; display: flex; gap: 20px; align-items: center; font-size: 0.875rem; }
        .header-user a { color: white; text-decoration: none; opacity: 0.8; }
        .header-user a:hover { opacity: 1; }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .stat-label { font-size: 0.75rem; color: #666; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; display: block; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--navy); }
        .stat-card.blue { border-left: 4px solid var(--accent-blue); }
        .stat-card.amber { border-left: 4px solid #f59e0b; }
        .stat-card.green { border-left: 4px solid #10b981; }

        .filter-bar { background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 1rem; align-items: flex-end; }
        .filter-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .filter-group label { font-size: 0.75rem; font-weight: 600; color: #666; }
        .filter-control { padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.875rem; }

        .table-container { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background: #f8f9fa; padding: 12px 16px; font-size: 0.8125rem; font-weight: 600; color: #666; border-bottom: 1px solid #eee; }
        td { padding: 14px 16px; font-size: 0.875rem; border-bottom: 1px solid #eee; }
        tr:hover { background: #f0f4ff; }

        .pill { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize; }
        .pill.new { background: #E6F1FB; color: #0C447C; }
        .pill.contacted { background: #FAEEDA; color: #633806; }
        .pill.quoted { background: #EAF3DE; color: #27500A; }
        .pill.closed { background: #F1EFE8; color: #444441; }

        .btn-view { padding: 4px 12px; background: #eee; border: none; border-radius: 4px; cursor: pointer; font-size: 0.75rem; font-weight: 600; }
        .btn-view:hover { background: #ddd; }
        .btn-delete { padding: 4px 12px; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 4px; cursor: pointer; font-size: 0.75rem; font-weight: 600; margin-left: 5px; }
        .btn-delete:hover { background: #fecaca; }

        .details-panel { background: #fcfcfc; padding: 2rem; border-bottom: 1px solid #eee; }
        .details-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        .detail-item label { display: block; font-size: 0.75rem; color: #888; margin-bottom: 4px; }
        .detail-item span { font-weight: 500; }

        .notes-area { width: 100%; height: 100px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin-top: 10px; font-size: 0.875rem; }

        .pagination { margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; color: #666; }
        .page-links { display: flex; gap: 5px; }
        .page-link { padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #666; }
        .page-link.active { background: var(--navy); color: white; border-color: var(--navy); }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .hide-mobile { display: none; }
        }
    </style>
</head>
<body>

    <header>
        <a href="../" class="header-logo">Merchands.com</a>
        <div class="header-title">Leads Dashboard</div>
        <div class="header-user">
            <span><?= htmlspecialchars($_SESSION['admin_name']) ?></span>
            <a href="logout.php">Sign out</a>
        </div>
    </header>

    <div class="container">
        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <span class="stat-label">Total Leads</span>
                <div class="stat-value" id="stat-total"><?= $totalLeads ?></div>
            </div>
            <div class="stat-card blue">
                <span class="stat-label">New Today</span>
                <div class="stat-value" id="stat-today"><?= $newToday ?></div>
            </div>
            <div class="stat-card amber">
                <span class="stat-label">Contacted</span>
                <div class="stat-value" id="stat-contacted"><?= $contactedCount ?></div>
            </div>
            <div class="stat-card green">
                <span class="stat-label">Quoted</span>
                <div class="stat-value" id="stat-quoted"><?= $quotedCount ?></div>
            </div>
        </div>

        <form class="filter-bar" method="GET">
            <div class="filter-group" style="flex-grow: 1;">
                <label>Search</label>
                <input type="text" name="search" class="filter-control" placeholder="Name, Email, Company, Ref..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select name="status" class="filter-control">
                    <option value="all">All Statuses</option>
                    <option value="new" <?= ($_GET['status'] ?? '') === 'new' ? 'selected' : '' ?>>New</option>
                    <option value="contacted" <?= ($_GET['status'] ?? '') === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                    <option value="quoted" <?= ($_GET['status'] ?? '') === 'quoted' ? 'selected' : '' ?>>Quoted</option>
                    <option value="closed" <?= ($_GET['status'] ?? '') === 'closed' ? 'selected' : '' ?>>Closed</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Shipment</label>
                <select name="shipment_type" class="filter-control">
                    <option value="all">All Types</option>
                    <option value="sea" <?= ($_GET['shipment_type'] ?? '') === 'sea' ? 'selected' : '' ?>>Sea</option>
                    <option value="air" <?= ($_GET['shipment_type'] ?? '') === 'air' ? 'selected' : '' ?>>Air</option>
                    <option value="project" <?= ($_GET['shipment_type'] ?? '') === 'project' ? 'selected' : '' ?>>Project</option>
                    <option value="customs" <?= ($_GET['shipment_type'] ?? '') === 'customs' ? 'selected' : '' ?>>Customs</option>
                </select>
            </div>
            <button type="submit" class="filter-control" style="background: var(--navy); color: white; border: none; cursor: pointer; padding: 8px 24px;">Filter</button>
            <a href="/admin/export.php?<?= http_build_query($_GET) ?>" class="filter-control" style="text-decoration: none; color: #444; border-color: #ccc;">Export CSV</a>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th class="hide-mobile">Company</th>
                        <th>Type</th>
                        <th class="hide-mobile">Route</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($leads)): ?>
                        <tr><td colspan="8" style="text-align: center; padding: 3rem;">No leads found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($leads as $lead): ?>
                            <tr>
                                <td style="font-weight: 600;"><?= $lead['ref_id'] ?></td>
                                <td style="font-size: 0.75rem;"><?= date('d M, H:i', strtotime($lead['created_at'])) ?></td>
                                <td><?= htmlspecialchars($lead['name']) ?></td>
                                <td class="hide-mobile"><?= htmlspecialchars($lead['company']) ?></td>
                                <td style="text-transform: capitalize;"><?= $lead['shipment_type'] ?></td>
                                <td class="hide-mobile" style="font-size: 0.75rem;"><?= htmlspecialchars($lead['origin']) ?> &rarr; <?= htmlspecialchars($lead['destination']) ?></td>
                                <td><span class="pill <?= $lead['status'] ?>"><?= $lead['status'] ?></span></td>
                                <td>
                                    <button class="btn-view" onclick="toggleDetails(<?= $lead['id'] ?>)">View</button>
                                    <button class="btn-delete" onclick="deleteLead(<?= $lead['id'] ?>, '<?= $lead['ref_id'] ?>')">Delete</button>
                                </td>
                            </tr>
                            <tr id="details-<?= $lead['id'] ?>" class="details-row" style="display: none;">
                                <td colspan="8" class="details-panel">
                                    <div class="details-grid">
                                        <div class="detail-item"><label>Email</label><span><?= htmlspecialchars($lead['email']) ?></span></div>
                                        <div class="detail-item"><label>Phone</label><span><?= htmlspecialchars($lead['phone']) ?></span></div>
                                        <div class="detail-item"><label>IP Address</label><span><?= $lead['ip_address'] ?></span></div>
                                        <div class="detail-item"><label>UTM Source</label><span><?= $lead['utm_source'] ?: '-' ?></span></div>
                                        <div class="detail-item"><label>UTM Campaign</label><span><?= $lead['utm_campaign'] ?: '-' ?></span></div>
                                        <div class="detail-item">
                                            <label>Status Update</label>
                                            <select onchange="updateStatus(<?= $lead['id'] ?>, this.value)" class="filter-control" style="width: 100%;">
                                                <option value="new" <?= $lead['status'] === 'new' ? 'selected' : '' ?>>New</option>
                                                <option value="contacted" <?= $lead['status'] === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                                                <option value="quoted" <?= $lead['status'] === 'quoted' ? 'selected' : '' ?>>Quoted</option>
                                                <option value="closed" <?= $lead['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin-top: 1.5rem;">
                                        <label style="font-size: 0.75rem; color: #888;">Message</label>
                                        <p style="margin-top: 5px; font-size: 0.875rem; background: #f0f0f0; padding: 10px; border-radius: 4px;"><?= nl2br(htmlspecialchars($lead['message'] ?: 'No message provided.')) ?></p>
                                    </div>
                                    <div style="margin-top: 1.5rem;">
                                        <label style="font-size: 0.75rem; color: #888;">Admin Notes (auto-save on blur)</label>
                                        <textarea class="notes-area" onblur="saveNotes(<?= $lead['id'] ?>, this.value)"><?= htmlspecialchars($lead['notes'] ?? '') ?></textarea>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <div>Showing <?= $offset + 1 ?>–<?= min($offset + $perPage, $totalRows) ?> of <?= $totalRows ?> leads</div>
            <div class="page-links">
                <?php 
                $totalPages = ceil($totalRows / $perPage);
                for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="page-link <?= $page === $i ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const el = document.getElementById(`details-${id}`);
            el.style.display = el.style.display === 'none' ? 'table-row' : 'none';
        }

        async function saveNotes(id, notes) {
            await fetch('index.php?action=save_notes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ lead_id: id, notes: notes })
            });
        }

        async function updateStatus(id, status) {
            await fetch('index.php?action=update_status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ lead_id: id, status: status })
            });
            window.location.reload(); // Simple refresh to update pills/stats
        }

        async function deleteLead(id, ref) {
            if (!confirm(`Are you sure you want to delete lead ${ref}? This action cannot be undone.`)) return;
            
            const res = await fetch('index.php?action=delete_lead', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ lead_id: id })
            });
            const data = await res.json();
            if (data.success) {
                window.location.reload();
            }
        }

        // Auto-refresh stats
        setInterval(async () => {
            const resp = await fetch('index.php?action=stats');
            const stats = await resp.json();
            document.getElementById('stat-total').innerText = stats.total;
            document.getElementById('stat-today').innerText = stats.today;
            document.getElementById('stat-contacted').innerText = stats.contacted;
            document.getElementById('stat-quoted').innerText = stats.quoted;
        }, 60000);
    </script>
</body>
</html>
