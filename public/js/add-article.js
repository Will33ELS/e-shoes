const articleType = document.getElementById("article_type");
const articleSizeDiv = document.getElementById("article_size_div");
const articleForm = document.getElementById("article_form");

articleType.addEventListener('change', (event) => {
    const result = event.target.value;
    if(result !== "chaussures" && result !== "tshirt"){
        resetSize();
    }else{
        resetSize();
        if(result === "chaussures"){
            createShoeSizeSelect();
        }else{
            createTshirtSizeSelect()
        }
    }
});

articleForm.addEventListener("submit", (event) => {
    if (!articleForm.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

    articleForm.classList.add('was-validated')
})

const createShoeSizeSelect = () => {
    createLabelSize("Pointure")
    const input = document.createElement("input");
    input.setAttribute("required", "true");
    input.setAttribute("min", "38");
    input.setAttribute("max", "46");
    input.classList.add("form-control");
    input.id = "article_size";
    input.name = "article_size";
    input.setAttribute("type", "number")
    input.placeholder = "Entre 38 et 46"

    articleSizeDiv.append(input)
}

const createTshirtSizeSelect = () => {
    createLabelSize("Taille")
    const select = document.createElement("select");
    select.setAttribute("required", "true");
    select.classList.add("form-control");
    select.id = "article_size";
    select.name = "article_size";
    const option = ["XS", "S", "M", "L", "XL"]
    option.forEach(o => {
        const optionElement = document.createElement("option");
        optionElement.textContent = o;
        optionElement.value = o;
        select.append(optionElement);
    })
    articleSizeDiv.append(select);
}

const createLabelSize = (content) => {
    const label = document.createElement("label");
    label.setAttribute("for", "article_size")
    label.textContent = content;
    articleSizeDiv.append(label);
}

const resetSize = () => {
    while (articleSizeDiv.firstChild) {
        articleSizeDiv.removeChild(articleSizeDiv.firstChild);
    }
}