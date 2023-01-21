function sendRequest(resolve, body = null, method = 'POST', url = 'php/handlers.php' ) {
    const xhr = new XMLHttpRequest()
    xhr.open(method, url)

    xhr.responseType = 'json';
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    //key1=value1&key2=value2 ...

    xhr.onload = () => {
        console.log(xhr.response)
        resolve(xhr.response)       
    }

    xhr.onerror = () => {
        console.log(xhr.response)
    }

    xhr.send(body)  
}

function sendFormRequest() {
    const element = document.getElementById('crud')
    const formData = new FormData(element)

    var text = ''
    for(const pair of formData.entries()) {
        text += `${pair[0]}=${pair[1]}&`
    }
    sendRequest(buildListPage, text)   
}

/////////////////////////////////////////////////////////////
function buildListPage(data) {
    var table = document.getElementById('content')

    var html = `<table class = "table">
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>`
    
    var number = 1
    for(var i = 0; i < data.length; i++) {
        var row = 
            `<tr>
                <td>${number++}</td>
                <td>${data[i].name}</td>
                <td>${data[i].price}</td>
                <td>${data[i].desc}</td>
                <td><img src='img/edit.png'  onClick='sendRequest(updateRecordPage, "command=RECORD&id=${data[i].id}")'></td>
                <td><img src='img/delete.png' onClick='sendRequest(buildListPage, "command=DELETE&id=${data[i].id}")'></td>
            </tr>`
        html += row
    }

    html += '</tbody></table>'
    html += `<button onclick="createRecordPage()" class = "button" >Добавить</button>`
    table.innerHTML = html
}
/////////////////////////////////////////////////////////////////
function createRecordPage() {
    var form = document.getElementById('content')

    const html =
    `<form id="crud"> 
        <p><input type="text" name="name" placeholder="Наименование"/></p>
        <p><input type="text" name="price" placeholder="Цена"/></p>
        <p><input type="text" name="desc" placeholder="Описание"/></p>
        <p><input type="button" value="Добавить" onClick="sendFormRequest()"/></p>
        <input type="hidden" name="command" value="CREATE"/>
        <input type="hidden" name="id" value="0"/>
    </form>`

    form.innerHTML = html
}

///////////////////////////////////////////////////////////////////
function updateRecordPage(data) {
    var form = document.getElementById('content')

    const html =
    `<form id="crud">
        <p><input type="text" name="name" value="${data.name}" placeholder="Наименование"/></p>
        <p><input type="text" name="price" value="${data.price}" placeholder="Цена"/></p>
        <p><input type="text" name="desc" value="${data.desc}" placeholder="Описание"/></p>
        <p><input type="button" value="Изменить" onClick="sendFormRequest()"/></p>
        <input type="hidden" name="command" value="UPDATE"/>
        <input type="hidden" name="id" value="${data.id}"/>
    </form>`

    form.innerHTML = html
}
