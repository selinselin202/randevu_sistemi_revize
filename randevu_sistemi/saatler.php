<?php
require 'db.php';
header('Content-Type: application/json');

$doktor_id = $_GET['doktor_id'];
$tarih = $_GET['tarih'];

$baslangic = strtotime("$tarih 09:00");
$bitis = strtotime("$tarih 17:00");
$interval = 30*60;

$slots = [];
for($s = $baslangic; $s < $bitis; $s += $interval){
    $slots[] = date('H:i', $s);
}

$stmt = $pdo->prepare("SELECT tarih FROM randevular WHERE doktor_id = ? AND DATE(tarih) = ?");
$stmt->execute([$doktor_id, $tarih]);
$dolu = $stmt->fetchAll(PDO::FETCH_COLUMN);

$bosSlots = [];
foreach($slots as $s){
    $dt = "$tarih $s:00";
    if(!in_array($dt, $dolu)){
        $bosSlots[] = $s;
    }
}

echo json_encode($bosSlots);
?>
