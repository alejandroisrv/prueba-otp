




let form = document.forms.namedItem("programadorForm")

form.addEventListener('submit', (e) => {
    e.preventDefault();

    let formData = new FormData(form)
    let request = new XMLHttpRequest();
    let output = document.getElementById("output")

    const failContent = (rs) => (`<div class='alert alert-danger'> 
                                ${rs.message}
                            </div>`);

    const successContent = (rs) => (`<div class='alert alert-success'> 
                                <p>${rs.message}.</p> 
                                Total de programadores registrados: ${rs.totalCount} 
                            </div>`)

    request.open("post", "/core/register.php");

    request.onload = (rs) => {

        output.style.display = "inline"

        let response = JSON.parse(rs.target.responseText);

        output.innerHTML = response.status ? successContent(response) : failContent(response)

        setTimeout(() => {
            output.style.display = "none"
        }, 5000);

    }

    request.send(formData)

})

