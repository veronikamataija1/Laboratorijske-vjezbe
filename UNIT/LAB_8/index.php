<?php
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>PHP Vježba 8</title>
</head>
<body>
<h1>PHP Vježba 8</h1>

<hr>
<h2>Zadatak 1</h2>
<form method="post">
    Ime: <input type="text" name="ime"><br>
    Prezime: <input type="text" name="prezime"><br>
    Godine: <input type="number" name="godine"><br>
    <button type="submit" name="zadatak1">Pošalji</button>
</form>

<?php
if (isset($_POST['zadatak1'])) {
    $ime = isset($_POST['ime']) ? trim($_POST['ime']) : '';
    $prezime = isset($_POST['prezime']) ? trim($_POST['prezime']) : '';
    $godine = isset($_POST['godine']) ? trim($_POST['godine']) : '';

    $podaci = array($ime, $prezime, $godine);
    $csv = implode(',', $podaci);

    echo "<p>Rezultat (var_dump csv teksta):</p><pre>";
    var_dump($csv);
    echo "</pre>";
}
?>

<hr>
<h2>Zadatak 2</h2>
<form method="post">
    Web adresa: <input type="text" name="url" size="50"><br>
    <button type="submit" name="zadatak2">Dohvati linkove</button>
</form>

<?php
if (isset($_POST['zadatak2'])) {
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';

    if ($url === '') {
        echo "<p>Unesite adresu.</p>";
    } else {
        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'http://' . $url;
        }

        echo "<p>Korištena adresa: " . htmlspecialchars($url) . "</p>";

        $html = @file_get_contents($url);

        if ($html === false) {
            echo "<p>Ne mogu dohvatiti sadržaj stranice.</p>";
        } else {
            $pattern = '/<a\s+href=(["\'])(.+?)\1[^>]*>/i';
            if (preg_match_all($pattern, $html, $matches)) {
                echo "<p>Pronađeni linkovi:</p>";
                foreach ($matches[2] as $link) {
                    echo htmlspecialchars($link) . "<br>";
                }
            } else {
                echo "<p>Nije pronađen nijedan link.</p>";
            }
        }
    }
}
?>

<hr>
<h2>Zadatak 3</h2>
<form method="post">
    Ime i prezime: <input type="text" name="ime_prezime"><br>
    Datum rođenja: <input type="text" name="datum"><br>
    Broj telefona: <input type="text" name="telefon"><br>
    E-mail: <input type="text" name="email"><br>
    <button type="submit" name="zadatak3">Provjeri</button>
</form>

<?php
if (isset($_POST['zadatak3'])) {
    $ime_prezime = isset($_POST['ime_prezime']) ? trim($_POST['ime_prezime']) : '';
    $datum = isset($_POST['datum']) ? trim($_POST['datum']) : '';
    $telefon = isset($_POST['telefon']) ? trim($_POST['telefon']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    $is_ime = preg_match('/^[A-Za-z]+(\s+[A-Za-z]+)+$/', $ime_prezime);
    $is_datum = preg_match('/^\d{1,2}\.\d{1,2}\.\d{4}$/', $datum);
    $is_telefon = preg_match('/^0\d{1,2}\s\d{3}\s\d{3,4}$/', $telefon);
    $is_email = preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,}$/', $email);

    echo "<p>Provjera podataka:</p><ul>";
    echo "<li>Ime i prezime (" . htmlspecialchars($ime_prezime) . "): " . ($is_ime ? "ispravno" : "neispravno") . "</li>";
    echo "<li>Datum rođenja (" . htmlspecialchars($datum) . "): " . ($is_datum ? "ispravan" : "neispravan") . "</li>";
    echo "<li>Telefon (" . htmlspecialchars($telefon) . "): " . ($is_telefon ? "ispravan" : "neispravan") . "</li>";
    echo "<li>E-mail (" . htmlspecialchars($email) . "): " . ($is_email ? "ispravan" : "neispravan") . "</li>";
    echo "</ul>";
}
?>

<hr>
<h2>Zadatak 4</h2>

<form method="post">
    <button type="submit" name="zadatak4">Zamijeni godine s 2020</button>
</form>

<?php
if (isset($_POST['zadatak4'])) {
    $tekst = "Porast broja noćenja od 50% očekujemo u drugoj polovici 2017. godine. Iduća 2018. godina bit će povijesno najveća po porastu BDP-a. Od 2013. godine na drveću će rasti euri koje ćete samo trebati pobrati i odnijeti u banku. Kao Švicarska bit ćemo bogati u 2010. godini.";
    $zamijenjeno = preg_replace('/\b\d{4}\b/', '2020', $tekst);

    echo "<p>Originalni tekst:</p>";
    echo "<p>" . htmlspecialchars($tekst) . "</p>";

    echo "<p>Tekst nakon zamjene godina:</p>";
    echo "<p>" . htmlspecialchars($zamijenjeno) . "</p>";
}
?>

</body>
</html>
