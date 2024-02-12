function showMsg(msg) {
    const modal = document.getElementById('modal')
    modal.style.display = "none"
    modal.style.display = "flex"
    modal.querySelector("p").innerHTML = msg
    setTimeout(function () {
        modal.style.display = "none"
    }, 2500)
}

function getOrders() {
    $.ajax({
        url: "php/ordersList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'orders-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id']
                    option.innerHTML = element['klient'] + ' ' + element['data']
                    datalist.appendChild(option)
                })
                document.getElementById('order_id').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getOrders()

document.querySelectorAll('.sample-query').forEach(button => {
    button.addEventListener('click', function () {
        query(button.value)
    })
})
function query(value) {
    console.log(value)
    $.ajax({
        url: "php/query.php",
        type: "POST",
        dataType: "json",
        data: {
            query: value
        },
        success: function (response) {
            if (!response[0]) {
                createTable(response[2])
            }
            else {
                showMsg(response[1])
            }
        }
    })
}


function createTable(data) {
    const headers = data[0]
    const table = document.createElement('table')
    const tr = document.createElement('tr')
    tr.classList.add("first-row")
    for (key in headers) {
        const th = document.createElement('th')
        th.innerHTML = key
        tr.appendChild(th)
    }
    table.append(tr)
    data.forEach(record => {
        const tr = document.createElement('tr')
        for (key in record) {
            const td = document.createElement('td')
            td.innerHTML = record[key]
            tr.appendChild(td)
        }
        table.append(tr)
    })
    const h2 = document.createElement('h2')
    h2.innerHTML = "Wynik zapytania:"
    const resultSection = document.getElementById('result')
    resultSection.innerHTML = ''
    resultSection.append(h2)
    resultSection.append(table)
    resultSection.scrollIntoView()
}

document.getElementById('authorData').addEventListener('click', function () {
    const id = document.getElementById('author').value
    document.getElementById('author').value = null
    if (id > 0) {
        getData(id, 'php/getAuthorDetails.php')
    }
})

document.getElementById('publisherData').addEventListener('click', function () {
    const id = document.getElementById('publisher').value
    document.getElementById('publisher').value = null
    if (id > 0) {
        getData(id, 'php/getPublisherDetails.php')
    }
})

document.getElementById('orderData').addEventListener('click', function () {
    const id = document.getElementById('order_id').value
    document.getElementById('order_id').value = null
    if (id > 0) {
        getData(id, 'php/getOrderDetails.php')
    }
})
document.getElementById('categoryData').addEventListener('click', function () {
    const id = document.getElementById('category').value
    document.getElementById('category').value = null
    if (id > 0) {
        getData(id, 'php/getCategoryDetails.php')
    }
})
document.getElementById('bookData').addEventListener('click', function () {
    const id = document.getElementById('book').value
    document.getElementById('book').value = null
    if (id > 0) {
        getData(id, 'php/getBookDetails.php')
    }
})

function getData(id, url) {
    $.ajax({
        url,
        type: "POST",
        dataType: "json",
        data: {
            id
        },
        success: function (response) {
            if (!response[0]) {
                createTable(response[2])
            }
            else {
                showMsg(response[1])
            }
        }
    })
}

(function getAuthors() {
    $.ajax({
        url: "php/authorsList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'authors-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id_autora']
                    option.innerHTML = element['imie'] + ' ' + element['nazwisko']
                    datalist.appendChild(option)
                })
                document.getElementById('author').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
})()


function getPublishers() {
    $.ajax({
        url: "php/publishersList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'publishers-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['ID wydawcy']
                    option.innerHTML = element['nazwa']
                    datalist.appendChild(option)
                })
                document.getElementById('publisher').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getPublishers()

function getCategories() {
    $.ajax({
        url: "php/categoriesList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'categories-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id']
                    option.innerHTML = element['nazwa']
                    datalist.appendChild(option)
                })
                document.getElementById('category').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getCategories()

function showMsg(msg) {
    const modal = document.getElementById('modal')
    modal.style.display = "none"
    modal.style.display = "flex"
    modal.querySelector("p").innerHTML = msg
    setTimeout(function () {
        modal.style.display = "none"
    }, 2500)
}

function getBooks() {
    $.ajax({
        url: "php/booksList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'books-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id']
                    let price = element['price']
                    price = Number(price).toFixed(2)
                    option.innerHTML = element['title'] + ' ' + price + ' zł'
                    datalist.appendChild(option)
                })
                document.getElementById('book').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getBooks()