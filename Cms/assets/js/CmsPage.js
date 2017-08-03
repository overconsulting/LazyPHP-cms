var CmsPage = function(title = '', active = 1, sections = []) {
	this.title = title;
	this.active = active;
	this.sections = sections;
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

CmsPage.prototype.getBlock = function(sectionIndex, rowIndex, colIndex) {
	if (sectionIndex != null) {
		if (rowIndex != null) {
			if (colIndex != null) {
				return $(".cms-page-col[data-section-index="+sectionIndex+"][data-row-index="+rowIndex+"][data-col-index="+colIndex+"]")[0];
			} else {
				return $(".cms-page-row[data-section-index="+sectionIndex+"][data-row-index="+rowIndex+"]")[0];
			}
		} else {
			return $(".cms-page-section[data-section-index="+sectionIndex+"]")[0];
		}
	} else {
		return null;
	}
}

CmsPage.prototype.attributesToHtml = function(attributes) {
	var html = "";
	if (attributes != null && attributes.length > 0) {
		var k = "";
		for (k in attributes) {
			html = html + " " + k + "=\"" + attributes[k] + "\"";
		}
	}
	return html;
}

CmsPage.prototype.stylesToHtml = function(styles) {
	var html = "";
	if (true || styles != null && styles.length > 0) {
		html = html + " style=\"";
		var k = "";
		for (k in styles) {
			html = html + " " + k + ": " + styles[k] + ";";
		}
		html = html + "\"";
	}
	return html;
}

CmsPage.prototype.addSection = function(position = null) {
	if (position == null) {
		position = this.sections.length;
	}
	this.sections.splice(position, 0 , {blockType: "section", fullwidth: true, attributes: {}, styles: {}, rows: []});
	this.createHtml();
	// var block = $("#cms_page_container .cms-page-section[data-section-index="+position+"]")[0];
	// $(block).click();
}

CmsPage.prototype.delSection = function(sectionIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length) {
		this.sections.splice(sectionIndex, 1);
	}
	this.createHtml();
	// this.selectBlockEvent(null);
}

CmsPage.prototype.addRow = function(sectionIndex, position = null) {
	if (position == null) {
		position = this.sections[sectionIndex].rows.length;
	}
	this.sections[sectionIndex].rows.splice(position, 0 , {blockType: "row", attributes: {}, styles: {}, cols: []});
	this.createHtml();
	// var block = $("#cms_page_container .cms-page-row[data-section-index="+sectionIndex+"][data-row-index="+position+"]")[0];
	// $(block).click();
}

CmsPage.prototype.delRow = function(sectionIndex, rowIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length &&
		rowIndex >= 0 && rowIndex < this.sections[sectionIndex].rows.length) {
		this.sections[sectionIndex].rows.splice(rowIndex, 1);
	}
	this.createHtml();
	// this.selectBlockEvent(null);
}

CmsPage.prototype.addCol = function(sectionIndex, rowIndex, position = null) {
	if (position == null) {
		position = this.sections[sectionIndex].rows[rowIndex].cols.length;
	}
	this.sections[sectionIndex].rows[rowIndex].cols.splice(position, 0 , {blockType: "col", attributes: {}, styles: {}, content: "", widget: null});
	this.createHtml();
	// var block = $("#cms_page_container .cms-page-col[data-section-index="+sectionIndex+"][data-row-index="+rowIndex+"][data-col-index="+position+"]")[0];
	// $(block).click();
}

CmsPage.prototype.delCol = function(sectionIndex, rowIndex, colIndex) {
	if (sectionIndex >= 0 && sectionIndex < this.sections.length &&
		rowIndex >= 0 && rowIndex < this.sections[sectionIndex].rows.length &&
		colIndex >= 0 && colIndex < this.sections[sectionIndex].rows[rowIndex].cols.length) {
		this.sections[sectionIndex].rows[rowIndex].cols.splice(colIndex, 1);
	}
	this.createHtml();
	// this.selectBlockEvent(null);
}

