<?php
$error = false;
$msg = '';
$response = [];
if (isset($_POST['bookToWarehouse']) && isset($_POST['warehouseOfBook']) && $_POST['amount']) {
    require_once "connect.php";
    $ksiazka = $_POST['bookToWarehouse'];
    $magazyn = $_POST['warehouseOfBook'];
    $ilosc = $_POST['amount'];
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "EXEC dostawaDoMagazynu @ksiazka='$ksiazka',@magazyn='$magazyn',@ilosc='$ilosc'";
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
