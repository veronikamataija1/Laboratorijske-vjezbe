<?php
function h($s) { return htmlspecialchars($s ?? "", ENT_QUOTES, 'UTF-8'); }

function provjeri_ime($v) {
    return trim($v) === "" ? "Nije uneseno ime<br>" : "";
}
function provjeri_prezime($v) {
    return trim($v) === "" ? "Nije uneseno prezime<br>" : "";
}
function provjeri_korisnicko($v) {
    if (strlen($v) < 5) return "Korisničko ime mora imati barem 5 znakova<br>";
    if (preg_match('/[^a-zA-Z0-9_-]/', $v)) return "Korisničko ime smije sadržavati samo slova, brojeve, _ i -<br>";
    return "";
}
function provjeri_lozinku($v) {
    if (strlen($v) < 6) return "Lozinka mora imati barem 6 znakova<br>";
    if (!preg_match('/[a-z]/', $v) || !preg_match('/[A-Z]/', $v) || !preg_match('/[0-9]/', $v))
        return "Lozinka mora imati barem jedno malo slovo, jedno veliko slovo i jedan broj<br>";
    return "";
}
function provjeri_dob($v) {
    if ($v === "" || !is_numeric($v)) return "Dob mora biti broj<br>";
    $d = (int)$v;
    if ($d < 18 || $d > 110) return "Dob mora biti između 18 i 110<br>";
    return "";
}
function provjeri_email($v) {
    if (!((strpos($v, ".") > 0) && (strpos($v, "@") > 0)) || preg_match('/[^a-zA-Z0-9.@_]/', $v))
        return "E-mail adresa nije ispravna<br>";
    return "";
}

$ime = $_POST['ime'] ?? "";
$prezime = $_POST['prezime'] ?? "";
$korisnicko = $_POST['korisnicko'] ?? "";
$lozinka = $_POST['lozinka'] ?? "";
$dob = $_POST['dob'] ?? "";
$email = $_POST['email'] ?? "";

$eIme = provjeri_ime($ime);
$ePrez = provjeri_prezime($prezime);
$eKor = provjeri_korisnicko($korisnicko);
$eLoz = provjeri_lozinku($lozinka);
$eDob = provjeri_dob($dob);
$eEmail = provjeri_email($email);

$greska = $eIme.$ePrez.$eKor.$eLoz.$eDob.$eEmail;

if ($greska === "") {
    echo "<!doctype html><html lang='hr'><head><meta charset='utf-8'><title>Uspjeh</title></head><body>";
    echo "<h2>Podaci su uspješno uneseni:</h2>";
    echo "<ul>";
    echo "<li>Ime: <b>".h($ime)."</b></li>";
    echo "<li>Prezime: <b>".h($prezime)."</b></li>";
    echo "<li>Korisničko ime: <b>".h($korisnicko)."</b></li>";
    echo "<li>Dob: <b>".h($dob)."</b></li>";
    echo "<li>E-mail: <b>".h($email)."</b></li>";
    echo "</ul>";
    echo "<p><a href='FormaZaUnos.php'>Unesi novog korisnika</a></p>";
    echo "<p><a href='index.php'>← natrag</a></p>";
    echo "</body></html>";
    exit;
}

// ako je polje neispravno -> isprazni ga (da se ponovno unese)
// lozinka se uvijek traži ponovno
if ($eIme) $ime = "";
if ($ePrez) $prezime = "";
if ($eKor) $korisnicko = "";
$lozinka = "";
if ($eDob) $dob = "";
if ($eEmail) $email = "";

echo "<!doctype html><html lang='hr'><head><meta charset='utf-8'><title>Ponovni unos</title>";

echo <<<_JS
<script>
  function provjeri(form) {
    let greska = "";
    function provjeriIme(p){ if(p.trim()==="") return "Ime nije uneseno.\\n"; return ""; }
    function provjeriPrezime(p){ if(p.trim()==="") return "Prezime nije uneseno.\\n"; return ""; }
    function provjeriKorisnicko(p){
      if(p.length<5) return "Korisničko ime mora imati barem 5 znakova.\\n";
      if(/[^a-zA-Z0-9_-]/.test(p)) return "Korisničko ime smije sadržavati samo slova, brojeve, _ i -.\\n";
      return "";
    }
    function provjeriLozinku(p){
      if(p.length<6) return "Lozinka mora imati barem 6 znakova.\\n";
      if(!/[a-z]/.test(p) || !/[A-Z]/.test(p) || !/[0-9]/.test(p)) return "Lozinka mora imati barem jedno malo, jedno veliko slovo i jedan broj.\\n";
      return "";
    }
    function provjeriDob(p){
      let d=parseInt(p,10); if(isNaN(d)) return "Dob mora biti broj.\\n";
      if(d<18 || d>110) return "Dob mora biti između 18 i 110.\\n";
      return "";
    }
    function provjeriEmail(p){
      if(!((p.indexOf(".")>0) && (p.indexOf("@")>0)) || /[^a-zA-Z0-9.@_]/.test(p)) return "E-mail adresa nije ispravna.\\n";
      return "";
    }

    greska += provjeriIme(form.ime.value);
    greska += provjeriPrezime(form.prezime.value);
    greska += provjeriKorisnicko(form.korisnicko.value);
    greska += provjeriLozinku(form.lozinka.value);
    greska += provjeriDob(form.dob.value);
    greska += provjeriEmail(form.email.value);

    if(greska==="") return true;
    alert(greska); return false;
  }
</script>
</head><body>
_JS;

echo "<table border='0' cellpadding='2' cellspacing='5' bgcolor='#FFCC66'>";
echo "<tr><th colspan='2' align='center'>Unos novog korisnika</th></tr>";
echo "<tr><td colspan='2'>Pronađene su slijedeće greške na formi:<br><p><font color='red'>$greska</font></p></td></tr>";

echo "<form method='post' action='UnesiKorisnika.php' onsubmit='return provjeri(this)'>";
echo "<tr><td>Ime</td><td><input type='text' name='ime' value='".h($ime)."'></td></tr>";
echo "<tr><td>Prezime</td><td><input type='text' name='prezime' value='".h($prezime)."'></td></tr>";
echo "<tr><td>Korisničko ime</td><td><input type='text' name='korisnicko' value='".h($korisnicko)."'></td></tr>";
echo "<tr><td>Lozinka</td><td><input type='password' name='lozinka' value=''></td></tr>";
echo "<tr><td>Dob</td><td><input type='number' name='dob' value='".h($dob)."'></td></tr>";
echo "<tr><td>E-mail</td><td><input type='text' name='email' value='".h($email)."'></td></tr>";

echo "<tr><td colspan='2' align='center'><input type='submit' value='Unesi'></td></tr>";
echo "</form></table>";

echo "<p><a href='index.php'>← natrag</a></p>";
echo "</body></html>";

