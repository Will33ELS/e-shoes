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
            const label = createLabelSize("Pointure")
            label.setAttribute("for", "article_size")
            articleSizeDiv.append(label);

            const input = createShoeSizeSelect();
            input.setAttribute("required", "true");
            input.id = "article_size";
            input.name = "article_size";
            articleSizeDiv.append(input);
        }else{
            const label = createLabelSize("Taille")
            label.setAttribute("for", "article_size")
            articleSizeDiv.append(label);

            const select = createTshirtSizeSelect()
            select.id = "article_size";
            select.name = "article_size";
            articleSizeDiv.append(select);
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

const resetSize = () => {
    while (articleSizeDiv.firstChild) {
        articleSizeDiv.removeChild(articleSizeDiv.firstChild);
    }
}