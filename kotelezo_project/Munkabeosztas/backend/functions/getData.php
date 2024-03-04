<?php
include_once("db.php");
session_start();
function getUsername($username){
    $connect = connectToDatabase();

    $result = mysqli_query($connect, "SELECT elotag FROM munkasok WHERE elotag = '$username'");

    if ($result === false) {
        die(mysqli_error($connect));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        $elotag = $row['elotag'];
    } else {
        $elotag = null;
    }

    mysqli_close($connect);
    return $elotag;
}

function login($username, $password) {
    $connect = connectToDatabase();

    $result = mysqli_query($connect, "SELECT dolgozo_azonosito,jelszo, elotag, nev, munkakori_beosztas FROM munkasok WHERE elotag = '$username'");

    if ($result === false) {
        die(mysqli_error($connect));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['jelszo'])) {
            $_SESSION['userLevel'] = ($row['munkakori_beosztas'] == 1) ? 1 : 0;
            mysqli_close($connect);
            return true;
        }
    }

    mysqli_close($connect);
    return false;
}

function getUsers(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT * FROM munkasok WHERE NOT elotag = 'admin'");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}
function getReszlegName($name){
    $connect = connectToDatabase();

    $result = mysqli_query($connect, "SELECT reszleg_neve FROM reszlegek WHERE reszleg_neve = '$name'");

    if ($result === false) {
        die(mysqli_error($connect));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        $reszlegneve = $row['reszleg_neve'];
    } else {
        $reszlegneve = null;
    }

    mysqli_close($connect);
    return $reszlegneve;
}

function getReszleg(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT reszleg_azonosito, reszleg_neve, reszleg_helye, munkasok.nev AS vezeto 
                                            FROM reszlegek 
                                            LEFT JOIN munkasok ON reszlegek.reszleg_vezetoje = munkasok.dolgozo_azonosito;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function getMuszakAdmin(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT id, munkasok.nev AS nev, reszlegek.reszleg_neve AS reszleg, munkaoraszam, datum, muszakbeosztas, feladatkor 
                                            FROM muszakbeosztasok 
                                            LEFT JOIN munkasok ON muszakbeosztasok.dolgozo_azonosito  = munkasok.dolgozo_azonosito
                                            LEFT JOIN reszlegek ON muszakbeosztasok.reszleg_azonosito   = reszlegek.reszleg_azonosito;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function getDolgozhat($id){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT datum FROM muszakbeosztasok 
                                            WHERE id = $id;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function getMuszakUpdate($id){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT id,munkasok.dolgozo_azonosito AS dolgozoid, munkasok.nev AS nev, reszlegek.reszleg_neve AS reszlegnev, reszlegek.reszleg_azonosito AS reszlegid, munkaoraszam, datum, muszakbeosztas, feladatkor 
                                            FROM muszakbeosztasok 
                                            LEFT JOIN munkasok ON muszakbeosztasok.dolgozo_azonosito  = munkasok.dolgozo_azonosito
                                            LEFT JOIN reszlegek ON muszakbeosztasok.reszleg_azonosito   = reszlegek.reszleg_azonosito
                                            WHERE id = $id;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function getreszlegchange($id){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT reszleg_azonosito FROM muszakbeosztasok WHERE id = $id;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function lekerdezes1(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT
                                            YEAR(muszakbeosztasok.datum) AS ev,
                                            MONTH(muszakbeosztasok.datum) AS honap,
                                            muszakbeosztasok.dolgozo_azonosito AS azonosito,
                                            munkasok.nev AS dolgozo_neve,
                                            munkasok.munkakori_beosztas AS beosztas,
                                            SUM(CASE WHEN muszakbeosztasok.muszakbeosztas IN (1, 2) THEN muszakbeosztasok.munkaoraszam ELSE 0 END) AS munkaorak_szama,
                                            SUM(CASE WHEN muszakbeosztasok.muszakbeosztas IN (3, 4) THEN 1 ELSE 0 END) AS pihenonapok_szama
                                        FROM muszakbeosztasok 
                                        JOIN munkasok ON muszakbeosztasok.dolgozo_azonosito = munkasok.dolgozo_azonosito
                                        GROUP BY ev, honap, munkasok.dolgozo_azonosito
                                        ORDER BY ev, honap, munkasok.dolgozo_azonosito;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function lekerdezes2(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT
                                            YEAR(m.datum) AS ev,
                                            MONTH(m.datum) AS honap,
                                            mu.dolgozo_azonosito AS azonosito,
                                            mu.nev AS dolgozo_neve,
                                            mu.munkakori_beosztas AS beosztas,
                                            SUM(CASE WHEN m.muszakbeosztas = 1 THEN 1 ELSE 0 END) AS nappalos,
                                            SUM(CASE WHEN m.muszakbeosztas = 2 THEN 1 ELSE 0 END) AS ejszakas,
                                            SUM(CASE WHEN m.muszakbeosztas = 3 THEN 1 ELSE 0 END) AS pihenonap,
                                            SUM(CASE WHEN m.muszakbeosztas = 4 THEN 1 ELSE 0 END) AS szabadsag
                                        FROM muszakbeosztasok m
                                        JOIN munkasok mu ON m.dolgozo_azonosito = mu.dolgozo_azonosito
                                        GROUP BY ev, honap, mu.dolgozo_azonosito
                                        ORDER BY ev, honap, mu.dolgozo_azonosito;");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function lekerdezes3(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT
                                            muszakbeosztasok.datum AS datum, 
                                            reszlegek.reszleg_neve AS reszleg, 
                                            muszakbeosztasok.muszakbeosztas AS beosztas, 
                                            COUNT(muszakbeosztasok.dolgozo_azonosito) AS dolgozo
                                            FROM muszakbeosztasok
                                            INNER JOIN reszlegek ON reszlegek.reszleg_azonosito = muszakbeosztasok.reszleg_azonosito
                                            GROUP BY datum, reszleg, beosztas");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function lekerdezes4(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT muszakbeosztasok.dolgozo_azonosito AS azonosito, munkasok.nev AS nev, munkasok.munkakori_beosztas AS beosztas FROM muszakbeosztasok
                                            INNER JOIN munkasok ON munkasok.dolgozo_azonosito = muszakbeosztasok.dolgozo_azonosito
                                            WHERE muszakbeosztasok.dolgozo_azonosito NOT IN (SELECT muszakbeosztasok.dolgozo_azonosito FROM muszakbeosztasok
                                            WHERE muszakbeosztasok.muszakbeosztas = 2 AND MONTH(muszakbeosztasok.datum) = MONTH(CURRENT_DATE())) 
                                            GROUP BY muszakbeosztasok.dolgozo_azonosito");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}
function keszitette(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT muszakbeszotas_id AS id, munkasok.nev AS nev, datum FROM keszit INNER JOIN munkasok ON munkasok.dolgozo_azonosito = keszit.felelos_operator");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}
function getBeosztasMaxId(){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT MAX(id) AS id FROM muszakbeosztasok");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}

function getUserIdByName($name){
    $connect = connectToDatabase();

    $result = mysqli_query( $connect,"SELECT dolgozo_azonosito AS azonosito FROM munkasok WHERE nev = '$name'");

    if ($result == false) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return $result;
}