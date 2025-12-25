<?php
require 'db.php';

if(isset($_GET['sil'])){
    $id = $_GET['sil'];
    $stmt = $pdo->prepare("DELETE FROM randevular WHERE id=?");
    $stmt->execute([$id]);
    header('Location: liste.php');
    exit;
}

$stmt = $pdo->query("SELECT r.*, d.isim AS doktor_adi FROM randevular r JOIN doktorlar d ON r.doktor_id = d.id ORDER BY tarih");
$randevular = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Randevular</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #f7f9fc; padding: 20px; }
.table-container { max-width: 800px; margin: 50px auto; }
</style>
</head>
<body>
<div class="table-container">
<h3 class="text-center mb-4">Randevular</h3>
<table class="table table-bordered table-striped">
<thead class="table-light">
<tr>
    <th>ID</th>
    <th>İsim</th>
    <th>Email</th>
    <th>Doktor</th>
    <th>Tarih</th>
    <th>İşlem</th>
</tr>
</thead>
<tbody>
<?php foreach($randevular as $r): ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td><?= htmlspecialchars($r['isim']) ?></td>
    <td><?= htmlspecialchars($r['email']) ?></td>
    <td><?= $r['doktor_adi'] ?></td>
    <td><?= date('d-m-Y H:i', strtotime($r['tarih'])) ?></td>
    <td><a href="liste.php?sil=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Randevuyu silmek istediğinize emin misiniz?')">İptal</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="text-center mt-3">
    <a href="index.php" class="btn btn-primary">Yeni Randevu Al</a>
</div>
</div>
</body>
</html>

