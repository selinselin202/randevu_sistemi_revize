<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $isim = trim($_POST['isim']);
    $email = trim($_POST['email']);
    $doktor_id = $_POST['doktor_id'];
    $tarih = $_POST['tarih'] . ' ' . $_POST['saat'];

    $stmt = $pdo->prepare("SELECT * FROM randevular WHERE doktor_id=? AND tarih=?");
    $stmt->execute([$doktor_id, $tarih]);
    if($stmt->fetch()){
        die("Seçtiğiniz saat dolu!");
    }

    $stmt = $pdo->prepare("INSERT INTO randevular (doktor_id, isim, email, tarih) VALUES (?,?,?,?)");
    $stmt->execute([$doktor_id, $isim, $email, $tarih]);
    header('Location: liste.php');
    exit;
}
?>
