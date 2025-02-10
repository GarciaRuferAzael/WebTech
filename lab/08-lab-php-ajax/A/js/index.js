function generaArticoli(articoli){
    let result = "";

    for(let i=0; i < articoli.length; i++){
        let articolo = `
        <article>
            <header>
                <div>
                    <img src="${articoli[i]["imgarticolo"]}" alt="" />
                </div>
                <h2>${articoli[i]["titoloarticolo"]}</h2>
                <p>${articoli[i]["nome"]} - ${articoli[i]["dataarticolo"]}</p>
            </header>
            <section>
                <p>${articoli[i]["anteprimaarticolo"]}</p>
            </section>
            <footer>
                <a href="articolo.php?id=${articoli[i]["idarticolo"]}">Leggi tutto</a>
            </footer>
        </article>
        `;
        result += articolo;
    }
    return result;
}

async function getArticleData() {
    const url = 'api-articolo.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const articoli = generaArticoli(json);
        const main = document.querySelector("main");
        main.innerHTML = articoli;
    } catch (error) {
        console.log(error.message);
    }
}

function stringaToID(stringa){
    return stringa.toLowerCase().replace(/[^a-zA-Z]/g, "");
}

function generaTabella(autori){
    
    let table = `
    <section>
        <h2>Autori del Blog</h2>
        <table>
            <tr>
                <th id="autore">Autore</th><th id="email">Email</th><th id="argomenti">Argomenti</th>
            </tr>`;
    
    for(let i = 0; i < autori.length; i++){
        let row_id = stringaToID(autori[i]["nome"]);
        table +=  `
        <tr>
            <th id="${row_id}">${autori[i]["nome"]}</th> 
            <td headers="${row_id} email">${autori[i]["username"]}</td>
            <td headers="${row_id} argomenti">${autori[i]["argomenti"]}</td>
        </tr>`
    }

    table +=  `
        </table>
    </section>`;

    return table;
}

async function getContactData() {
    const url = 'api-contatti.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const tabella = generaTabella(json);
        const main = document.querySelector("main");
        main.innerHTML = tabella;
    } catch (error) {
        console.log(error.message);
    }
}



function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2>Login</h2>
        <p></p>
        <ul>
            <li>
                <label for="username">Username:</label><input type="text" id="username" name="username" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Invia" />
            </li>
        </ul>
    </form>`;
    return form;
}


function generaGestisciArticoli(articoli) {
    let result = `
    <section>
        <h2>Articoli</h2>
        <a href="gestisci-articoli.php?action=1">Inserisci Articolo</a>
        <table>
            <tr>
                <th>Titolo</th><th>Immagine</th><th>Azione</th>
            </tr> `

    for (let i = 0; i < articoli.length; i++) {
        result += `
            <tr>
                <td>${articoli[i]["titoloarticolo"]}</td>
                <td><img src="${articoli[i]["imgarticolo"]}" alt="" /></td>
                <td>
                    <a href="gestisci-articoli.php?action=2&id=${articoli[i]["idarticolo"]}">Modifica</a>
                    <a href="gestisci-articoli.php?action=3&id=${articoli[i]["idarticolo"]}">Cancella</a>
                </td>
            </tr>
        `;
    }
    result += `
        </table>
    </section>`;

    return result;
}

async function getLoginData() {
    const url = 'api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        if(json["logineseguito"]){
            visualizzaArticoli(json["articoliautore"]);
        }
        else{
            visualizzaLoginForm();
        }


    } catch (error) {
        console.log(error.message);
    }
}


function visualizzaArticoli(listaArticoli) {
    let articoli = generaGestisciArticoli(listaArticoli);
    main.innerHTML = articoli;
}

function visualizzaLoginForm() {
    // Utente NON loggato
    let form = generaLoginForm();
    main.innerHTML = form;
    // Gestisco tentativo di login
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#username").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });
}

async function login(username, password) {
    const url = 'api-login.php';
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    try {

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if(json["logineseguito"]){
            visualizzaArticoli(json["articoliautore"]);
        }
        else{
            document.querySelector("form > p").innerText = json["errorelogin"];
        }


    } catch (error) {
        console.log(error.message);
    }
}


const main = document.querySelector("main");
document.querySelector("nav ul li:first-child").addEventListener("click", function(e){
    e.preventDefault();
    getArticleData();
});

document.querySelector("nav ul li:nth-child(3)").addEventListener("click", function(e){
    e.preventDefault();
    getContactData();
});
document.querySelector("nav ul li:last-child").addEventListener("click", function(e){
    e.preventDefault();
    getLoginData();
});

getArticleData();
