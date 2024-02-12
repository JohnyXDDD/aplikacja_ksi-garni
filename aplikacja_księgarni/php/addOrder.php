<?php
$error = false;
$msg = '';
$response = [];
if (isset($_POST['order-client']) && isset($_POST['details'])) {
    $client = $_POST['order-client'];
    $details = json_decode($_POST['details']);
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        try {
            sqlsrv_begin_transaction($conn);
            $sql1 = "EXEC dodajZamowienie @klient='$client'";
            $query1 = sqlsrv_query($conn, $sql1);
            if ($query1) {
                $sql2 = "SELECT @@IDENTITY";
                $query2 = sqlsrv_query($conn, $sql2);
                if ($query2) {
                    $row = sqlsrv_fetch_array($query2);
                    $id = $row[0];
                    foreach ($details as $detail) {
                        $book = $detail->book;
                        $price = $detail->price;
                        $quantity = $detail->quantity;
                        $sql = "EXEC dodajPodzamowienie @zamowienie='$id',@ksiazka='$book',@ilosc='$quantity',@cena='$price'";
                        $result = sqlsrv_query($conn, $sql);
                        if (!$result) {
                            $error = true;
                        }
                    }
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if (!$error) {
                sqlsrv_commit($conn);
                $msg = "Transakcja zakończona sukcesem.";
            } else {
                sqlsrv_rollback($conn);
                $msg = "Błąd podczas operacji w transakcji.";
            }
        } catch (Exception $e) {
            sqlsrv_rollback($conn);
            $msg = "Transakcja zakończona niepowodzeniem";
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg, $response];
echo json_encode($array);
