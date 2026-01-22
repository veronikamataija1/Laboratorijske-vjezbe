<?php
$dir = "C:\\xampp";   // Windows putanja

if (!is_dir($dir)) {
    die("Direktorij ne postoji: $dir");
}

$stavke = scandir($dir);

echo "<h3>Sadržaj direktorija: $dir</h3>";
echo "<ul>";

foreach ($stavke as $s) {
    if ($s === "." || $s === "..") continue;

    $punaPutanja = $dir . "\\" . $s;

    // ispisujemo samo DATOTEKE, ne direktorije
    if (is_file($punaPutanja)) {
        echo "<li>$s</li>";
    }
}

echo "</ul>";
?>

