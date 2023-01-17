let table = null;
let lineNumber = 0;

function addLine() {
    let tab = table.insertRow();
    tab.insertCell().append(lineNumber);
    tab.insertCell().append("Предложите стажировку");
    lineNumber++;
}

function createTable() {
    if (table != null) {
        alert("Таблица уже была создана");
    } else {
        table = document.createElement("TABLE")
        let addButton = document.getElementById('addButton');
        addButton.removeAttribute('disabled')
        let deleteButton = document.getElementById('deleteButton');
        deleteButton.removeAttribute('disabled')

        table.innerHTML = "<table>\n" +
            "<tr>\n" +
            "      <th>\n" +
            lineNumber +
            "      </td>\n" +
            "     </td>\n" +
            "      <td>\n" +
            "      </td>\n" +
            "</tr>"
        "</table>";

        table.setAttribute('id', 'TABLE')
        document.body.append(table);
        lineNumber++;
    }
}

function deleteLine() {
    let num = document.getElementById('num').value;

    if (num === "") {
        alert("Не должно быть пусто");
        return null;
    }

    try {
        table.deleteRow(num);
    } catch (DOMexception) {
        alert("Строка не найдена");
    }

}