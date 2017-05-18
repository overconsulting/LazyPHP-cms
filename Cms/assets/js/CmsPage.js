var CmsPage = function(title = '', active = 1, sections = []) {
	this.title = title;
	this.active = active;
	this.sections = sections
};

CmsPage.prototype.getItem = function(sectionIndex, rowIndex, colIndex) {
	if (sectionIndex != null) {
		if (rowIndex != null) {
			if (colIndex != null) {
				return this.sections[sectionIndex].rows[rowIndex].cols[colIndex];
			} else {
				return this.sections[sectionIndex].rows[rowIndex];
			}
		} else {
			return this.sections[sectionIndex];
		}
	} else {
		return null;
	}
}

CmsPage.prototype.attributesToHtml = function(attributes) {
	var html = "";
	var k = "";
	for (k in attributes) {
		html = html + " " + k + "=\"" + attributes[k] + "\"";
	}
	return html;
}

CmsPage.prototype.stylesToHtml = function(styles) {
	var html = "";
	if (styles.length > 0) {
		html = html + " style=\"";
		var k = "";
		for (k in styles) {
			" " + k + ": " + styles[k] + ";";
		}
		html = html + "\"";
	}
	return html;
}

CmsPage.prototype.addSection = function(position = null) {
	if (position == null) {
		position = this.sections.length;
	}
	this.sections.splice(position, 0 , {attributes: {}, styles: {}, rows: []});
	this.createHtml();
	var block = $("#cms_page_container .cms-page-section[data-section-index="+position+"]")[0];
	$(block).click();
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
	this.sections[sectionIndex].rows.splice(position, 0 , {attributes: {}, styles: {}, cols: []});
	this.createHtml();
	var block = $("#cms_page_container .cms-page-row[data-section-index="+sectionIndex+"][data-row-index="+position+"]")[0];
	$(block).click();
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
	this.sections[sectionIndex].rows[rowIndex].cols.splice(position, 0 , {attributes: {}, styles: {}, content: "", widgets: []});
	this.createHtml();
	var block = $("#cms_page_container .cms-page-col[data-section-index="+sectionIndex+"][data-row-index="+rowIndex+"][data-col-index="+position+"]")[0];
	$(block).click();
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

	for (s = 0; s < this.sections.length; s = s + 1) {
		html = html +
			_getAddSectionButton(s) +
			'<section class="cms-page-section" data-section-index="' + s + '"' +
				this.attributesToHtml(this.sections[s].attributes) +
				this.stylesToHtml(this.sections[s].styles) + '>' +
			_getDelSectionButton(s);

		for (r = 0; r < this.sections[s].rows.length; r = r + 1) {
			html = html +
				_getAddRowButton(s, r) +
				'<div class="cms-page-row" data-section-index="' + s + '" data-row-index="' + r + '"' +
					this.attributesToHtml(this.sections[s].rows[r].attributes) +
					this.stylesToHtml(this.sections[s].rows[r].styles) + '>' +
				_getDelRowButton(s, r);

			for (c = 0; c < this.sections[s].rows[r].cols.length; c = c + 1) {
				html = html +
					_getAddColButton(s, r, c) +
					'<div class="cms-page-col" data-section-index="' + s + '" data-row-index="' + r + '" data-col-index="' + c + '"' +
						this.attributesToHtml(this.sections[s].rows[r].cols[c].attributes)+
						this.stylesToHtml(this.sections[s].rows[r].cols[c].styles) + '>' +
					_getDelColButton(s, r, c);

				if (this.sections[s].rows[r].cols[c].content != null && this.sections[s].rows[r].cols[c].content != "") {
					html = html + this.sections[s].rows[r].cols[c].content;
				} else {
					html = html + "&nbsp;";
				}

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

		$(cmsPageContainer).find(".action").on("click", {page: this}, this.doActionEvent);

		$(cmsPageContainer).find(".cms-page-section, .cms-page-row, .cms-page-col").on("click", {page: this}, this.selectBlockEvent);

		$("#formProperties").find("input[type=text], textarea").on("change", {page: this}, this.propertyChangeEvent);

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

CmsPage.prototype.loadProperties = function(block) {
	var sectionIndex = block.hasAttribute("data-section-index") ? parseInt(block.getAttribute("data-section-index")) : null;
	var rowIndex = block.hasAttribute("data-row-index") ? parseInt(block.getAttribute("data-row-index")) : null;
	var colIndex = block.hasAttribute("data-col-index") ? parseInt(block.getAttribute("data-col-index")) : null;

	var blockName = document.getElementById("cms_page_block_name");	
	html = "Aucun block sélectioné";
	if (sectionIndex != null) {
		html = "Section : "+sectionIndex;
		if (rowIndex != null) {
			html = html + " / Ligne : " + rowIndex;
			if (colIndex != null) {
				html = html + " / Colonne : " + colIndex;
			}
		}
	}
	blockName.innerHTML = html;

	var item = this.getItem(sectionIndex, rowIndex, colIndex);
	var propertyType = null;
	var propertyName = null;
	if (item != null) {
		$("#formProperties").find("input[type=text], textarea").each(function(index, input) {
			propertyType = input.hasAttribute("data-property-type") ? input.getAttribute("data-property-type") : null;
			propertyName = input.hasAttribute("data-property-name") ? input.getAttribute("data-property-name") : null;
			if (propertyType != null && propertyName != null) {
				switch (propertyType) {
					case "attribute":
						input.value = item.attributes[propertyName] != null ? item.attributes[propertyName] : "";
						break;
					case "style":
						input.value = item.styles[propertyName] != null ? item.styles[propertyName] : "";
						break;
					case "content":
						if (colIndex != null) {
							input.innerHTML = item.content != "" ? item.content : "";
							$(input).parents(".form-group").show();
						} else {
							$(input).parents(".form-group").hide();
							input.innerHTML = "";
						}
						break;
				}
			}
		});
	}
}

CmsPage.prototype.selectBlockEvent = function(event) {
	var block = event.currentTarget;
	var cmsPageContainer = document.getElementById("cms_page_container");

	$(cmsPageContainer).find(".cms-page-section.selected, .cms-page-row.selected, .cms-page-col.selected").removeClass("selected");
	$(block).addClass("selected");

	event.data.page.loadProperties(block);

	event.stopPropagation();
}

CmsPage.prototype.propertyChangeEvent = function(event) {
	var block = $("#cms_page_container .selected")[0];

	if (block != null) {
		var sectionIndex = block.hasAttribute("data-section-index") ? parseInt(block.getAttribute("data-section-index")) : null;
		var rowIndex = block.hasAttribute("data-row-index") ? parseInt(block.getAttribute("data-row-index")) : null;
		var colIndex = block.hasAttribute("data-col-index") ? parseInt(block.getAttribute("data-col-index")) : null;

		var item = event.data.page.getItem(sectionIndex, rowIndex, colIndex);

		var input = event.currentTarget;
		var propertyType = input.hasAttribute("data-property-type") ? input.getAttribute("data-property-type") : null;
		var propertyName = input.hasAttribute("data-property-name") ? input.getAttribute("data-property-name") : null;

		switch (propertyType) {
			case "attribute":
				block.setAttribute(propertyName, input.value);
				item.attributes[propertyName] = input.value;
				break;

			case "style":
				$(block).css(propertyName, input.value);
				item.styles[propertyName] = input.value;
				break;

			case "content":
				block.innerHTML = input.value;
				item.content = input.value;
				break;
		}
	}
}

CmsPage.prototype.doActionEvent = function(event) {
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