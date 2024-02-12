<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikacja</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="scripts/edit.js"></script>
</head>

<body>
    <header>
        <h1>Aplikacja do zarządzania bazą księgarni</h1>
        <nav>
            <ul class="submenu">
                <li><a href="index.php">Przeglądaj</a></li>
                <li><a href="add.php">Dodaj</a></li>
                <li><a href="edit.php">Edycja</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="form-box">
            <h2>Oznacz zamówienie jako dostarczone</h2>
            <form class="small-form" id="setOrderAsDelivered">
                <input list="undeliveredOrders-list" id="order" name="order" placeholder="Wybierz zamówienie" required />
                <button>Dostarczono</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Zmień cene książki</h2>
            <form class="small-form" id="editPrice">
                <input list="books-list" id="book" name="book" placeholder="Wybierz książkę" required />
                <input min="1" type="number" name="price" id="price" placeholder="Cena" required>
                <button>Edytuj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Zmień stan w magazynie</h2>
            <form class="small-form" id="deliveryToWarehouse">
                <input list="books-list" id="bookToWarehouse" name="bookToWarehouse" placeholder="Wybierz książkę" required />
                <input list="warehouse-list" id="warehouseOfBook" name="warehouseOfBook" placeholder="Wybierz magazyn" required />
                <input type="number" name="amount" id="amount" placeholder="Ilość" required>
                <button>Edytuj</button>
            </form>
        </div>
    </main>
    <div id="modal" class="modal">
        <p>Tu będzie wiadomość</p>
    </div>
</body>

</html>