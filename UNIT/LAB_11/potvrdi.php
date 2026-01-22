<?php
$conn = new mysqli("127.0.0.1", "root", "", "Prodaja", 3306);

$naziv = $_POST['naziv'];
$cijena = $_POST['cijena'];
$kolicina = $_POST['kolicina'];
$dobavljac = $_POST['dobavljac'];
$kategorija = $_POST['kategorija'];

$sql = "INSERT INTO Proizvod (nazivPro, cijena, kolicina, dobavljacID, kategorijaID)
VALUES ('$naziv', '$cijena', '$kolicina', '$dobavljac', '$kategorija')";

if($conn->query($sql)){
    echo "Proizvod uspješno dodan!<br>";
    echo "<a href='admin.php'>Natrag na admin</a>";
}else{
    echo "Greška: " . $conn->error;
}
?>

