<?php
$year = $_POST['year'] ?? "";
$monthsCro = [
    1=>'siječanj',2=>'veljača',3=>'ožujak',4=>'travanj',5=>'svibanj',6=>'lipanj',
    7=>'srpanj',8=>'kolovoz',9=>'rujan',10=>'listopad',11=>'studeni',12=>'prosinac'
];

$result = [];
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $yearInt = (int)$year;
    if ($year === "" || $yearInt < 1 || $yearInt > 9999) {
        $error = "Unesi ispravnu godinu (1–9999).";
    } else {
        for ($m=1; $m<=12; $m++) {
            $dt = new DateTime(sprintf('%04d-%02d-13', $yearInt, $m));
            // N: 1=pon ... 5=pet ... 7=ned
            if ((int)$dt->format('N') === 5) {
                $result[] = $monthsCro[$m];
            }
        }
    }
}
?>
<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <title>Zadatak 1 – Petak 13.</title>
</head>
<body>
<h2>Zadatak 1: Mjeseci u kojima je 13. petak</h2>

<form method="post">
    <label>Godina:
        <input type="number" name="year" value="<?= htmlspecialchars($year) ?>" min="1" max="9999" required>
    </label>
    <button type="submit">Provjeri</button>
</form>

<?php if ($error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <h3>Godina: <?= (int)$year ?></h3>
    <?php if (count($result) === 0): ?>
        <p>Nema mjeseci u kojima je 13. petak (neobično, ali moguće ovisno o validaciji).</p>
    <?php else: ?>
        <p>13. je petak u mjesecima:</p>
        <ul>
            <?php foreach ($result as $mname): ?>
                <li><?= htmlspecialchars($mname) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<p><a href="index.php">← natrag</a></p>
</body>
</html>

