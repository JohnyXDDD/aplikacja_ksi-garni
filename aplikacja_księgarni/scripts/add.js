const forms = document.querySelectorAll('form')
forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        document.getElementById('modal').style.display = "none"
    })
})

function createDetail() {
    const div = document.createElement('div')
    div.classList.add('detail')
    const input = document.createElement('input')
    input.classList.add('detail-book')
    input.placeholder = 'Wybierz książkę'
    input.setAttribute('list', "books-list")
    const price = document.createElement('input')
    price.type = 'number'
    price.classList.add("price")
    price.placeholder = "Podaj cenę"
    const number = document.createElement('input')
    number.type = "number"
    number.placeholder = "Podaj ilość"
    number.classList.add("quantity")
    const deleteBtn = document.createElement('button')
    deleteBtn.innerHTML = "Wycofaj pozycję"
    deleteBtn.classList.add("deleteBtn")
    deleteBtn.type = "button"
    deleteBtn.addEventListener('click', function () {
        deleteBtn.parentNode.nextSibling.remove()
        deleteBtn.parentNode.remove()
    })
    div.append(input, price, number, deleteBtn)
    return div
}
document.getElementById('add-new-detail').addEventListener('click', function (e) {
    const button = e.target
    const div = createDetail()
    div.classList.add('additionalElement')
    console.log(button, div)
    const hr = document.createElement('hr')
    hr.classList.add('additionalElement')
    button.parentNode.insertBefore(div, button)
    button.parentNode.insertBefore(hr, button)

})
document.getElementById('addNewAuthor').addEventListener('click', function (e) {
    const button = e.target
    const input = createAuthorInput()
    const hr = document.createElement('hr')
    const deleteBtn = document.createElement('button')
    deleteBtn.innerHTML = "Usuń autora"
    deleteBtn.type = "button"
    deleteBtn.addEventListener('click', function () {
        input.remove()
        hr.remove()
        deleteBtn.remove()
    })
    button.parentNode.insertBefore(input, button)
    button.parentNode.insertBefore(deleteBtn, button)
    button.parentNode.insertBefore(hr, button)
})

function createAuthorInput() {
    const input = document.createElement('input')
    input.placeholder = 'Podaj autora'
    input.setAttribute('list', "authors-list")
    input.classList.add("author")
    return input
}
function showMsg(msg) {
    const modal = document.getElementById('modal')
    modal.style.display = "none"
    modal.style.display = "flex"
    modal.querySelector("p").innerHTML = msg
    setTimeout(function () {
        modal.style.display = "none"
    }, 2500)
}
function getFormData(form) {
    const formData = new FormData(form)
    return formData
}
document.getElementById('addCategory').addEventListener('submit', function (e) {
    addCategory(e.target)
})

function addToDatabase(formData, url, form) {
    $.ajax({
        url,
        dataType: 'json',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            const error = response[0]
            const msg = response[1]
            if (!error) {
                form.reset()
                reloadDatalists()
                if (form.id = "addOrder") {
                    resetDetails()
                }
            }
            showMsg(msg)
        }
    })
}
function addCategory(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addCategory.php', form)
}
document.getElementById('addWarehouse').addEventListener('submit', function (e) {
    addWarehouse(e.target)
})
function addWarehouse(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addWarehouse.php', form)
}
document.getElementById('addAuthor').addEventListener('submit', function (e) {
    addAuthor(e.target)
})
function addAuthor(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addAuthor.php', form)
}
document.getElementById('addPublisher').addEventListener('submit', function (e) {
    addPublisher(e.target)
})
function addPublisher(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addPublisher.php', form)
}
document.getElementById('addClient').addEventListener('submit', function (e) {
    addClient(e.target)
})
function addClient(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addClient.php', form)
}
document.getElementById('addBook').addEventListener('submit', function (e) {
    addBook(e.target)
})
function addBook(form) {
    const formData = getFormData(form)
    const authorInputs = document.querySelectorAll('.author')
    const authorsArray = []
    authorInputs.forEach(el => authorsArray.push(Number(el.value)))
    let isCorrect = true
    authorsArray.includes(0) ? isCorrect = false : isCorrect = true
    if (isCorrect) {
        formData.append("authors", authorsArray)
        addToDatabase(formData, 'php/addBook.php', form)
    }
    else {
        showMsg("Podaj poprawne ID autorów")
        return false
    }
}
document.getElementById('addOrder').addEventListener('submit', function (e) {
    addOrder(e.target)
})
function addOrder(form) {
    const formData = getFormData(form)
    const details = document.querySelectorAll('.detail')
    const detailsArray = []
    let isCorrect = true
    details.forEach(detail => {
        console.log(detail)
        const detailData = {
            book: Number(detail.querySelector('.detail-book').value),
            price: Number(detail.querySelector('.price').value),
            quantity: Number(detail.querySelector('.quantity').value)
        }
        if (!detailData.book || !detailData.price || !detailData.quantity) {
            isCorrect = false
        }
        detailsArray.push(detailData)
    })
    if (!isCorrect) {
        showMsg("Uzupełnij wszystkie detale")
    }
    formData.append("details", JSON.stringify(detailsArray))
    console.log(Object.fromEntries(formData))
    addToDatabase(formData, 'php/addOrder.php', form)
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

function getClients() {
    $.ajax({
        url: "php/clientsList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'clients-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id_klienta']
                    option.innerHTML = element['Imię'] + ' ' + element['Nazwisko'] + ', ' + element['Adres']
                    datalist.appendChild(option)
                })
                document.getElementById('order-client').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getClients()

function getAuthors() {
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
}
getAuthors()


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

function getWarehouses() {
    $.ajax({
        url: "php/warehousesList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'warehouse-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id_magazynu']
                    option.innerHTML = element['miasto']
                    datalist.appendChild(option)
                })
                document.getElementById('warehouseOfBook').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getWarehouses()

document.getElementById('addBookToWarehouse').addEventListener('submit', function (e) {
    addBookToWarehouse(e.target)
})
function addBookToWarehouse(form) {
    const formData = getFormData(form)
    addToDatabase(formData, 'php/addBookToWarehouse.php', form)
}

function reloadDatalists() {
    const lists = document.querySelectorAll('datalist')
    lists.forEach(list => list.remove())
    getWarehouses()
    getCategories()
    getPublishers()
    getAuthors()
    getBooks()
    getClients()
}

function resetDetails() {
    const additionalElements = document.querySelectorAll('.additionalElement')
    additionalElements.forEach(el => el.remove())
}
