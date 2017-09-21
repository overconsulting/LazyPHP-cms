$(document).ready(function() {
    tinymceInit();
});

function tinymceInit(id = null)
{
    var selector = "textarea.tinymce";
    if (id != null) {
        selector = "#" + id;
    }

    tinymce.init({
        selector: selector,
        branding: false,
        forced_root_block: "p",
        height: 400,
        /*language: 'fr_FR',*/
        plugins: "code textcolor link lists visualblocks image",
        menubar: "edit format insert tools",
        toolbar: [
            "code | undo redo | styleselect | removeformat | visualblocks | " +
            "bold italic underline strikethrough subscript superscript | forecolor backcolor | " +
            "alignleft aligncenter alignright alignjustify alignnone | " +
            "bullist numlist | link unlink | image"
        ],
        file_browser_callback: tinymceMediaCallback,
        file_browser_callback_types: "image"
    });
}

function tinymceRemove(id)
{
    tinymce.remove("#" + id);
}

function tinymceMediaCallback(field_name, url, type, win)
{
    if (type == "image") {
        var inputId = null;
        var inputDisplayId = null;
        var multiple = "0";
        var mediaType = "image";
        var mediaCategory = "";

        params = {
            inputId: inputId,
            inputDisplayId: inputDisplayId,
            multiple: multiple,
            mediaType: mediaType,
            mediaCategory: mediaCategory,
            validEvent: tinymceMediaValidEvent
        };

        //$('#mce-modal-block').css("z-index");
        var selectMediasDialog = new SelectMediasDialog();
        selectMediasDialog.selectMedias(params);
    }
}

function tinymceMediaValidEvent() {
    return true;
}