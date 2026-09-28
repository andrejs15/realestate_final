// AI-assisted migration: original project JavaScript preserved and guarded for Vaííčko layouts.

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("input[type='checkbox']").forEach((checkbox) => {
        if (checkbox.checked) {
            check(checkbox);
        }

        checkbox.addEventListener("change", () => {
            check(checkbox);
        });
    });

    const toggleFilters = document.getElementById("toggle-filters");
    const filters = document.getElementById("filters");

    if (toggleFilters && filters) {
        toggleFilters.addEventListener("click", () => {
            filters.classList.toggle("active");
            toggleFilters.textContent = filters.classList.contains("active")
                ? "Hide Filters"
                : "Show Filters";
        });
    }

    const toggleMap = document.getElementById("toggle-map");
    const sidebar = document.querySelector(".sidebar");

    if (toggleMap && sidebar) {
        toggleMap.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    }

    const description = document.getElementById("description");
    const descriptionCounter = document.getElementById("description-counter");

    if (description && descriptionCounter) {
        const maxLength = description.maxLength;

        const updateDescriptionCounter = () => {
            descriptionCounter.textContent = maxLength - description.value.length;
        };

        updateDescriptionCounter();
        description.addEventListener("input", updateDescriptionCounter);
    }

    const imageInput = document.getElementById("images");
    const imagePreview = document.getElementById("image-preview");

    if (imageInput && imagePreview) {
        imageInput.addEventListener("change", () => {
            imagePreview.innerHTML = "";

            Array.from(imageInput.files).forEach((file) => {
                const image = document.createElement("img");
                image.src = URL.createObjectURL(file);
                image.classList.add("h-28", "w-full", "rounded-lg", "object-cover");
                imagePreview.appendChild(image);
            });

            if (imageInput.files.length > 0) {
                imagePreview.classList.remove("invisible");
                imagePreview.classList.add("mb-3", "p-2");
            } else {
                imagePreview.classList.add("invisible");
            }
        });
    }
});

function check(input) {
    const label = input.parentElement;
    if (!label) {
        return;
    }

    if (input.checked) {
        label.classList.add("checked");
    } else {
        label.classList.remove("checked");
    }
}
