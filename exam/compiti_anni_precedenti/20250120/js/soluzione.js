document.addEventListener("DOMContentLoaded", function(){

    let submit = document.getElementsByTagName('button')[0];

    submit.addEventListener("click", function(){
        event.preventDefault();

        let nome = document.getElementById("name");
        let email = document.getElementById("email");
        let eta = document.getElementById("age");
        let genere = document.getElementById("gender");
        let msg = document.getElementById("message");

        nome.setAttribute("minlength", "3");
        nome.setAttribute("required", "");
        
        email.setAttribute("required", "");

        eta.setAttribute("min", "18");
        eta.setAttribute("max", "100");

        genere.setAttribute("required", "");
        
        msg.setAttribute("maxlength", "300");

        let res = [];
        res.push("name: ", nome.value);
        res.push("email: ", email.value);

        let ol = document.createElement('ol');

        let li1 = document.createElement('li');
        li1.innerHTML = "name: " + nome.value;
        let li2 = document.createElement('li');
        li2.innerHTML = "email: " + email.value;

        ol.appendChild(li1);
        ol.appendChild(li2);

        let div = document.getElementById('resultContainer');
        div.appendChild(ol);

        console.log(res)
    });

});