CmsPage.prototype.createHtml = function() {
	// console.log("createHtml");
	var html = "";
	var s = 0;
	var r = 0;
	var c = 0;

	for (s = 0; s < this.sections.length; s = s + 1) {
		this.sections[s].blockType = "section";

		html = html +
			_getAddSectionButton(s) +
			'<section class="cms-page-section" data-block-type="section" data-section-index="' + s + '"' + ' data-default-class="cms-page-section"' +
				this.attributesToHtml(this.sections[s].attributes) +
				this.stylesToHtml(this.sections[s].styles) + '>' +
			_getDelSectionButton(s);

		for (r = 0; r < this.sections[s].rows.length; r = r + 1) {
			this.sections[s].rows[r].blockType = "row";

			html = html +
				_getAddRowButton(s, r) +
				'<div class="cms-page-row" data-block-type="row" data-section-index="' + s + '" data-row-index="' + r + '"' + ' data-default-class="cms-page-row"' +
					this.attributesToHtml(this.sections[s].rows[r].attributes) +
					this.stylesToHtml(this.sections[s].rows[r].styles) + '>' +
				_getDelRowButton(s, r);

			for (c = 0; c < this.sections[s].rows[r].cols.length; c = c + 1) {
				this.sections[s].rows[r].cols[c].blockType = "row";

				html = html +
					_getAddColButton(s, r, c) +
					'<div class="cms-page-col" data-block-type="col" data-section-index="' + s + '" data-row-index="' + r + '" data-col-index="' + c + '"' + ' data-default-class="cms-page-col"' +
						this.attributesToHtml(this.sections[s].rows[r].cols[c].attributes)+
						this.stylesToHtml(this.sections[s].rows[r].cols[c].styles) + '>' +
					_getDelColButton(s, r, c) +
					'<div class="cms-page-col-content">';

				if (this.sections[s].rows[r].cols[c].content != null && this.sections[s].rows[r].cols[c].content != "") {
					html = html + decodeURIComponent(this.sections[s].rows[r].cols[c].content);
				} else {
					html = html + "&nbsp;";
				}

				html = html + "</div></div>"
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
		$("#cms_page_block_properties_container").find(".action").on("click", {page: this}, this.doActionEvent);

		$(".action-del-section, .action-del-row, .action-del-col").on("mouseenter", {page: this}, this.doDelButtonMouseenterEvent);
		$(".action-del-section, .action-del-row, .action-del-col").on("mouseleave", {page: this}, this.doDelButtonMouseleaveEvent);

		$(".action-add-section, .action-add-row, .action-add-col").on("mouseenter", {page: this}, this.doAddButtonMouseenterEvent);
		$(".action-add-section, .action-add-row, .action-add-col").on("mouseleave", {page: this}, this.doAddButtonMouseleaveEvent);

		$(cmsPageContainer).find(".cms-page-section, .cms-page-row, .cms-page-col").on("click", {page: this}, this.selectBlockEvent);

		$("#formProperties").find("input[type=text], select, textarea").on("change", {page: this}, this.propertyChangeEvent);

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
				width = width - ($(buttons).outerWidth() * (cols.length + 2));
				width = Math.floor(width / cols.length);
				cols.outerWidth(width);
			}
		});
	}

	this.selectBlockEvent(null);
	$("#delete_mask").hide();
	$("#insert_mask").hide();

	return html;
}

CmsPage.prototype.loadProperties = function(block) {
	// console.log("loadProperties", block);

	var sectionIndex = block.hasAttribute("data-section-index") ? parseInt(block.getAttribute("data-section-index")) : null;
	var rowIndex = block.hasAttribute("data-row-index") ? parseInt(block.getAttribute("data-row-index")) : null;
	var colIndex = block.hasAttribute("data-col-index") ? parseInt(block.getAttribute("data-col-index")) : null;
	var blockType = block.hasAttribute("data-block-type") ? block.getAttribute("data-block-type") : null;

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
	// console.log(item);
	var propertyType = null;
	var propertyName = null;
	if (item != null) {
		$("#formProperties").find("input[type=text], select, textarea").each(function(index, input) {
			propertyType = input.hasAttribute("data-property-type") ? input.getAttribute("data-property-type") : null;
			propertyName = input.hasAttribute("data-property-name") ? input.getAttribute("data-property-name") : null;

			// console.log(propertyType, propertyName);
			if (propertyType != null) {
				switch (propertyType) {					
					case "attribute":
						if (propertyName != null) {
							input.value = item.attributes[propertyName] != null ? item.attributes[propertyName] : "";
						}
						break;

					case "style":
						if (propertyName != null) {
							input.value = item.styles[propertyName] != null ? item.styles[propertyName] : "";
						}
						break;

					case "content":
						if (blockType == "col") {
							input.value = item.content != "" ? decodeURIComponent(item.content) : "";
							$(input).parents(".panel").show();
						} else {
							input.value = "";
							$(input).parents(".panel").hide();
						}
						break;

					case "fullwidth":
						if (blockType == "section") {
							input.selectedIndex = item.fullwidth ? 0 : 1;
							$(input).parents(".form-group").show();
						} else {
							input.value = "";
							$(input).parents(".form-group").hide();
						}
						break;
				}
			}
		});
	}
}

