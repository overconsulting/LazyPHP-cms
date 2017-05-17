var CmsPage = function(title = '', active = 1, sections = []) {
	this.title = title;
	this.active = active;
	this.sections = sections
};

CmsPage.prototype.addSection = function(position = null) {
	if (position == null) {
		position = this.sections.length;
	}
	this.sections.splice(position, 0 , {style: [], rows: []});
	this.createHtml();
}

CmsPage.prototype.delSection = function(sectionIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length) {
		this.sections.splice(sectionIndex, 1);
	}
	this.createHtml();
}

CmsPage.prototype.addRow = function(sectionIndex, position = null) {
	if (position == null) {
		position = this.sections[sectionIndex].rows.length;
	}
	this.sections[sectionIndex].rows.splice(position, 0 , {style: [], cols: []});
	this.createHtml();
}

CmsPage.prototype.delRow = function(sectionIndex, rowIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length &&
		rowIndex >= 0 && rowIndex < this.sections[sectionIndex].rows.length) {
		this.sections[sectionIndex].rows.splice(rowIndex, 1);
	}
	this.createHtml();
}

CmsPage.prototype.addCol = function(sectionIndex, rowIndex, position = null) {
	if (position == null) {
		position = this.sections[sectionIndex].rows[rowIndex].cols.length;
	}
	this.sections[sectionIndex].rows[rowIndex].cols.splice(position, 0 , {style: [], widgets: []});
	this.createHtml();
}

CmsPage.prototype.delCol = function(sectionIndex, rowIndex, colIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length &&
		rowIndex >= 0 && rowIndex < this.sections[sectionIndex].rows.length &&
		colIndex >= 0 && colIndex < this.sections[sectionIndex].rows[rowIndex].cols.length) {
		this.sections[sectionIndex].rows[rowIndex].cols.splice(colIndex, 1);
	}
	this.createHtml();
}

CmsPage.prototype.createHtml = function() {
	var html = "";
	var s = 0;
	var r = 0;
	var c = 0;

	// var defaultColSize = 12;
	// var colSize = defaultColSize;

	for (s = 0; s < this.sections.length; s = s + 1) {
		html = html + _getAddSectionButton(s) + '<section class="cms-page-section">' + _getDelSectionButton(s);

		for (r = 0; r < this.sections[s].rows.length; r = r + 1) {
			html = html + _getAddRowButton(s, r) + '<div class="cms-page-row">' + _getDelRowButton(s, r);

			// defaultColSize = _getBootstrapColSize(this.sections[s].rows[r].cols.length);

			for (c = 0; c < this.sections[s].rows[r].cols.length; c = c + 1) {				
				// colSize = this.sections[s].rows[r].cols[c].colSize != null ? this.sections[s].rows[r].cols[c].colSize : defaultColSize;

				html = html + _getAddColButton(s, r, c) + '<div class="cms-page-col">' + _getDelColButton(s, r, c);
				html = html + s+", "+r+", "+c;
				html = html + "</div>"
			}
			html = html + _getAddColButton(s, r, this.sections[s].rows[r].cols.length);

			html = html + "</div>";
		}
		html = html + _getAddRowButton(s, this.sections[s].rows.length);

		html = html + "</section>";
	}
	html = html + _getAddSectionButton(this.sections.length);

	var cmsPageContainer = document.getElementById("cms_page_container");
	if (cmsPageContainer != null) {
		cmsPageContainer.innerHTML = html;

		$(cmsPageContainer).find(".action").on("click", {page: this}, this.doAction);

		$(cmsPageContainer).find(".cms-page-section, .cms-page-row, .cms-page-col").on("click", {page: this}, this.selectElement);

		var cols = null;
		var buttons = null;
		var rowWidth = 0;
		var paddings = 0;
		var margins = 0;
		var width = 0;
		$(".cms-page-row").each(function(rowIndex, row) {
			cols = $(row).find(".cms-page-col");
			buttons = $(row).find("button.action-add-col");
			if (cols.length > 0) {
				width = Math.floor($(row).innerWidth());
				width = width - parseInt($(row).css('padding-left')) - parseInt($(row).css('padding-right'));
				width = width - ((parseInt($(cols).css('margin-left')) + parseInt($(cols).css('margin-right'))) * cols.length);
				width = width - ($(buttons).outerWidth() * (cols.length + 1));
				width = Math.floor(width / cols.length);
				cols.outerWidth(width);
			}
		});
	}

	return html;
}

