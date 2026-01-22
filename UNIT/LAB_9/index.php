<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>PHP – Labos 9</title>
</head>
<body>

<h1>PHP – Laboratorijska vježba 9</h1>

<?php

echo "<h2>Zadatak 1</h2>";

class Artikl1 {
    public $naziv;
    public $proizvodac;

    public function __construct($proizvodac) {
        $this->proizvodac = $proizvodac;
    }

    public function __destruct() {
        echo "Uništavam objekt... <br>";
    }
}


$a1 = new Artikl1("Sony");
$a1->naziv = "TV";

$a2 = new Artikl1("Samsung");
$a2->naziv = "Mobitel";

echo $a1->naziv . " - " . $a1->proizvodac . "<br>";
echo $a2->naziv . " - " . $a2->proizvodac . "<br>";

echo "<p><i>Poruka \"Uništavam objekt...\" će se ispisati dva puta – jednom za svaki objekt.</i></p>";



echo "<hr><h2>Zadatak 2</h2>";

class Pijetao {
    public $ime;
    protected $boja = "crveno-smeđa";
    private $glavni = "ne";

    public function pjevaj() {
        echo "kukurikuuuu<br>";
    }
}

class Pilic extends Pijetao {
    public $ZnakHoroskopa = "Bik";
    protected $boja = "žuta"; // pregazili boju

    public function pjevaj() { // pregazili metodu
        echo "pijuuuuuu<br>";
    }
}

$p = new Pijetao();
$pi = new Pilic();

$p->ime = "Pijetao Pero";
$pi->ime = "Pilić Žućko";

echo "<strong>Pijetao:</strong> " . $p->ime . "<br>";
echo "<strong>Pilić:</strong> " . $pi->ime . "<br><br>";

echo "Poziv pjevaj() za pijetla: ";
$p->pjevaj();

echo "Poziv pjevaj() za pilića: ";
$pi->pjevaj();

echo "<br><strong>Znak horoskopa pilića:</strong> " . $pi->ZnakHoroskopa . "<br><br>";

echo "<p><b>Objašnjenje grešaka (te linije bi dizale error da ih odkomentiraš):</b></p>";
echo "<pre>";
echo "// \$p->boja;   // GREŠKA: boja je protected – ne može se pristupati izvana\n";
echo "// \$p->glavni; // GREŠKA: glavni je private – nije dostupan izvan klase\n";
echo "// \$pi->glavni; // GREŠKA: private se ne nasljeđuje i nedostupan je izvana\n";
echo "</pre>";



echo "<hr><h2>Zadatak 3</h2>";

class Artikl3 {
    public $naziv;
    public $kolicina;
    public $cijena;

    public function RacunajVrijednost() {
        return $this->cijena * $this->kolicina;
    }

    public function AzurirajKolicinu($kol) {
        $this->kolicina += $kol;
        echo "Nova količina: " . $this->kolicina . "<br>";
    }
}


$a3 = new Artikl3();
$a3->naziv = "Laptop";
$a3->kolicina = 10;
$a3->cijena = 900;

echo "Artikl: " . $a3->naziv . "<br>";
echo "Početna količina: " . $a3->kolicina . "<br>";
echo "Cijena: " . $a3->cijena . " kn<br>";
echo "Vrijednost artikla: " . $a3->RacunajVrijednost() . " kn<br>";

if (isset($_POST['kol3'])) {
    $unosKol = (int)$_POST['kol3'];
    echo "<br>Promjena količine: $unosKol<br>";
    $a3->AzurirajKolicinu($unosKol);
}

?>

<form method="post">
    <label>Unesi količinu (+ ili -) za Zadatak 3:</label>
    <input type="number" name="kol3">
    <button type="submit">Ažuriraj</button>
</form>

<?php

echo "<hr><h2>Zadatak 4</h2>";

class Artikl4 {
    public $naziv;
    public $kolicina;
    public $cijena;

    private $popust = 0;

    public function __set($name, $value) {
        if ($name == "popust") {
            if ($value > 50) {
                echo "Popust je prevelik – postavljam na 0%<br>";
                $this->popust = 0;
            } else {
                $this->popust = $value;
            }
        }
    }

    public function __get($name) {
        if ($name == "popust") {
            return $this->popust;
        }
    }

    public function RacunajVrijednost() {
        return $this->cijena * $this->kolicina;
    }

    public function VrijednostSPopustom() {
        return $this->RacunajVrijednost() * (1 - $this->popust / 100);
    }
}


$a4 = new Artikl4();
$a4->naziv = "Monitor";
$a4->kolicina = 5;
$a4->cijena = 800;

echo "Artikl: " . $a4->naziv . "<br>";
echo "Količina: " . $a4->kolicina . "<br>";
echo "Cijena: " . $a4->cijena . " kn<br>";
echo "Vrijednost bez popusta: " . $a4->RacunajVrijednost() . " kn<br><br>";

if (isset($_POST['popust4'])) {
    $unosPopust = (int)$_POST['popust4'];
    $a4->popust = $unosPopust;

    echo "Postavljeni popust: " . $a4->popust . "%<br>";
    echo "Vrijednost s popustom: " . $a4->VrijednostSPopustom() . " kn<br>";
}
?>

<form method="post">
    <label>Unesi popust za Zadatak 4 (u %):</label>
    <input type="number" name="popust4">
    <button type="submit">Primijeni popust</button>
</form>

</body>
</html>
