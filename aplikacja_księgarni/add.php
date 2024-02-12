<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikacja</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="scripts/add.js"></script>
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
            <h2>Dodaj kategorie</h2>
            <form class="small-form" id="addCategory">
                <input type="text" name="category" id="category" placeholder="Podaj kategorię" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj magazyn</h2>
            <form class="small-form" id="addWarehouse">
                <input type="text" name="warehouse" id="warehouse" placeholder="Podaj miejscowość magazynu" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj autora</h2>
            <form class="small-form" id="addAuthor">
                <input type="text" name="name" id="name" placeholder="Imię" required>
                <input type="text" name="surname" id="surname" placeholder="Nazwisko" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj wydawcę</h2>
            <form class="small-form" id="addPublisher">
                <input type="text" name="publisher" id="publisher" placeholder="Podaj nazwę wydawcy" required>
                <input type="text" name="publisherLocation" id="publisherLocation" placeholder="Podaj miasto" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj klienta</h2>
            <form class="small-form" id="addClient">
                <input type="text" name="client-name" id="client-name" placeholder="Imię" required>
                <input type="text" name="client-surname" id="client-surname" placeholder="Nazwisko" required>
                <input type="text" name="client-address" id="client-address" placeholder="Adres" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj książkę w magazynie</h2>
            <form class="small-form" id="addBookToWarehouse">
                <input list="books-list" id="bookToWarehouse" name="bookToWarehouse" placeholder="Wybierz książkę" required />
                <input list="warehouse-list" id="warehouseOfBook" name="warehouseOfBook" placeholder="Wybierz magazyn" required />
                <input min="0" type="number" name="amount" id="amount" value="0" placeholder="Stan początkowy" required>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj książkę</h2>
            <form class="big-form" id="addBook">
                <input list="publishers-list" id="publisher" name="publisher" placeholder="Podaj wydawce" required />
                <input type="text" name="title" id="title" placeholder="Podaj tytuł" required>
                <input type="number" name="price" id="price" step="0.01" placeholder="Podaj cenę" required>
                <input type="date" name="date" id="date" required>
                <div class="authors">
                    <h4>Autorzy:</h4>
                    <input class="author" type="text" list="authors-list" placeholder="Podaj autora" id="author" />
                    <hr>
                    <button type="button" id="addNewAuthor">Dodaj kolejnego autora</button>
                    <hr>
                </div>
                <button>Dodaj</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Dodaj zamówienie</h2>
            <form class="big-form" id="addOrder">
                <input list="clients-list" id="order-client" name="order-client" placeholder="Wybierz klienta" required />
                <h4>Detale</h4>
                <div class="order-details">
                    <div class="detail">
                        <input class="detail-book" list="books-list" id="book" placeholder="Wybierz książkę" required />
                        <input type="number" class="price" step="0.01" placeholder="Podaj cenę" required>
                        <input type="number" class="quantity" step="1" placeholder="Podaj ilość" required>
                    </div>
                    <hr>
                    <button type="button" id="add-new-detail">Dodaj kolejną pozycję</button>
                    <hr>
                </div>
                <button>Dodaj zamówienie</button>

            </form>
        </div>
    </main>
    <div id="modal" class="modal">
        <p>Tu będzie wiadomość</p>
    </div>
</body>

</html>