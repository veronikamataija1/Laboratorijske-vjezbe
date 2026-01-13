<?php
$conn = new mysqli("127.0.0.1", "root", "", "Prodaja", 3306);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dobavljači</title>
</head>
<body>

<div style="text-align:center;">
    <h3>Dobavljači</h3>

    <table border="1" cellpadding="2" cellspacing="2"
           style="width:60%; margin-left:auto; margin-right:auto;">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Adresa</th>
            <th>Telefon</th>
        </tr>

        <?php
        $rez = $conn->query("SELECT * FROM Dobavljac");

        while($r = $rez->fetch_object()){
            echo "<tr>";
            echo "<td>$r->dobavljacID</td>";
            echo "<td>$r->nazivDob</td>";
            echo "<td>$r->adresa</td>";
            echo "<td>$r->telefon</td>";
            echo "</tr>";
        }
        ?>

    </table>
</div>

</body>
</html>

