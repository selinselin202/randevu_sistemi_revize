<?php
require 'db.php';
$doktorlar = $pdo->query("SELECT * FROM doktorlar")->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Randevu Sistemi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card { max-width: 500px; margin: 50px auto; padding: 20px; border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,0.1);}
.btn-primary { width: 100%; }
.slot { margin: 5px; }
.slot.active { background-color: #007bff; color: white; }
</style>
</head>
<body>
<div class="card">
<h3 class="text-center mb-4">Randevu Al</h3>
<form id="randevuForm" method="post" action="kaydet.php">
    <div class="mb-3">
        <label>İsim</label>
        <input type="text" name="isim" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Doktor</label>
        <select name="doktor_id" id="doktor" class="form-select" required>
            <option value="">Seçiniz</option>
            <?php foreach($doktorlar as $d): ?>
                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['isim']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Tarih</label>
        <input type="date" name="tarih" id="tarih" class="form-control" required>
    </div>
    <div class="mb-3" id="saatContainer">
        <label>Boş Saatler</label>
        <div id="saatler" class="d-flex flex-wrap"></div>
        <input type="hidden" name="saat" id="selectedSaat" required>
    </div>
    <button type="submit" class="btn btn-primary">Randevu Al</button>
</form>
<div class="mt-3 text-center">
    <a href="liste.php">Randevuları Görüntüle / İptal Et</a>
</div>
</div>

<script>
const doktorSelect = document.getElementById('doktor');
const tarihInput = document.getElementById('tarih');
const saatlerDiv = document.getElementById('saatler');
const selectedSaatInput = document.getElementById('selectedSaat');

function fetchSaatler() {
    const doktor_id = doktorSelect.value;
    const tarih = tarihInput.value;
    if(!doktor_id || !tarih) return;

    fetch(`saatler.php?doktor_id=${doktor_id}&tarih=${tarih}`)
    .then(res => res.json())
    .then(data => {
        saatlerDiv.innerHTML = '';
        data.forEach(s => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-outline-primary slot';
            btn.textContent = s;
            btn.onclick = () => {
                selectedSaatInput.value = s;
                document.querySelectorAll('.slot').forEach(el => el.classList.remove('active'));
                btn.classList.add('active');
            };
            saatlerDiv.appendChild(btn);
        });
    });
}

doktorSelect.addEventListener('change', fetchSaatler);
tarihInput.addEventListener('change', fetchSaatler);
</script>
</body>
</html>
