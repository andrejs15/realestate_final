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

    const description = document.getElementById("description");
    const descriptionCounter = document.getElementById("description-counter");

    if (description && descriptionCounter) {
        const maxLength = description.maxLength;
        descriptionCounter.textContent = maxLength - description.value.length;

        description.addEventListener("input", (e) => {
            descriptionCounter.textContent = maxLength - description.value.length;
        })
    }

    const imageInput = document.getElementById("images");
    const imagePreview = document.getElementById("image-preview");

    if (imageInput && imagePreview) {
        imageInput.addEventListener("change", (e) => {
            imagePreview.innerHTML = "";
            Array.from(imageInput.files).forEach((file) => {
                const image = document.createElement("img");
                image.src = URL.createObjectURL(file);
                image.classList.add("h-28", "w-full", "rounded-lg", "object-cover");
                imagePreview.appendChild(image);
                imagePreview.classList.remove("invisible");
                imagePreview.classList.add("mb-3", "p-2");
            })

        })
    }
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
