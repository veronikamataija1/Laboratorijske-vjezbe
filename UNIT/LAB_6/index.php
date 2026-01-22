<?php
echo "<h1>Labos 6</h1>";


#ZADATAK 1

echo "<h2>Zadatak 1</h2>";

$niz = range(200, 200 + 14 * 10, 10);

echo "<pre>Originalni niz:\n";
print_r($niz);
echo "</pre>";

$novi = array_splice($niz, 5, 5);

echo "<pre>Originalni nakon rezanja:\n";
print_r($niz);
echo "Novi niz:\n";
print_r($novi);
echo "</pre>";

array_splice($novi, 1, 1, [-5, -15, -25]);

echo "<pre>Novi niz nakon umetanja tri elementa:\n";
print_r($novi);
echo "</pre>";


#ZADATAK 2

echo "<h2>Zadatak 2</h2>";

$artikli = ["Kava", "Šampon", "Tipkovnica", "Majica", "Čips"];
$proizv = ["Franck", "Nivea", "Logitech", "Adidas", "Lays"];
$cijene = [4.5, 3.2, 59.9, 19.9, 2.5];

$indeksi = array_keys($cijene);
usort($indeksi, function($a, $b) use ($cijene) {
    return $cijene[$b] <=> $cijene[$a];
});

echo "<table border='1' cellpadding='5'>
<tr><th>Artikl</th><th>Proizvođač</th><th>Cijena</th></tr>";

foreach ($indeksi as $i) {
    echo "<tr>
            <td>{$artikli[$i]}</td>
            <td>{$proizv[$i]}</td>
            <td>{$cijene[$i]} €</td>
          </tr>";
}
echo "</table>";


# ZADATAK 3

echo "<h2>Zadatak 3</h2>";

$autici = [
    "Audi" => "limuzina",
    "BMW" => "karavan",
    "Toyota" => "SUV",
    "Renault" => "hečbek",
    "Mercedes" => "limuzina",
    "Mazda" => "coupe"
];

echo '
<form method="post">
    <label>Odaberi način sortiranja:</label><br>
    <select name="sortiranje3">
        <option value="ksort">Sortiraj po ključu rastuće</option>
        <option value="krsort">Sortiraj po ključu padajuće</option>
        <option value="asort">Sortiraj po vrijednosti rastuće</option>
        <option value="arsort">Sortiraj po vrijednosti padajuće</option>
    </select>
    <button type="submit" name="btn3">Sortiraj</button>
</form>
';

if (isset($_POST["btn3"])) {
    $choice = $_POST["sortiranje3"];

    if ($choice == "ksort") ksort($autici);
    if ($choice == "krsort") krsort($autici);
    if ($choice == "asort") asort($autici);
    if ($choice == "arsort") arsort($autici);

    echo "<pre>Sortirani niz:\n";
    print_r($autici);
    echo "</pre>";
}


# ZADATAK 4

echo "<h2>Zadatak 4</h2>";

$niz4 = [];
for ($i = 0; $i < 10; $i++) {
    $niz4[$i] = rand(1, 100);
}

shuffle($niz4);

echo "<pre>Niz nakon shuffle:\n";
print_r($niz4);
echo "</pre>";

echo '
<form method="post">
    <label>Odaberi sortiranje:</label><br>
    <select name="sortiranje4">
        <option value="sort">Rastuće, promjena ključeva (sort)</option>
        <option value="rsort">Padajuće, promjena ključeva (rsort)</option>
        <option value="asort">Rastuće, bez promjene ključeva (asort)</option>
        <option value="arsort">Padajuće, bez promjene ključeva (arsort)</option>
    </select>
    <button type="submit" name="btn4">Sortiraj</button>
</form>
';

if (isset($_POST["btn4"])) {
    $choice4 = $_POST["sortiranje4"];
    $temp = $niz4;

    if ($choice4 == "sort") sort($temp);
    if ($choice4 == "rsort") rsort($temp);
    if ($choice4 == "asort") asort($temp);
    if ($choice4 == "arsort") arsort($temp);

    echo "<pre>Sortirani niz:\n";
    print_r($temp);
    echo "</pre>";
}

?>
