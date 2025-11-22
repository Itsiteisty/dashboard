<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if(!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$applicants = $db->staff_forms->find([], ['sort'=>['created_at'=>-1]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Discord Staff Admin Panel</h1>
<p><a href="index.php?logout=1">Logout</a></p>

<div class="applicants-container">
<?php foreach($applicants as $app): 
    $id = (string)$app['_id'];
?>
<div class="applicant-card" id="applicant-<?= $id ?>">
    <p><strong>Discord ID:</strong> <?= htmlspecialchars($app['discord_id']) ?></p>
    <p><strong>Username:</strong> <?= htmlspecialchars($app['username']) ?></p>
    <div class="actions">
        <button class="btn btn-approve" onclick="ajaxAction('approve', '<?= $id ?>')">Approve</button>
        <button class="btn btn-reject" onclick="ajaxAction('reject', '<?= $id ?>')">Reject</button>
    </div>
</div>
<?php endforeach; ?>
</div>

<script>
function ajaxAction(action, id){
    if(!confirm(`Are you sure you want to ${action.toUpperCase()} this applicant?`)) return;

    fetch('update.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({id:id,action:action})
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            const card=document.getElementById('applicant-'+id);
            card.classList.add('removed');
            setTimeout(()=>card.remove(),400);
        }else{
            alert('Error: '+data.message);
        }
    }).catch(err=>alert('Request failed: '+err));
}
</script>
</body>
</html>