CmsPage.prototype.selectBlockEvent = function(event) {
	// console.log("selectBlockEvent", event != null ? event.currentTarget : null);
	if (event == null) {
		$("#cms_page_block_properties").hide();
		// console.log("hide");
	} else {
		var block = event.currentTarget;
		var cmsPageContainer = document.getElementById("cms_page_container");

		$(cmsPageContainer).find(".cms-page-section.selected, .cms-page-row.selected, .cms-page-col.selected").removeClass("selected");
		$(block).addClass("selected");

		event.data.page.loadProperties(block);

		$("#cms_page_block_properties").show();
		// console.log("show");

		event.stopPropagation();
		event.preventDefault();
	}
}

CmsPage.prototype.propertyChangeEvent = function(event) {
	// console.log("propertyChangeEvent", event.currentTarget);

	var block = $("#cms_page_container .selected")[0];

	if (block != null) {
		var sectionIndex = block.hasAttribute("data-section-index") ? parseInt(block.getAttribute("data-section-index")) : null;
		var rowIndex = block.hasAttribute("data-row-index") ? parseInt(block.getAttribute("data-row-index")) : null;
		var colIndex = block.hasAttribute("data-col-index") ? parseInt(block.getAttribute("data-col-index")) : null;
		var defaultClass = block.hasAttribute("data-default-class") ? block.getAttribute("data-default-class") : null;

		var item = event.data.page.getItem(sectionIndex, rowIndex, colIndex);

		var input = event.currentTarget;
		var propertyType = input.hasAttribute("data-property-type") ? input.getAttribute("data-property-type") : null;
		var propertyName = input.hasAttribute("data-property-name") ? input.getAttribute("data-property-name") : null;

		// console.log(propertyType, propertyName);

		if (propertyType != null) {
			var inputValue = "";

			switch (propertyType) {
				case "attribute":
					inputValue = input.value.trim();
					if (propertyName != null) {
						if (propertyName == 'class') {
							block.className = defaultClass + " " + inputValue;
						} else {
							block.setAttribute(propertyName, inputValue);
						}
						item.attributes[propertyName] = inputValue;
					}
					break;

				case "style":
					inputValue = input.value.trim();
					if (propertyName != null) {
						$(block).css(propertyName, inputValue);
						item.styles[propertyName] = inputValue;
					}
					break;

				case "content":
					inputValue = input.value.trim();
					$(block).find(".cms-page-col-content")[0].innerHTML = inputValue;
					item.content = encodeURIComponent(inputValue);
					break;

				case "fullwidth":
					if (item.blockType == "section") {
						inputValue = input.options[input.selectedIndex].value;
						item.fullwidth = inputValue == "1";
					}
					break;
			}
		}
	}
}

CmsPage.prototype.colContentFocusEvent = function(event) {
	var textarea = event.currentTarget;
	// $(textarea).parents(".form-group").css("position", "absolute");
	// $(textarea).parents(".form-group").css("width", "100%");
}

CmsPage.prototype.colContentBlurEvent = function(event) {
	var textarea = event.currentTarget;
	// $(textarea).parents(".form-group").css("position", "static");
	// $(textarea).parents(".form-group").css("width", "auto");
}

