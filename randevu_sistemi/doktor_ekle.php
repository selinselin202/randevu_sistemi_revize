<?php 

include "db.php";
if (isset($_POST['ekle'])) {

$ad_soyad = $_POST['ad_soyad'];  

 $uzmanlik = $_POST['uzmanlik']; 

$sql = "INSERT INTO doktorlar (ad_soyad, uzmanlik) VALUES ('$ad_soyad','$uzmanlik')";


if ($conn->query($sql)) {

 echo "<p style='color:white;'>  Doktor  eklendi: $ad_soyad</p>";

 } else {

echo "<p style='color:white;'>Sorun var: " . $conn->error . "</p>";
 }

}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Doktor Ekleme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">

    <h2>🩺 Doktor Ekle</h2>

    
    <form method="POST" class="mb-4">

        <div class="mb-3">
            <label class="form-label">Ad Soyad</label>
            <input type="text" name="ad_soyad" class="form-control" placeholder="Örn: Dr. Ahmet Yılmaz" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Uzmanlık</label>
            <input type="text" name="uzmanlik" class="form-control" placeholder="Örn: Kardiyoloji" required>
        </div>

        <button type="submit" name="ekle" class="btn btn-primary">➕ Doktoru Ekle</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>