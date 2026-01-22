<?php

$server = "127.0.0.1";
$user = "root";
$pass = "";
$port = 3306;


$conn = new mysqli($server, $user, $pass, "", $port);

if ($conn->connect_error) {
    die("Greška spajanja: " . $conn->connect_error);
}

echo "Spojeno na MySQL server.<br>";


$sql = "CREATE DATABASE IF NOT EXISTS Prodaja";
if ($conn->query($sql) === TRUE) {
    echo "Baza Prodaja uspješno stvorena ili već postoji.<br>";
} else {
    die("Greška pri stvaranju baze: " . $conn->error);
}


$conn->select_db("Prodaja");
echo "Baza Prodaja odabrana.<br>";


$sql = "CREATE TABLE IF NOT EXISTS Dobavljac (
    dobavljacID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivDob VARCHAR(60) NOT NULL,
    adresa VARCHAR(70) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    PRIMARY KEY (dobavljacID)
) ENGINE = MyISAM";

$conn->query($sql);
echo "Tablica Dobavljac OK.<br>";


$sql = "CREATE TABLE IF NOT EXISTS Kategorija (
    kategorijaID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivKat VARCHAR(30) NOT NULL,
    PRIMARY KEY (kategorijaID)
) ENGINE = MyISAM";

$conn->query($sql);
echo "Tablica Kategorija OK.<br>";


$sql = "CREATE TABLE IF NOT EXISTS Proizvod (
    proizvodID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivPro VARCHAR(40) NOT NULL,
    cijena DECIMAL(7,2) NOT NULL,
    kolicina SMALLINT NOT NULL DEFAULT 0,
    dobavljacID INTEGER UNSIGNED,
    kategorijaID INTEGER UNSIGNED,
    PRIMARY KEY (proizvodID)
) ENGINE = MyISAM";

$conn->query($sql);
echo "Tablica Proizvod OK.<br>";

$conn->close();
echo "<br>✅ Sve gotovo!";
?>
