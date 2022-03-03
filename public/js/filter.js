const filterSelect = document.getElementById("filter-select");
const filterSize = document.getElementById("filter-size");
const filterButton = document.getElementById("filter-button")

filterSelect.addEventListener("change", (event) => {
    const result = event.target.value;
    resetFilter();
    checkSelect(result);
});

const onLoad = () => {
    var result = filterSelect.value;
    checkSelect(result)
}

const checkSelect = (result) => {
    if(result === "chaussures"){
        filterButton.classList.remove("d-none");
        const input = createShoeSizeSelect();
        input.id = "filter_size_input";
        input.name = "filter_size";
        filterSize.append(input);
    }else if(result === "tshirt"){
        filterButton.classList.remove("d-none");
        const select = createTshirtSizeSelect();
        select.id = "filter_size_input";
        select.name = "filter_size";
        filterSize.append(select);
    }else{
        filterButton.classList.add("d-none");
    }
}

const resetFilter = () => {
    while (filterSize.firstChild) {
        filterSize.removeChild(filterSize.firstChild);
    }
}

onLoad();