<?php

$server = "127.0.0.1";
$user = "root";
$pass = "";
$port = 3306;


$conn = new mysqli($server, $user, $pass, "Prodaja", $port);

if ($conn->connect_error) {
    die("Greška spajanja: " . $conn->connect_error);
}

echo "Spojeno na bazu Prodaja.<br><br>";


$sql = 'INSERT INTO Dobavljac (dobavljacID, nazivDob, adresa, telefon) VALUES
(1,"Kraš","Ravnice 48, Zagreb","01 2396 111"),
(2,"Labud","Radnička cesta 173 r, Zagreb","01 2396 111"),
(3,"Podravka","Ante Starčevića 32, Koprivnica","048 651 144")';

$conn->query($sql);
echo "Dobavljaci uneseni.<br>";


$sql = 'INSERT INTO Kategorija (kategorijaID, nazivKat) VALUES
(1,"juha"),
(2,"dodatak jelu"),
(3,"čokolada"),
(4,"keksi"),
(5,"deterdžent")';

$conn->query($sql);
echo "Kategorije unesene.<br>";


$sql = 'INSERT INTO Proizvod (proizvodID, nazivPro, cijena, kolicina, dobavljacID, kategorijaID) VALUES
(1,"Oliver Futura",34.99,25,2,5),
(2,"Vegeta pikant",12.50,100,3,2),
(3,"Dorina Mousse",7.05,70,1,3),
(4,"Životinjsko carstvo",1.45,150,1,3)';

$conn->query($sql);
echo "Proizvodi uneseni.<br>";

$conn->close();
echo "<br>✅ Prvopunjenje gotovo!";
?>

