const copyText = (msg) => {
	let field = $(".copy-text");
	field.select();
	field[0].setSelectionRange(0, 99999);
	navigator.clipboard.writeText(field.val());
	alert(msg + '\n' + field.val());
}

const initSummernote = () => {
	$('#summernote').summernote({
		height: 300,
		minHeight: 200,
		maxHeight: 400,
		lang: 'id-ID',
		dialogsFade: true,
		disableDragAndDrop: true,
		toolbar: [
			['misc', ['undo', 'redo']],
			['color', ['color']],
			['fontsize', ['fontname', 'fontsize']],
			['style', ['bold', 'italic', 'underline', 'strikethrough']],
			['para', ['ul', 'ol']],
			['paragraph'],
			['insert', ['link', 'table', 'hr']],
			['view', ['fullscreen', 'help']]
		]
	});
}

const initTooltip = () => {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
}


const initDatatables = () => {
	$('#dataTable').DataTable();
}

$(document).ready(function () {
	initSummernote();
	initDatatables();
	initTooltip();
});