CmsPage.prototype.selectElement = function(event) {
	var element = event.currentTarget;
	var cmsPageContainer = document.getElementById("cms_page_container");

	console.log(element);
	$(cmsPageContainer).find(".cms-page-section.selected, .cms-page-row.selected, .cms-page-col.selected").removeClass("selected");
	$(element).addClass("selected");

	event.stopPropagation();
}

CmsPage.prototype.doAction = function(event) {
	var button = event.currentTarget;
	var action = button.getAttribute("data-action");
	var position = button.hasAttribute("data-position") ? parseInt(button.getAttribute("data-position")) : null;
	var sectionIndex = button.hasAttribute("data-section-index") ? parseInt(button.getAttribute("data-section-index")) : null;
	var rowIndex = button.hasAttribute("data-row-index") ? parseInt(button.getAttribute("data-row-index")) : null;
	var colIndex = button.hasAttribute("data-col-index") ? parseInt(button.getAttribute("data-col-index")) : null;

	switch (action) {
		case "addSection":
			event.data.page.addSection(position);
			break;

		case "delSection":
			event.data.page.delSection(sectionIndex);
			break;

		case "addRow":
			event.data.page.addRow(sectionIndex, position);
			break;

		case "delRow":
			event.data.page.delRow(sectionIndex, rowIndex);
			break;

		case "addCol":
			event.data.page.addCol(sectionIndex, rowIndex, position);
			break;

		case "delCol":
			event.data.page.delCol(sectionIndex, rowIndex, colIndex);
			break;
	}

	event.preventDefault();
}

function _getAddSectionButton(position)
{
	html = 
		'<button type="button" class="action action-add-section btn btn-success btn-xs" title="Ajouter une section" data-action="addSection" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelSectionButton(sectionIndex)
{
	html = 
		'<button type="button" class="action action-del-section btn btn-danger btn-xs" title="Supprimer la section" data-action="delSection" data-section-index="'+sectionIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

function _getAddRowButton(sectionIndex, position)
{
	html = 
		'<button type="button" class="action action-add-row btn btn-success btn-xs" title="Ajouter une ligne" data-action="addRow" data-section-index="'+sectionIndex+'" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelRowButton(sectionIndex, rowIndex)
{
	html = 
		'<button type="button" class="action action-del-row btn btn-danger btn-xs" title="Supprimer la ligne" data-action="delRow" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

function _getAddColButton(sectionIndex, rowIndex, position)
{
	html = 
		'<button type="button" class="action action-add-col btn btn-success btn-xs" title="Ajouter une colonne" data-action="addCol" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelColButton(sectionIndex, rowIndex, colIndex)
{
	html = 
		'<button type="button" class="action action-del-col btn btn-danger btn-xs" title="Supprimer la colonne" data-action="delCol" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'" data-col-index="'+colIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

// function _getBootstrapColSize(colCount)
// {
// 	var colSize = 12;
// 	switch (colCount) {
// 		case 1:
// 			colSize = 12;
// 			break;
// 		case 2:
// 			colSize = 6;
// 			break;
// 		case 3:
// 			colSize = 4;
// 			break;
// 		case 4:
// 			colSize = 3;
// 			break;
// 		case 5:
// 		case 6:
// 			colSize = 2;
// 			break;
// 		case 7:
// 		case 8:
// 		case 9:
// 		case 10:
// 			colSize = 1;
// 			break;
// 		default:
// 			colSize = 12;
// 			break;
// 	}
// 	return colSize;
// }

var page = null;

$(document).ready(function() {
	//console.log(contentJson);
	//contentJson = JSON.parse(contentJson);
	page = new CmsPage(contentJson.title, contentJson.active, contentJson.sections);
	page.createHtml();

	$("#formPage").on("submit", formPageSubmit);
});

function formPageSubmit(event) {
	var formPage = $("#formPage")[0];
	formPage.elements["content"].value = JSON.stringify(page);
}