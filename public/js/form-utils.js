const createShoeSizeSelect = () => {
    const input = document.createElement("input");
    input.setAttribute("min", "38");
    input.setAttribute("max", "46");
    input.classList.add("form-control");
    input.setAttribute("type", "number")
    input.placeholder = "Entre 38 et 46"

    return input;
}

const createTshirtSizeSelect = () => {
    const select = document.createElement("select");
    select.setAttribute("required", "true");
    select.classList.add("form-control");
    const option = ["XS", "S", "M", "L", "XL"]
    option.forEach(o => {
        const optionElement = document.createElement("option");
        optionElement.textContent = o;
        optionElement.value = o;
        select.append(optionElement);
    })
    return select;
}

const createLabelSize = (content) => {
    const label = document.createElement("label");
    label.textContent = content;
    return label;
}

const selectItemByValue = (elmnt, value) => {
    console.log(elmnt)
    for(var i=0; i < elmnt.options.length; i++) {
        if(elmnt.options[i].value === value) {
            elmnt.selectedIndex = i;
            break;
        }
    }
}