// Checkbox text color change

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("input[type='checkbox']").forEach((checkbox) => {

        if (checkbox.checked) {
            check(checkbox);
        }

        checkbox.addEventListener("change", (e) => {
            check(checkbox);
        })
    })

    const toggleFilters = document.getElementById("toggle-filters");
    const filters = document.getElementById("filters");

    toggleFilters.addEventListener("click", function () {
        filters.classList.toggle("active");
        if (filters.classList.contains("active")) {
            toggleFilters.textContent = "Hide Filters";
        } else {
            toggleFilters.textContent = "Show Filters";
        }
    })

    const toggleMap = document.getElementById("toggle-map");
    const sidebar = document.querySelector('.sidebar');

    toggleMap.addEventListener("click", function () {
        sidebar.classList.toggle("active");
    })
})

function check(input) {
    let label = input.parentElement;
    if (input.checked) {
        label.classList.add("checked");
    } else {
        label.classList.remove("checked");
    }
}
/*
// Mobile version show/hide filters
document.addEventListener("DOMContentLoaded", function () {


});
*/
