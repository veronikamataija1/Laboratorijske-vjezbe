<?php
function isLeap($y) {
    return ($y % 4 === 0) && (($y % 100 !== 0) || ($y % 400 === 0));
}
$leaps = [];
for ($y=1979; $y<=2037; $y++) {
    if (isLeap($y)) $leaps[] = $y;
}
?>
<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <title>Zadatak 3 – Prijestupne godine</title>
</head>
<body>
<h2>Zadatak 3: Prijestupne godine (1979–2037)</h2>
<p>Prijestupne godine su:</p>
<p><?= implode(', ', $leaps) ?></p>

<p><a href="index.php">← natrag</a></p>
</body>
</html>

