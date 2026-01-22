<?php
$dan = $_POST['dan'] ?? "";
$mjesec = $_POST['mjesec'] ?? "";
$godina = $_POST['godina'] ?? "";

$error = "";
$daysOld = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = (int)$dan; $m = (int)$mjesec; $y = (int)$godina;

    if (!checkdate($m, $d, $y)) {
        $error = "Unesi ispravan datum rođenja.";
    } else {
        $birth = new DateTime(sprintf('%04d-%02d-%02d', $y, $m, $d));
        $today = new DateTime('today');

        if ($birth > $today) {
            $error = "Datum rođenja ne može biti u budućnosti.";
        } else {
            $diff = $birth->diff($today);
            $daysOld = $diff->days; // ukupno dana
        }
    }
}
?>
<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <title>Zadatak 2 – Starost u danima</title>
</head>
<body>
<h2>Zadatak 2: Starost u danima</h2>

<form method="post">
    <label>Dan:
        <input type="number" name="dan" value="<?= htmlspecialchars($dan) ?>" min="1" max="31" required>
    </label>
    <label>Mjesec:
        <input type="number" name="mjesec" value="<?= htmlspecialchars($mjesec) ?>" min="1" max="12" required>
    </label>
    <label>Godina:
        <input type="number" name="godina" value="<?= htmlspecialchars($godina) ?>" min="1" max="9999" required>
    </label>
    <button type="submit">Izračunaj</button>
</form>

<?php if ($error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php elseif ($daysOld !== null): ?>
    <p>Starost u danima: <b><?= (int)$daysOld ?></b></p>
<?php endif; ?>

<p><a href="index.php">← natrag</a></p>
</body>
</html>

