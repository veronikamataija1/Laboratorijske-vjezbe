<?php
// index.php  –  PHP laboratorijska vježba 7

mb_internal_encoding("UTF-8");

// ---------------------------------------
// Inicijalizacija varijabli za sve zadatke
// ---------------------------------------

// Zadatak 1
$zad1_parni   = [];
$zad1_neparni = [];
$zad1_ulaz    = '';

// Zadatak 2
$ime = '';
$prezime = '';
$ime_prezime_malo = '';
$ime_prezime_veliko = '';
$ime_prezime_prvo_veliko = '';
$inicijali = '';

// Zadatak 3
$palindrom_ulaz = '';
$palindrom_broj = '';
$palindrom_poruka = '';
$palindrom_ponavljanje = '';

// Zadatak 4
$orig_niz = '';
$novi_niz = '';
$pozicija = '';
$duljina = '';
$rezultat_zamjene = '';

// ---------------------------------------
// Obrada forme
// ---------------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ---------------- ZADATAK 1 ----------------
    if (isset($_POST['zad1_submit'])) {
        $zad1_ulaz = $_POST['brojevi'] ?? '';
        $zad1_ulaz = trim($zad1_ulaz);

        if ($zad1_ulaz !== '') {
            $brojevi = explode(',', $zad1_ulaz);

            foreach ($brojevi as $b) {
                $b = trim($b);

                if ($b === '') continue;        // preskoči prazno
                if (!is_numeric($b)) continue;  // preskoči ako nije broj

                $n = (int)$b;
                if ($n % 2 === 0) {
                    $zad1_parni[] = $n;
                } else {
                    $zad1_neparni[] = $n;
                }
            }
        }
    }

    // ---------------- ZADATAK 2 ----------------
    if (isset($_POST['zad2_submit'])) {
        $ime = isset($_POST['ime']) ? trim($_POST['ime']) : '';
        $prezime = isset($_POST['prezime']) ? trim($_POST['prezime']) : '';

        if ($ime !== '' && $prezime !== '') {
            $puno = $ime . ' ' . $prezime;

            $ime_prezime_malo   = strtolower($puno);
            $ime_prezime_veliko = strtoupper($puno);
            $ime_prezime_prvo_veliko = ucwords(strtolower($puno));

            // inicijali – uzimamo prvo slovo imena i prezimena
            $inic_ime = mb_substr($ime, 0, 1);
            $inic_prezime = mb_substr($prezime, 0, 1);
            $inicijali = strtoupper($inic_ime) . '.' . strtoupper($inic_prezime) . '.';
        }
    }

    // ---------------- ZADATAK 3 ----------------
    if (isset($_POST['zad3_submit'])) {
        $palindrom_ulaz = $_POST['palindrom'] ?? '';
        $palindrom_broj = $_POST['broj_ponavljanja'] ?? '';
        $palindrom_ulaz = trim($palindrom_ulaz);
        $palindrom_broj = (int)$palindrom_broj;

        if ($palindrom_ulaz !== '') {
            // maknemo razmake i stavimo sve u mala slova
            $ociscen = strtolower(str_replace(' ', '', $palindrom_ulaz));
            $obrnuti = strrev($ociscen);

            if ($ociscen === $obrnuti) {
                $palindrom_poruka = 'Uneseni niz JE palindrom.';
            } else {
                $palindrom_poruka = 'Uneseni niz NIJE palindrom.';
            }
        }

        if ($palindrom_broj > 0 && $palindrom_ulaz !== '') {
            $palindrom_ponavljanje = '';
            for ($i = 0; $i < $palindrom_broj; $i++) {
                $palindrom_ponavljanje .= $palindrom_ulaz . ' ';
            }
        }
    }

    // ---------------- ZADATAK 4 ----------------
    if (isset($_POST['zad4_submit'])) {
        $orig_niz = $_POST['orig_niz'] ?? '';
        $novi_niz = $_POST['novi_niz'] ?? '';
        $pozicija = (int)($_POST['pozicija'] ?? 0);
        $duljina = (int)($_POST['duljina'] ?? 0);

        if ($pozicija < 0) $pozicija = 0;
        if ($duljina < 0)  $duljina  = 0;

        $rezultat_zamjene = substr_replace($orig_niz, $novi_niz, $pozicija, $duljina);
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <title>Bootstrap u PHP-u – Vježba 7</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (prema zadatku) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #f5f7fa;
        }
        h1 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .card {
            margin-top: 20px;
        }
        .card-header {
            font-weight: bold;
        }
        .output-box {
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 4px;
            padding: 10px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>PHP laboratorijska vježba 7</h1>
    <p>Primjeri rješenja zadataka 1–4 na jednoj stranici.</p>

    <!-- ==================== ZADATAK 1 ==================== -->
    <div class="card">
        <div class="card-header">Zadatak 1 – parni i neparni brojevi</div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="brojevi">Unesite cijele brojeve razdvojene zarezom (npr. 1,2,3,4,5):</label>
                    <input type="text" class="form-control" id="brojevi" name="brojevi"
                           value="<?php echo htmlspecialchars($zad1_ulaz); ?>">
                </div>
                <button type="submit" name="zad1_submit" class="btn btn-primary">Pošalji</button>
            </form>

            <?php if (!empty($zad1_parni) || !empty($zad1_neparni)) : ?>
                <hr>
                <h5>Parni brojevi:</h5>
                <div class="output-box">
                    <?php
                    if (!empty($zad1_parni)) {
                        echo implode(', ', $zad1_parni);
                    } else {
                        echo 'Nema parnih brojeva.';
                    }
                    ?>
                </div>

                <h5 class="mt-3">Neparni brojevi:</h5>
                <div class="output-box">
                    <?php
                    if (!empty($zad1_neparni)) {
                        echo implode(', ', $zad1_neparni);
                    } else {
                        echo 'Nema neparnih brojeva.';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ==================== ZADATAK 2 ==================== -->
    <div class="card">
        <div class="card-header">Zadatak 2 – ime i prezime</div>
        <div class="card-body">
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ime">Ime:</label>
                        <input type="text" class="form-control" id="ime" name="ime"
                               value="<?php echo htmlspecialchars($ime); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prezime">Prezime:</label>
                        <input type="text" class="form-control" id="prezime" name="prezime"
                               value="<?php echo htmlspecialchars($prezime); ?>">
                    </div>
                </div>
                <button type="submit" name="zad2_submit" class="btn btn-primary">Pošalji</button>
            </form>

            <?php if ($ime_prezime_malo !== '') : ?>
                <hr>
                <p><strong>Samo malim slovima:</strong> <?php echo htmlspecialchars($ime_prezime_malo); ?></p>
                <p><strong>Sve velikim slovima:</strong> <?php echo htmlspecialchars($ime_prezime_veliko); ?></p>
                <p><strong>Prva slova velika:</strong> <?php echo htmlspecialchars($ime_prezime_prvo_veliko); ?></p>
                <p><strong>Inicijali:</strong> <?php echo htmlspecialchars($inicijali); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ==================== ZADATAK 3 ==================== -->
    <div class="card">
        <div class="card-header">Zadatak 3 – palindrom i ponavljanje niza</div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="palindrom">Unesite niz znakova:</label>
                    <input type="text" class="form-control" id="palindrom" name="palindrom"
                           value="<?php echo htmlspecialchars($palindrom_ulaz); ?>">
                </div>
                <div class="form-group">
                    <label for="broj_ponavljanja">Unesite broj ponavljanja:</label>
                    <input type="number" class="form-control" id="broj_ponavljanja" name="broj_ponavljanja" min="1"
                           value="<?php echo htmlspecialchars($palindrom_broj); ?>">
                </div>
                <button type="submit" name="zad3_submit" class="btn btn-primary">Pošalji</button>
            </form>

            <?php if ($palindrom_poruka !== '') : ?>
                <hr>
                <p><strong><?php echo htmlspecialchars($palindrom_poruka); ?></strong></p>
            <?php endif; ?>

            <?php if ($palindrom_ponavljanje !== '') : ?>
                <h5>Ponavljanje niza:</h5>
                <div class="output-box">
                    <?php echo htmlspecialchars($palindrom_ponavljanje); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ==================== ZADATAK 4 ==================== -->
    <div class="card mb-4">
        <div class="card-header">Zadatak 4 – substr_replace</div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="orig_niz">Originalni niz znakova:</label>
                    <input type="text" class="form-control" id="orig_niz" name="orig_niz"
                           value="<?php echo htmlspecialchars($orig_niz); ?>">
                </div>

                <div class="form-group">
                    <label for="novi_niz">Novi niz (s kojim mijenjate dio originalnog):</label>
                    <input type="text" class="form-control" id="novi_niz" name="novi_niz"
                           value="<?php echo htmlspecialchars($novi_niz); ?>">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pozicija">Pozicija početka zamjene (počinje od 0):</label>
                        <input type="number" class="form-control" id="pozicija" name="pozicija" min="0"
                               value="<?php echo htmlspecialchars($pozicija); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="duljina">Koliko znakova zamijeniti:</label>
                        <input type="number" class="form-control" id="duljina" name="duljina" min="0"
                               value="<?php echo htmlspecialchars($duljina); ?>">
                    </div>
                </div>

                <button type="submit" name="zad4_submit" class="btn btn-primary">Pošalji</button>
            </form>

            <?php if ($rezultat_zamjene !== '' || isset($_POST['zad4_submit'])) : ?>
                <hr>
                <h5>Rezultat:</h5>
                <div class="output-box">
                    <?php echo htmlspecialchars($rezultat_zamjene); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Bootstrap JS (prema zadatku) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
