<?php
$server = "127.0.0.1";
$user = "root";
$pass = "";
$port = 3306;


$conn = new mysqli($server, $user, $pass, "Prodaja", $port);

if ($conn->connect_error) {
    die("Greška spajanja: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>

<div style="text-align: center;">
    <h3>Baza proizvoda</h3>

    <table border="1" cellpadding="2" cellspacing="2"
           style="width:60%; margin-left: auto; margin-right: auto;">
        <tr>
            <th>Naziv proizvoda</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Vrijednost robe</th>
            <th>Obriši</th>
        </tr>

        <?php

        $sql = "SELECT proizvodID, nazivPro, kolicina, cijena, (kolicina * cijena) AS vrijednost FROM Proizvod";
        $rezultat = $conn->query($sql);

        $brojpro = 0;

        while ($red = $rezultat->fetch_object()) {
            echo '<tr>';
            echo '<td>' . $red->nazivPro . '</td>';
            echo '<td>' . $red->kolicina . '</td>';
            echo '<td>' . $red->cijena . '</td>';
            echo '<td>' . number_format($red->vrijednost, 2) . '</td>';
            echo '<td><a href="proizvod.php?action=uredi&id=' . $red->proizvodID . '">[UREDI]</a></td>';
            echo '</tr>';
            $brojpro++;
        }
        ?>

    </table>
</div>

</body>
</html>

