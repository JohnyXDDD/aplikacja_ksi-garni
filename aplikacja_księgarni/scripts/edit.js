const forms = document.querySelectorAll('form')
forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        document.getElementById('modal').style.display = "none"
    })
})
function queryToDatabase(formData, url, form) {
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
            }
            showMsg(msg)
        }
    })
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

function getFormData(form) {
    const formData = new FormData(form)
    return formData
}
document.getElementById('deliveryToWarehouse').addEventListener('submit', function (e) {
    deliveryToWarehouse(e.target)
})
function deliveryToWarehouse(form) {
    const formData = getFormData(form)
    queryToDatabase(formData, 'php/deliveryToWarehouse.php', form)
}
document.getElementById('editPrice').addEventListener('submit', function (e) {
    editPrice(e.target)
})
function editPrice(form) {
    const formData = getFormData(form)
    queryToDatabase(formData, 'php/editPrice.php', form)
}
function reloadDatalists() {
    const lists = document.querySelectorAll('datalist')
    lists.forEach(list => list.remove())
    getWarehouses()
    getBooks()
    getUndeliveredOrders()
}
function getUndeliveredOrders() {
    $.ajax({
        url: "php/undeliveredOrdersList.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (!response[0]) {
                const datalist = document.createElement('datalist')
                datalist.id = 'undeliveredOrders-list'
                const data = response[2]
                data.forEach(element => {
                    const option = document.createElement('option')
                    option.value = element['id_zamówienia']
                    const data = element['data_zamówienia'].date
                    const newDate = data.toString().split(' ')[0]
                    option.innerHTML = element['klient'] + ', ' + newDate
                    datalist.appendChild(option)
                })
                document.getElementById('order').after(datalist)
            }
            else {
                showMsg(response[1])
            }
        }
    })
}
getUndeliveredOrders()
document.getElementById('setOrderAsDelivered').addEventListener('submit', function (e) {
    setOrderAsDelivered(e.target)
})
function setOrderAsDelivered(form) {
    const formData = getFormData(form)
    queryToDatabase(formData, 'php/setOrderAsDelivered.php', form)
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