CmsPage.prototype.doActionEvent = function(event) {
	// console.log("doActionEvent", event.currentTarget.getAttribute("data-action"));

	var button = event.currentTarget;
	var action = button.getAttribute("data-action");
	var position = button.hasAttribute("data-position") ? parseInt(button.getAttribute("data-position")) : null;
	var sectionIndex = button.hasAttribute("data-section-index") ? parseInt(button.getAttribute("data-section-index")) : null;
	var rowIndex = button.hasAttribute("data-row-index") ? parseInt(button.getAttribute("data-row-index")) : null;
	var colIndex = button.hasAttribute("data-col-index") ? parseInt(button.getAttribute("data-col-index")) : null;
	var page = event.data.page;
	var item = page.getItem(sectionIndex, rowIndex, colIndex);


	switch (action) {
		case "addSection":
			page.addSection(position);
			break;

		case "delSection":
			page.delSection(sectionIndex);
			break;

		case "addRow":
			page.addRow(sectionIndex, position);
			break;

		case "delRow":
			page.delRow(sectionIndex, rowIndex);
			break;

		case "addCol":
			page.addCol(sectionIndex, rowIndex, position);
			break;

		case "delCol":
			page.delCol(sectionIndex, rowIndex, colIndex);
			break;

		case "selectWidget":
			$(button).removeClass("btn-default").addClass("btn-warning selected");
			$("#cms_page_widget_select button[data-action=selectWidget]").not(button).removeClass("btn-warning selected").addClass("btn-default");
			$(".cms-page-widget-params").hide().removeClass("active");
			$("#cms_page_widget_select button[data-action=insertWidget]").addClass("disabled");

			var widgetType = button.hasAttribute("data-widget-type") ? button.getAttribute("data-widget-type") : null;
			if (widgetType != null) {
				$("#cms_page_widget_params_" + widgetType).show().addClass("active");
				$("#cms_page_widget_select button[data-action=insertWidget]").removeClass("disabled");
			}
			break;

		case "insertWidget":
			var selectedWidgetButton = $("#cms_page_widget_select button[data-action=selectWidget].selected")[0];
			if (selectedWidgetButton != null) {
				var widgetType = selectedWidgetButton.hasAttribute("data-widget-type") ? selectedWidgetButton.getAttribute("data-widget-type") : null;
				if (widgetType != null) {
					var widgetHtml = "";
					switch (widgetType) {
						case "media":
							widgetHtml = widgetHtml + '{% image src="' + $("#widget_selected_media_url").val() + '" %}';
							break;

						default:
							widgetHtml = widgetHtml + '{% widget type="' + widgetType + '"';
							$("#cms_page_widget_params_" + widgetType).find("input, select").each(function(index, input) {
								widgetHtml = widgetHtml + " " + input.name + '="' + input.value + '"';
							});
							widgetHtml = widgetHtml + " %}";
							break;
					}

					var editor = tinymce.get("cms_page_editor_content");
					if (editor != null) {
						editor.setContent(widgetHtml);
					} else {
						var content = $("textarea[name=content]")[0];
						var contentValue = content.value;
						// content.value = contentValue.substring(0, content.selectionStart) + widgetHtml + contentValue.substr(content.selectionStart);
						content.value = widgetHtml;
						$(content).trigger("change", {page: page});
					}
				}
			} else  {
				alert("Sélectionnez d'abord le type de widget à insérer");
			}
			break;

		case "contentImage":
			var content = $("textarea[name=content]")[0];
			var contentValue = content.value;

			content.value = 
				contentValue.substring(0, content.selectionStart) +
				"<em>" + contentValue.substring(content.selectionStart, content.selectionEnd) + "</em>" +
				 contentValue.substr(content.selectionEnd);

			$(content).trigger("change", {page: page});
			break;

		case "contentMaximize":
			params = {
				postData: null,
				id: "cms_page_content_dialog",
				title: "Modifier le contenu de la colonne",
				url: "",
				actions: {
					load: page.contentDialogLoadEvent,
					close: page.contentDialogCancelEvent,
					cancel: page.contentDialogCancelEvent,
					valid: page.contentDialogValidEvent
				}
			};

			var lazyDialog = new LazyDialog();
			lazyDialog.open(params);
			break;
	}

	event.stopPropagation();
	event.preventDefault();
}

CmsPage.prototype.contentMediaValidEvent = function() {
	var imageHtml = '{% image src="" %}';

	var editor = tinymce.get("cms_page_editor_content");
	if (editor != null) {
		editor.insertContent(imageHtml);
	} else {
		var content = $("textarea[name=content]")[0];
		var contentValue = content.value;
		content.value = contentValue.substring(0, content.selectionStart) + imageHtml + contentValue.substr(content.selectionStart);
		$(content).trigger("change", {page: this});
	}

	return true;
}

