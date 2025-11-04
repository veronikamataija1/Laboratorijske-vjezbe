<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Laboratorijska vježba 4</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h2 { color: darkgreen; border-bottom: 2px solid #ccc; padding-bottom: 4px; }
        form { background: #f9f9f9; padding: 15px; border-radius: 8px; width: 400px; margin-bottom: 25px; }
        input[type=number], input[type=text] { width: 90%; padding: 6px; margin: 5px 0; }
        input[type=submit] { background: darkgreen; color: white; border: none; padding: 8px 14px; border-radius: 5px; cursor: pointer; }
        input[type=submit]:hover { background: green; }
        p { font-weight: bold; }
        hr { margin: 40px 0; }
    </style>
</head>
<body>

<h1>Vježba 4 – PHP Funkcije</h1>


<h2>1) Funkcije – prosljeđivanje vrijednošću ili referencom</h2>
<form method="post">
    <label>Unesite prvi broj:</label><br>
    <input type="number" name="a1" required><br>
    <label>Unesite drugi broj:</label><br>
    <input type="number" name="b1" required><br>
    <input type="submit" name="posalji1" value="Zamijeni">
</form>

<?php

function zamijeni(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}


function zamijeniBezRef($a, $b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

if (isset($_POST['posalji1'])) {
    $a = $_POST['a1'];
    $b = $_POST['b1'];

    echo "<p>Prije poziva funkcije: prvi = $a, drugi = $b</p>";
    zamijeni($a, $b);
    echo "<p>Nakon zamjene s referencom: prvi = $a, drugi = $b</p>";

    $a2 = $_POST['a1'];
    $b2 = $_POST['b1'];
    zamijeniBezRef($a2, $b2);
    echo "<p>Nakon zamjene bez reference: prvi = $a2, drugi = $b2</p>";
}
?>

<hr>


<h2>2) Podrazumijevana vrijednost parametra</h2>
<form method="post">
    <label>Unesite brzinu zvuka (m/s):</label><br>
    <input type="number" name="brzina" step="any" placeholder="za zrak ostavite prazno"><br>
    <label>Unesite vrijeme (s):</label><br>
    <input type="number" name="vrijeme" step="any" required><br>
    <input type="submit" name="posalji2" value="Izračunaj put">
</form>

<?php
function putZvuka($vrijeme, $brzina = 344) {
    return $vrijeme * $brzina;
}

if (isset($_POST['posalji2'])) {
    $vrijeme = $_POST['vrijeme'];
    $brzina = $_POST['brzina'];

    if (empty($brzina))
        $rezultat = putZvuka($vrijeme);
    else
        $rezultat = putZvuka($vrijeme, $brzina);

    echo "<p>Prijeđeni put zvuka je: $rezultat m</p>";
}
?>

<hr>


<h2>3) Varijabilni broj parametara</h2>
<form method="post">
    <label>Unesite broj:</label><br>
    <input type="text" name="unos" placeholder="npr. 3,4,5" required><br>
    <input type="submit" name="posalji3" value="Izračunaj prosjeke">
</form>

<?php
function prosjek() {
    $brojArg = func_num_args();
    $zbroj = 0;
    for ($i = 0; $i < $brojArg; $i++) {
        $zbroj += func_get_arg($i);
    }
    return $zbroj / $brojArg;
}

if (isset($_POST['posalji3'])) {
    $niz = array_map('floatval', explode(',', str_replace(' ', '', $_POST['unos'])));

    $prosjek1 = prosjek(5, 14, 25, 67, 10, ...$niz);
    $prosjek2 = prosjek(50, 70, 90, ...$niz);

    echo "<p>Prosjek prvog skupa brojeva je: $prosjek1</p>";
    echo "<p>Prosjek drugog skupa brojeva je: $prosjek2</p>";
}
?>

<hr>


<h2>4) Funkcije – najveći zajednički djelitelj (NZD)</h2>
<form method="post">
    <label>Unesite prvi broj:</label><br>
    <input type="number" name="a4" required><br>
    <label>Unesite drugi broj:</label><br>
    <input type="number" name="b4" required><br>
    <input type="submit" name="posalji4" value="Pronađi NZD">
</form>

<?php
function nzd($a, $b) {
    $manji = ($a < $b) ? $a : $b;
    for ($i = $manji; $i >= 1; $i--) {
        if ($a % $i == 0 && $b % $i == 0)
            return $i;
    }
}

if (isset($_POST['posalji4'])) {
    $a = $_POST['a4'];
    $b = $_POST['b4'];
    $rez = nzd($a, $b);
    echo "<p>Najveći zajednički djelitelj od $a i $b je: $rez</p>";
}
?>

</body>
</html>

