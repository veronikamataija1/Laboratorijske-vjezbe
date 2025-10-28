<?php

// LABOS 3 – PHP


echo "<h1>Odaberi zadatak</h1>";
echo "<a href='?zad=1'>Zadatak 1</a> | ";
echo "<a href='?zad=2'>Zadatak 2</a> | ";
echo "<a href='?zad=3'>Zadatak 3</a> | ";
echo "<a href='?zad=4'>Zadatak 4</a> | ";
echo "<a href='?zad=5'>Zadatak 5</a> | ";
echo "<a href='?zad=6'>Zadatak 6</a> | ";



// ZADATAK 1

if (isset($_GET['zad']) && $_GET['zad'] == 1) {
    echo "<h2>Zadatak 1</h2>";

    function rezultat($k1, $k2) {
        if ($k1 < 40 || $k2 < 40) return "Pad";
        elseif (($k1 >= 40 && $k2 >= 40) && ($k1 < 50 || $k2 < 50)) return "Ponavljanje kolokvija";
        elseif ($k1 + $k2 >= 100) return "Položeno";
        else return "Ponavljanje kolokvija";
    }

    if (isset($_POST['k1']) && isset($_POST['k2'])) {
        $poruka = rezultat($_POST['k1'], $_POST['k2']);
        echo "<p>Rezultat: $poruka</p>";
    }
    ?>

    <form method="post">
        Kolokvij 1: <input type="number" name="k1"><br>
        Kolokvij 2: <input type="number" name="k2"><br>
        <input type="submit" value="Provjeri">
    </form>

    <?php
}


// ZADATAK 2

if (isset($_GET['zad']) && $_GET['zad'] == 2) {
    echo "<h2>Zadatak 2</h2>";

    $v = 50;

    function Oduzmi() {
        global $v;
        $v -= 20;
    }

    function Dodaj() {
        global $v;
        $v += 60;
    }

    Oduzmi();
    echo "<p>Nakon Oduzmi(): $v</p>";

    Dodaj();
    echo "<p>Nakon Dodaj(): $v</p>";
}


// ZADATAK 3
if (isset($_GET['zad']) && $_GET['zad'] == 3) {
    echo "<h2>Zadatak 3</h2>";

    function Ispis() {
        static $st = 20;
        echo $st . "<br>";
        $st++;
    }

    for ($i = 0; $i < 10; $i++) {
        Ispis();
    }
}


// ZADATAK 4

if (isset($_GET['zad']) && $_GET['zad'] == 4) {
    echo "<h2>Zadatak 4</h2>";

    if (isset($_POST['a']) && isset($_POST['b'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];

        echo "<h3>Neparni brojevi između $a i $b (for petlja):</h3>";
        for ($i = $a; $i <= $b; $i++) {
            if ($i % 2 != 0) echo "$i ";
        }

        echo "<h3>Neparni brojevi između $a i $b (while petlja):</h3>";
        $i = $a;
        while ($i <= $b) {
            if ($i % 2 != 0) echo "$i ";
            $i++;
        }
    }
    ?>

    <form method="post">
        Prvi broj: <input type="number" name="a"><br>
        Drugi broj: <input type="number" name="b"><br>
        <input type="submit" value="Prikaži">
    </form>

    <?php
}


// ZADATAK 5

if (isset($_GET['zad']) && $_GET['zad'] == 5) {
    echo "<h2>Zadatak 5</h2>";

    if (isset($_POST['broj'])) {
        $n = $_POST['broj'];
        echo "<h3>Djelitelji broja $n:</h3>";
        $i = 1;
        do {
            if ($n % $i == 0) echo "$i ";
            $i++;
        } while ($i <= $n);
    }
    ?>

    <form method="post">
        Unesi broj: <input type="number" name="broj"><br>
        <input type="submit" value="Prikaži djelitelje">
    </form>

    <?php
}


// ZADATAK 6

if (isset($_GET['zad']) && $_GET['zad'] == 6) {
    echo "<h2>Zadatak 6</h2>";

    if (isset($_POST['broj'])) {
        $n = $_POST['broj'];
        $prost = true;

        for ($i = 2; $i <= $n / 2; $i++) {
            if ($n % $i == 0) {
                $prost = false;
                break;
            }
        }

        echo $prost ? "<p>$n je prost broj.</p>" : "<p>$n nije prost broj.</p>";
    }
    ?>

    <form method="post">
        Unesi broj: <input type="number" name="broj"><br>
        <input type="submit" value="Provjeri">
    </form>

    <?php
}
?>