CmsPage.prototype.contentDialogLoadEvent = function() {
	var editorContainer = $("#cms_page_content_dialog .lazy-dialog-body")[0];
	editorContainer.innerHTML = 
		'<div id="cms_page_editor container-fluid">' +
			'<div class="row">' +
				// '<div class="col-md-8">' +
				// '<textarea id="cms_page_editor_content"></textarea>' +
				// '</div>' +
				// '<div id="cms_page_editor_widgets" class="col-md-4">' +
				// 	'<h3>Widgets</h3>'+
				// '</div>' +
				'<div id="cms_page_content_container" class="col-md-12">' +
				'</div>' +
			'</div>' +
		'</div>';

	var editorContent = $("#cms_page_editor_content")[0];
	var content = $("textarea[name=content]")[0];
	editorContent.value = content.value;
	$(content).hide();

	tinymce.init({
		selector: '#cms_page_editor_content',
		branding: false,
		forced_root_block: false,
		height: 400,
		/*language: 'fr_FR',*/
		plugins: "code link lists visualblocks",
		menubar: "edit format tools",
		toolbar: [
			"code | undo redo | styleselect | removeformat | visualblocks | " +
			"bold italic underline strikethrough subscript superscript | " +
			"alignleft aligncenter alignright alignjustify alignnone | " +
			"bullist numlist | link unlink"
		]
	});

	var cmsPageContent = $("#cms_page_content")[0];
	$("#cms_page_content_container").append(cmsPageContent);
	// var widgets = $("#cms_page_widget_select")[0];
	// $("#cms_page_editor_widgets").append(widgets);

	$("#cms_page_content_maximize").hide();
}

CmsPage.prototype.contentDialogCancelEvent = function() {
	var content = $("textarea[name=content]")[0];
	$(content).show();
	tinymce.remove("#cms_page_editor_content");

	var cmsPageContent = $("#cms_page_content")[0];
	$("#cms_page_block_properties_accordion_content .panel-body").append(cmsPageContent);
	// var widgets = $("#cms_page_widget_select")[0];
	// $('#cms_page_tab_content_widgets').append(widgets);

	$("#cms_page_content_maximize").show();

	return true;
}

CmsPage.prototype.contentDialogValidEvent = function() {
	var editor = tinymce.get("cms_page_editor_content");
	var content = $("textarea[name=content]")[0];
	content.value = editor.getContent();
	$(content).show();
	$(content).trigger("change", {page: this});
	tinymce.remove("#cms_page_editor_content");

	var cmsPageContent = $("#cms_page_content")[0];
	$("#cms_page_block_properties_accordion_content .panel-body").append(cmsPageContent);
	// var widgets = $("#cms_page_widget_select")[0];
	// $('#cms_page_tab_content_widgets').append(widgets);

	$("#cms_page_content_maximize").show();

	return true;
}

CmsPage.prototype.doDelButtonMouseenterEvent = function(event) {
	var button = event.currentTarget;
	var sectionIndex = button.hasAttribute("data-section-index") ? parseInt(button.getAttribute("data-section-index")) : null;
	var rowIndex = button.hasAttribute("data-row-index") ? parseInt(button.getAttribute("data-row-index")) : null;
	var colIndex = button.hasAttribute("data-col-index") ? parseInt(button.getAttribute("data-col-index")) : null;

	var $block = $(event.data.page.getBlock(sectionIndex, rowIndex, colIndex));
	$("#delete_mask").show();
	$("#delete_mask").offset($block.offset());
	$("#delete_mask").outerWidth($block.outerWidth());
	$("#delete_mask").outerHeight($block.outerHeight());

	event.stopPropagation();
	event.preventDefault();
}

CmsPage.prototype.doDelButtonMouseleaveEvent = function(event) {
	$("#delete_mask").hide();

	event.stopPropagation();
	event.preventDefault();
}

