document.addEventListener("DOMContentLoaded", function(){

    let main = document.getElementsByTagName('main')[0];
    let table = document.createElement('table');
    let tr = document.createElement('tr');
    for(let i = 0; i < 9; i++){
        let td = document.createElement('td');
        td.innerHTML = i + 1;
        td.addEventListener(){

        }
        tr.appendChild(td);
    }
    table.appendChild(tr);
    main.appendChild(table);


    let tabellone = document.getElementsByClassName('tabellone')[0];
    let trs = tabellone.getElementsByTagName('tr');
    for (let i = 0; i < trs.length; i++) {
        let tds = trs.getElementsByTagName('td');
        for (let j = 0; j < tds.length; j++) {
            tds[j].addEventListener('click', function(){
                if(tds[j].style.backgroundColor != 'rgb(127,127,127)'){
                    for (let index = 0; index < array.length; index++) {
                        const element = array[index];
                        let tds = tds[j].style.backgroundColor = rgb('255','255','255');
                    }
                }

            });
            
        }
        
    }
});