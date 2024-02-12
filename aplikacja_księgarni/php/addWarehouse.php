<?php
$error = false;
$msg = '';
if (!isset($_POST['warehouse'])) {
    $error = true;
    $msg = "Podaj miasto magazynu";
} else {
    $warehouse = $_POST['warehouse'];
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "EXEC dodajMagazyn @miasto='$warehouse';";
        $result = sqlsrv_query($conn, $query);
        $affected_rows = sqlsrv_rows_affected($result);
        if ($affected_rows == 1) {
            $msg = "Dodano do bazy";
        } else {
            $error = true;
            $msg = "Podaj miasto magazynu";
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg];
echo json_encode($array);
