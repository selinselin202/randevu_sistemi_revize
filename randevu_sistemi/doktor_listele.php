<?php
include "db.php";

$doktorlar = $conn->query("SELECT * FROM doktorlar ORDER BY ad_soyad ASC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Doktor Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>👨‍⚕️ Doktor Listesi</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad Soyad</th>
                <th>Uzmanlık</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $doktorlar->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ad_soyad']; ?></td>
                    <td><?php echo $row['uzmanlik']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
