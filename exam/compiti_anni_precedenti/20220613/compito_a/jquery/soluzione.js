document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("body > main > div > form");
    const spans = document.querySelectorAll("body > main > div > span");
    const valuta = document.querySelector("body > main > div > button:nth-child(3)");
    const nuovaPartita = document.querySelector("body > main > div > button:nth-child(1)");
    const container = document.querySelector("body > main > div");

    form.style.visibility = "hidden";

    for (let span of spans) {
        span.style.visibility = "hidden";
    }

    valuta.style.visibility = "hidden";

    nuovaPartita.addEventListener("click", async () => {
        const res = await fetch('http://0.0.0.0:8000/php/');
        const json = await res.json();
        const init = json["init"];
        console.log(init);

        // create table
        const table = document.querySelector("body > main > table");
        for (let i = 0; i < 9; i++) {
            const tr = document.createElement("tr");
            for (let j = 0; j < 9; j++) {
                const td = document.createElement("td");
                td.id = `cella_${i+1}_${j+1}`;
                td.textContent = init[i * 9 + j];
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }

        container.append(table);

        // display form
        form.style.visibility = "visible";
        const inputs = form.getElementsByTagName("input");
        for (let input of inputs) {
            if (input.type != "submit") {
                input.value = null;
            }
        }

        valuta.style.visibility = "visible";
    });

    form.addEventListener("submit", function (event) {
        event.stopPropagation();
        event.preventDefault();

        let row = form.riga.value;
        let col = form.colonna.value;
        const value = form.valore.value;

        console.log(row, col, value);

        for (let v of [row, col, value]) {
            if (v > 9 || v < 1) {
                alert("Valori non validi");
                return;
            }
        }

        const cell = document.getElementById(`cella_${row}_${col}`);
        cell.textContent = value;
    })

    valuta.addEventListener("click", async function() {
        let sol = "";
        for (let i = 0; i < 9; i++) {
            for (let j = 0; j < 9; j++) {
                const td = document.getElementById(`cella_${i+1}_${j+1}`);
                sol += td.textContent;
            }
        }

        console.log(sol);
        const formData = new FormData();
        formData.append('sol', sol);

        const resp = await fetch('http://0.0.0.0:8000/php/', {
            method: "POST",
            body: formData
        });

        const json = await resp.json();
        const correct = json["valid"];

        if(correct) {
            document.getElementsByClassName("win")[0].style.visibility = "visible";
            document.getElementById("lose").style.visibility = "hidden";
        } else {
            document.getElementsByClassName("win")[0].style.visibility = "hidden";
            document.getElementById("lose").style.visibility = "visible";
        }
    })
});