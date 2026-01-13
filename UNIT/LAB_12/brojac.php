<?php

$datoteka = "brojac.dat";

// Ako korisnik klikne gumb "Obriši brojač"
if (isset($_POST['obrisi'])) {
    if (file_exists($datoteka)) {
        unlink($datoteka);
        echo "Brojač obrisan.<br><br>";
    }
}


if (!file_exists($datoteka)) {
    $handle = fopen($datoteka, "w");
    if (!$handle) {
        die("Ne mogu stvoriti datoteku.");
    }
    fwrite($handle, "0");
    fclose($handle);
}

// Otvori datoteku i pročitaj broj
$handle = fopen($datoteka, "r");
if (!$handle) {
    die("Ne mogu otvoriti datoteku za čitanje.");
}
$broj = (int)fgets($handle);
fclose($handle);


$broj++;


echo "Vi ste <strong>$broj.</strong> posjetitelj ove stranice.<br><br>";


$handle = fopen($datoteka, "w");
if (!$handle) {
    die("Ne mogu otvoriti datoteku za pisanje.");
}
fwrite($handle, $broj);
fclose($handle);
?>

<form method="post">
    <button type="submit" name="obrisi">Obriši brojač</button>
</form>

