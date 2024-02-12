<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikacja</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="script.js"></script>
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
        <div class="query-containter">
            <h2>Podstawowe zapytania</h2>
            <div class="query">
                <button class="sample-query" value="1">Ilość ksiązek autorów</button>
            </div>
            <div class="query">
                <button class="sample-query" value="2">Ilość książek z kategorii</button>
            </div>
            <div class="query">
                <button class="sample-query" value="3">Ilość zamówień klientów</button>
            </div>
            <div class="query">
                <button class="sample-query" value="4">Zamówienia i ich wartość</button>
            </div>
            <div class="query">
                <button class="sample-query" value="5">Łączny stan książi w magazynach</button>
            </div>
            <h2>Zapytania z parametrami</h2>
            <div class="query">
                <button id="authorData">Szczegóły autora</button>
                <input list="authors-list" id="author" name="author" placeholder="Podaj autora" />

            </div>
            <div class="query">
                <button id="publisherData">Szczegóły wydawca</button>
                <input list="publishers-list" id="publisher" name="publisher" placeholder="Podaj wydawce" />
            </div>
            <div class="query">
                <button id="orderData">Szczegóły zamówienia</button>
                <input list="orders-list" name="order_id" id="order_id" placeholder="Podaj id zamówienia">
            </div>
            <div class="query">
                <button id="categoryData">Szczegóły kategorii</button>
                <input list="categories-list" id="category" name="category" placeholder="Podaj kategorie" />
            </div>
            <div class="query">
                <button id="bookData">Szczegóły książki</button>
                <input list="books-list" id="book" name="book" placeholder="Podaj książkę" />
            </div>
        </div>
    </main>
    <section id="result">
    </section>
    <div id="modal" class="modal">
        <p>Tu będzie wiadomość</p>
    </div>
</body>

</html>