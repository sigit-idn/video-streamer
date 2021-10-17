document.querySelector('#tags').addEventListener('input', ({target}) => {
	target.previousElementSibling.innerHTML = "Tags ";
    target.value = target.value.replace(/\s*,\s*/g, ",")
	target.previousElementSibling.innerHTML +=
	target.value.split(",").map(tag => `
		<span class="badge bg-info text-light">${tag.trim()}</span>
		`
	).join("\n")}
	)

const thumbnailPreview = document.querySelector("#thumbnailPreview");
document.querySelector("#thumbnail").addEventListener("change", ({target}) => {
    const reader = new FileReader();
    const [file] = target.files;
    const removeBtn = target.nextElementSibling;
    reader.readAsDataURL(file)


    if (file) {
        thumbnailPreview.parentElement.classList.remove('d-none')
        removeBtn.classList.remove("d-none")
    }

    reader.onload = () => thumbnailPreview.src = reader.result
})

function removeThumbnail() {
    document.querySelector("#thumbnail").value = "";
    thumbnailPreview.onclick = (event) => event.preventDefault();
    thumbnailPreview.style.cursor = "default";
    thumbnailPreview.src = "";
    document.querySelector("[name=thumbnailPreview]").value = "";
    thumbnailPreview.parentElement.classList.add("d-none");
}

if (document.querySelector("div.step-2 input.is-invalid")) {
    switchStep()
}
