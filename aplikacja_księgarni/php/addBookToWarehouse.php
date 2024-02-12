<?php
$error = false;
$msg = '';
if (!isset($_POST['bookToWarehouse']) || !isset($_POST['warehouseOfBook']) || !isset($_POST['amount'])) {
    $error = true;
    $msg = "Podaj wszystkie dane";
} else {
    $bookId = $_POST['bookToWarehouse'];
    $warehouseId = $_POST['warehouseOfBook'];
    $amount = $_POST['amount'];
    if ($bookId > 0 && $warehouseId > 0 && $amount > 0) {
        require_once "connect.php";
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if (!$conn) {
            $error = true;
            $msg = 'Błąd połączenia z bazą danych';
        } else {
            $query = "EXEC dodajKsiazkeDoMagazynu @ksiazka='$bookId', @magazyn='$warehouseId',@ilosc='$amount'";
            $result = sqlsrv_query($conn, $query);
            if ($result) {
                $msg = "Dodano do bazy";
            } else {
                $error = true;
                $msg = "Podane przypisanie już istnieje";
            }
            sqlsrv_close($conn);
        }
    }
}
$array = [$error, $msg];
echo json_encode($array);
