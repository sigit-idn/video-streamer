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
			const cols = result.match(/\d.+/gm);

			console.log(document.querySelector("#csvFile").files);
			cols.forEach((col, i) => {
					const rows = col.split(",");
					if (/^\d/.test(rows[0])) {
							document.querySelector("#csvTable tbody").innerHTML += `
			<tr>
			<td><input class="form-control" name="start_pos[${i}]" maxlength="8" value="${rows[0]}"></td>
			<td><input class="form-control" name="end_pos[${i}]" maxlength="8" value="${rows[1]}"></td>
			<td><textarea name="chapter_name[${i}]" class="form-control">${rows[2]}</textarea></td>
			<td><input class="form-control" name="url[${i}]" value="${rows[3]}"></td>
			</tr>
			`;
					}
			});
	};
});
