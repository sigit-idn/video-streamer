if (document.querySelector("#uploadCsv")) {
    document.querySelector("#uploadCsv").addEventListener("submit", (event) => {
        event.preventDefault();
        const [file] = document.querySelector("#csvFile").files;
        if (file.type != "text/csv") {
            return (document.querySelector("#uploadCsv").innerHTML +=
                "<p>Please upload csv file.</p>");
        }
        const reader = new FileReader();
        reader.readAsText(file);

        reader.onload = () => {
            const { result } = reader;

            const cols = result.match(/^\d.+/gm);

            cols.forEach((col, i) => {
                const rows = col
                    .replace(/(?<=".*),(?=.*")/g, "^@^")
                    .split(",")
                    .map((cell) =>
                        cell.replace(/\^@\^/g, ",").replace(/"/g, "")
                    );

                if (/^\d/.test(rows[0])) {
                    document.querySelector("#csvTable tbody").innerHTML += `
                    <tr>
                    <td>${i + 1}</td>
                    <td><input required pattern="[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}" class="form-control" name="start_pos[${i}]" maxlength="8" value="${
                        rows[0]
                    }"></td>
                    <td><input required pattern="[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}" class="form-control" name="end_pos[${i}]" maxlength="8" value="${
                        rows[1]
                    }"></td>
                    <td><textarea required name="chapter_name[${i}]" class="form-control">${
                        rows[2]
                    }</textarea></td>
                    <td><input pattern="http.+\\..+" class="form-control" placeholder="Insert URL" name="url[${i}]" value="${
                        rows[3]
                    }"></td>
                    <td>
                    <a class="btn btn-outline-primary" onclick="insertRow(this)"> <i class="bi bi-plus"></i> </a>
                    <a class="btn btn-outline-danger ms-1" onclick="removeRow(this)"> <i class="bi bi-trash"></i> </a>
                    </td>
                    </tr>
                    `;
                }
            });
            fixOrder();
        };
    });
}

function fixOrder() {
    document
        .querySelectorAll("[name^=start_pos]")
        .forEach((startPos, i) => (startPos.name = `start_pos[${i}]`));
    document
        .querySelectorAll("[name^=end_pos]")
        .forEach((end_pos, i) => (end_pos.name = `end_pos[${i}]`));
    document
        .querySelectorAll("[name^=chapter_name]")
        .forEach(
            (chapter_name, i) => (chapter_name.name = `chapter_name[${i}]`)
        );
    document
        .querySelectorAll("[name^=url]")
        .forEach((url, i) => (url.name = `url[${i}]`));
    document
        .querySelectorAll("#csvTable tbody td:first-child")
        .forEach((iteration, i) => (iteration.innerHTML = `${i + 1}`));
}

function insertRow(element) {
    const row = document.createElement("tr");
    row.innerHTML = `
	<td></td>
	<td><input required pattern="[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}" class="form-control" name="start_pos" maxlength="8" value="0:00:00"></td>
	<td><input required pattern="[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}" class="form-control" name="end_pos" maxlength="8" value="0:00:00"></td>
	<td><textarea required name="chapter_name" class="form-control"></textarea></td>
	<td><input pattern="http.+\\..+" class="form-control" placeholder="Insert URL" name="url"></td>
	<td>
	<a class="btn btn-outline-primary" onclick="insertRow(this)"> <i class="bi bi-plus"></i> </a>
	<a class="btn btn-outline-danger ms-1" onclick="removeRow(this)"> <i class="bi bi-trash"></i> </a>
	</td>`;

    if (element) {
        document
            .querySelector("#csvTable tbody")
            .insertBefore(
                row,
                element.parentElement.parentElement.nextElementSibling
            );
    } else {
        document.querySelector("#csvTable tbody").appendChild(row);
    }
    fixOrder();
}

function removeRow(element) {
    if (confirm("Are sure to delete?")) {
        element.parentElement.parentElement.remove();
        fixOrder();
    }
}

document.querySelector("#stepSwitcher")?.addEventListener("click", (event) => {
    event.preventDefault();
    if (!document.querySelector("#csvTable :invalid")) {
        switchStep();
    }

    document.querySelectorAll("#csvTable :invalid").forEach((input) => {
        input.scrollIntoView({ behavior: "smooth" });
        input.addEventListener("input", () =>
            input.classList.remove("is-invalid")
        );
        input.classList.add("is-invalid");
        const messageElement = document.createElement("p");
        messageElement.className = "invalid-feedback";
        messageElement.innerHTML = input.validationMessage;
        if (!/invalid-feedback/.test(input.parentElement.innerHTML)) {
            input.parentElement.appendChild(messageElement);
        }
    });
});

let isContinue = true;
function switchStep() {
    isContinue = !isContinue;
    document.querySelector("#stepSwitcher").innerHTML = isContinue
        ? "Continue"
        : "Back";
    document
        .querySelectorAll("[class*=step-]")
        .forEach((step) => step.classList.toggle("d-none"));
    document
        .querySelectorAll("[data-required]")
        .forEach((requiredField) =>
            requiredField.setAttribute("required", true)
        );
}
