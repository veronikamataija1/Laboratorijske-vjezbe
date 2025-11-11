<?php

echo "<h2>Zadatak 1</h2>";

/* 1) Indeksirani niz */
$polje = [];
for ($i = 0; $i < 20; $i++) {
    $polje[$i] = $i * 5 * 3; // petostruka vrijednost indeksa
}

echo "Zbroj elemenata je " . array_sum($polje) . "<br>";
echo "Broj elemenata je " . count($polje) . "<br>";

unset($polje[9]);
echo "Nakon brisanja broj elemenata je " . count($polje) . "<br>";

$polje[] = 999;

echo "Elementi niza:<br>";
foreach ($polje as $el) {
    echo $el . "<br>";
}



echo "<hr><h2>Zadatak 2</h2>";

/* 2) Indeksirani niz – prosjek, min, max */
$polje2 = [];
for ($i = 0; $i < 10; $i++) {
    $polje2[$i] = rand(1, 100);
}

$prosjek = array_sum($polje2) / count($polje2);
$min = min($polje2);
$max = max($polje2);

echo "Elementi: " . implode(", ", $polje2) . "<br>";
echo "Prosjek: $prosjek<br>";
echo "Min: $min<br>";
echo "Max: $max<br>";



echo "<hr><h2>Zadatak 3</h2>";

/* 3) Asocijativni niz */
$drzave = [
    "Hrvatska" => "Zagreb",
    "Slovenija" => "Ljubljana",
    "Srbija" => "Beograd",
    "Austrija" => "Beč",
    "Mađarska" => "Budimpešta"
];

$drzave["Njemačka"] = "Berlin";

foreach ($drzave as $drzava => $grad) {
    echo "$drzava – $grad<br>";
}



echo "<hr><h2>Zadatak 4</h2>";

/* 4) array_keys i array_values */
$original = $drzave;

$kljucevi = array_keys($original);
$vrijednosti = array_values($original);

echo "<pre>";
echo "Ključevi:\n";
print_r($kljucevi);

echo "\nVrijednosti:\n";
print_r($vrijednosti);
echo "</pre>";



echo "<hr><h2>Zadatak 5</h2>";

/* 5) Tri niza i skupovne operacije */
$prvi  = ["jabuka","kruška","ananas","kivi","jagoda"];
$drugi = ["jagoda","šljiva","malina","trešnja"];
$treci = ["jagoda","jabuka","kupina","mango"];

$unija = array_unique(array_merge($prvi, $drugi));
$razlika = array_diff($prvi, $drugi);
$presjek = array_intersect($prvi, $drugi);

echo "Unija prvog i drugog:<br>";
print_r($unija);

echo "<br><br>Razlika prvog i drugog:<br>";
print_r($razlika);

echo "<br><br>Presjek prvog i drugog:<br>";
print_r($presjek);

?>