CmsPage.prototype.doAddButtonMouseenterEvent = function(event) {
	var button = event.currentTarget;
	var action = button.getAttribute("data-action");

	var sectionIndex = button.hasAttribute("data-section-index") ? parseInt(button.getAttribute("data-section-index")) : null;
	var rowIndex = button.hasAttribute("data-row-index") ? parseInt(button.getAttribute("data-row-index")) : null;
	var colIndex = button.hasAttribute("data-col-index") ? parseInt(button.getAttribute("data-col-index")) : null;
	var position = button.hasAttribute("data-position") ? parseInt(button.getAttribute("data-position")) : null;

	var $button = $(button);
	var $block = null;
	var buttonOffset = $button.offset();

	$("#insert_mask").show();
	switch(action) {
		case "addSection":
			$block = $button.parents("#cms_page_container");
			$("#insert_mask").offset({top: buttonOffset.top + $button.outerHeight() / 2 - 2, left: buttonOffset.left + $button.outerWidth()});
			$("#insert_mask").outerWidth($block.width() - $button.outerWidth());
			$("#insert_mask").outerHeight(5);
			break;

		case "addRow":
			$block = $button.parents(".cms-page-section");
			var delta = position == 0 ? $button.outerWidth() : 0;
			$("#insert_mask").offset({top: buttonOffset.top + $button.outerHeight() / 2 - 2, left: buttonOffset.left + $button.outerWidth()});			
			$("#insert_mask").outerWidth($block.width() - $button.outerWidth() - delta);
			$("#insert_mask").outerHeight(5);
			break;

		case "addCol":
			$block = $button.parents(".cms-page-row");
			$("#insert_mask").offset({top: $block.offset().top, left: buttonOffset.left + $button.outerWidth() / 2 - 2});
			$("#insert_mask").outerWidth(5);
			$("#insert_mask").outerHeight($block.outerHeight());
			break;
	}

	event.stopPropagation();
	event.preventDefault();
}

CmsPage.prototype.doAddButtonMouseleaveEvent = function(event) {
	$("#insert_mask").hide();

	event.stopPropagation();
	event.preventDefault();
}

function _getAddSectionButton(position)
{
	html = 
		'<button type="button" class="action action-add-section btn btn-success btn-sm" title="Ajouter une section" data-action="addSection" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelSectionButton(sectionIndex)
{
	html = 
		'<button type="button" class="action action-del-section btn btn-danger btn-sm" title="Supprimer la section" data-action="delSection" data-section-index="'+sectionIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

function _getAddRowButton(sectionIndex, position)
{
	html = 
		'<button type="button" class="action action-add-row btn btn-success btn-sm" title="Ajouter une ligne" data-action="addRow" data-section-index="'+sectionIndex+'" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelRowButton(sectionIndex, rowIndex)
{
	html = 
		'<button type="button" class="action action-del-row btn btn-danger btn-sm" title="Supprimer la ligne" data-action="delRow" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

function _getAddColButton(sectionIndex, rowIndex, position)
{
	html = 
		'<button type="button" class="action action-add-col btn btn-success btn-sm" title="Ajouter une colonne" data-action="addCol" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'" data-position="'+position+'">'+
			'<i class="fa fa-plus"></i>'+
		'</button>';
	return html;
}

function _getDelColButton(sectionIndex, rowIndex, colIndex)
{
	html = 
		'<button type="button" class="action action-del-col btn btn-danger btn-sm" title="Supprimer la colonne" data-action="delCol" data-section-index="'+sectionIndex+'" data-row-index="'+rowIndex+'" data-col-index="'+colIndex+'">'+
			'<i class="fa fa-remove"></i>'+
		'</button>';
	return html;
}

var page = null;

$(document).ready(function() {
	if (typeof loadCmsPage !== 'undefined' && loadCmsPage) {
		page = new CmsPage(contentJson.title, contentJson.active, contentJson.sections);
		page.createHtml();
	}

	$("#formPage").on("submit", formPageSubmit);

	$(".cms-page-maximize").on()

	// $(window).on("scroll", cmsPageScroll);
});

function formPageSubmit(event) {
	var formPage = $("#formPage")[0];
	formPage.elements["content"].value = JSON.stringify(page);
}

var cmsPageBlockPropertiesContainerWidth = null;

function cmsPageScroll(event) {
	var $cmsPageBlockPropertiesContainer = $("#cms_page_block_properties_container");

	if (cmsPageBlockPropertiesContainerWidth == null) {
		cmsPageBlockPropertiesContainerWidth = $cmsPageBlockPropertiesContainer.width();
	}
	if ($(window).scrollTop() > 340) {
		$cmsPageBlockPropertiesContainer.css("position", "fixed");
		$cmsPageBlockPropertiesContainer.css("top", "60px");
		$cmsPageBlockPropertiesContainer.width(cmsPageBlockPropertiesContainerWidth);
	} else {
		$cmsPageBlockPropertiesContainer.css("position", "static");
		$cmsPageBlockPropertiesContainer.width(cmsPageBlockPropertiesContainerWidth);
	}
}