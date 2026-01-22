<?php
$conn = new mysqli("127.0.0.1", "root", "", "Prodaja", 3306);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kategorije</title>
</head>
<body>

<div style="text-align:center;">
    <h3>Kategorije</h3>

    <table border="1" cellpadding="2" cellspacing="2"
           style="width:60%; margin-left:auto; margin-right:auto;">
        <tr>
            <th>ID</th>
            <th>Naziv kategorije</th>
        </tr>

        <?php
        $rez = $conn->query("SELECT * FROM Kategorija");

        while($r = $rez->fetch_object()){
            echo "<tr>";
            echo "<td>$r->kategorijaID</td>";
            echo "<td>$r->nazivKat</td>";
            echo "</tr>";
        }
        ?>

    </table>
</div>

</body>
</html>

