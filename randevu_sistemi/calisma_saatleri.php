<?php
include "db.php";

if (isset($_POST['calisma_ekle'])) {
    $doktor_id = $_POST['doktor_id'];
    $gun       = $_POST['gun'];
    $baslangic = $_POST['baslangic'];
    $bitis     = $_POST['bitis'];

    $sql = "INSERT INTO doktor_calisma (doktor_id, gun, baslangic, bitis) 
            VALUES ('$doktor_id', '$gun', '$baslangic', '$bitis')";

    if ($conn->query($sql)) {
        $message = "<div class='alert alert-success'>✅ Çalışma saati eklendi!</div>";
    } else {
        $message = "<div class='alert alert-danger'>❌ Hata: " . $conn->error . "</div>";
    }
}

$doktorlar = $conn->query("SELECT * FROM doktorlar ORDER BY ad_soyad ASC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Çalışma Saatleri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>🕒 Doktor Çalışma Saatleri</h2>
    <?php if(isset($message)) echo $message; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Doktor Seç</label>
            <select name="doktor_id" class="form-select" required>
                <option value="">-- Doktor Seç --</option>
                <?php while($row = $doktorlar->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['ad_soyad'] . " (" . $row['uzmanlik'] . ")"; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Gün</label>
            <select name="gun" class="form-select" required>
                <option value="">-- Gün Seç --</option>
                <option value="Pazartesi">Pazartesi</option>
                <option value="Salı">Salı</option>
                <option value="Çarşamba">Çarşamba</option>
                <option value="Perşembe">Perşembe</option>
                <option value="Cuma">Cuma</option>
                <option value="Cumartesi">Cumartesi</option>
                <option value="Pazar">Pazar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Başlangıç Saati</label>
            <input type="time" name="baslangic" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bitiş Saati</label>
            <input type="time" name="bitis" class="form-control" required>
        </div>

        <button type="submit" name="calisma_ekle" class="btn btn-primary">➕ Çalışma Saati Ekle</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
