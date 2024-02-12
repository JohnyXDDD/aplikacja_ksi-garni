<?php
$error = false;
$msg = '';
$response = [];
if (isset($_POST['book']) && isset($_POST['price'])) {
    require_once "connect.php";
    $ksiazka = $_POST['book'];
    $cena = $_POST['price'];
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "EXEC zmienCene @ksiazka='$ksiazka',@cena='$cena'";
        $result = sqlsrv_query($conn, $query);
        if ($result) {
            $msg = 'Zaaktualizowano';
        } else {
            $msg = 'Błąd, nie zaktualizowano';
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg, $response];
echo json_encode($array);
