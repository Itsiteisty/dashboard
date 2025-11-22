<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';

if (!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$applicants = $db->users->find([], ['sort' => ['_id' => -1]]);

$approved = $db->staff_forms->countDocuments(['status' => 'approved']);
$rejected = $db->staff_forms->countDocuments(['status' => 'rejected']);
$pending  = $db->staff_forms->countDocuments(['status' => 'pending']);
$total    = $db->staff_forms->countDocuments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Discord Staff Admin Panel</title>
<link rel="stylesheet" href="css/style.css">
<script>
function confirmAction(id, action) {
    if (confirm(`Are you sure you want to ${action} this applicant?`)) {
        window.location.href = `update.php?id=${id}&action=${action}`;
    }
}
function hideCard(cardId) {
    document.getElementById(cardId).style.display = 'none';
}
</script>
</head>
<body>
<h1>Discord Staff Admin Panel</h1>

<div class="stats">
    <div>Total Applicants: <?= $total ?></div>
    <div>Approved: <?= $approved ?></div>
    <div>Rejected: <?= $rejected ?></div>
    <div>Pending: <?= $pending ?></div>
</div>

<div class="applicants">
<?php
foreach ($applicants as $applicant):
    $cardId = "applicant-" . $applicant->_id;
?>
    <div class="card" id="<?= $cardId ?>">
        <p><strong>Discord ID:</strong> <?= htmlspecialchars($applicant->discord_id ?? '') ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($applicant->username ?? '') ?></p>
        <?php for ($i=1; $i<=25; $i++): ?>
            <p><strong>Question <?= $i ?>:</strong> <?= htmlspecialchars($applicant->{"q$i"} ?? '') ?></p>
        <?php endfor; ?>
        <p><strong>Status:</strong> <?= ucfirst($applicant->status ?? 'pending') ?></p>
        <?php if (($applicant->status ?? 'pending') === 'pending'): ?>
            <button onclick="confirmAction('<?= $applicant->_id ?>','approved'); hideCard('<?= $cardId ?>')">Approve</button>
            <button onclick="confirmAction('<?= $applicant->_id ?>','rejected'); hideCard('<?= $cardId ?>')">Reject</button>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>

</body>
</html>
