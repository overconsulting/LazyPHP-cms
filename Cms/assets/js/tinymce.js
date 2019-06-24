$(document).ready(function() {
    tinymceInit();
});

var tinymceSelectMediasDialog = null;
var tinymceSelectMediasInputId = null;

function tinymceInit(id = null)
{
    var selector = "textarea.tinymce";
    if (id != null) {
        selector = "#" + id;
    }

    var url = window.location.href;
    var arr = url.split("/");
    url_final = arr[0] + "//" + arr[2];

    tinymce.init({
        selector: selector,
        branding: false,
        forced_root_block: "p",
        height: 400,
        /*language: 'fr_FR',*/
        plugins: "code textcolor link lists visualblocks image paste",
        menubar: "edit format insert tools",
        toolbar: [
            "code | undo redo | styleselect | removeformat | visualblocks | " +
            "bold italic underline strikethrough subscript superscript | forecolor backcolor | " +
            "alignleft aligncenter alignright alignjustify alignnone | " +
            "bullist numlist | link unlink | image"
        ],
        file_browser_callback: tinymceMediaCallback,
        file_browser_callback_types: "image",
        relative_urls : false,
        remove_script_host : true,
        document_base_url : url_final,
        valid_children: "+h1[hr]",
        paste_as_text: true,
        paste_text_sticky : true,
        formats: {
            removeformat: [
              {selector: '*', attributes : ['style', 'class'], split : false, expand : false, deep : true}
            ]
          }
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
        var multiple = false;
        var mediaType = "image";
        var mediaCategory = "";

        params = {
            inputId: inputId,
            inputDisplayId: inputDisplayId,
            multiple: multiple,
            mediaType: mediaType,
            mediaCategory: mediaCategory,
            loadEvent: tinymceSelectMediasLoadEvent,
            validEvent: tinymceSelectMediasValidEvent
        };

        tinymceSelectMediasInputId = field_name;

        tinymceSelectMediasDialog = new SelectMediasDialog();
        tinymceSelectMediasDialog.selectMedias(params);
    }
}

function tinymceSelectMediasLoadEvent()
{
    $("#select_medias_dialog").css("z-index", 100000);
    $("#select_medias_dialog .lazy-dialog-close-button").css("z-index", 110000);
}

function tinymceSelectMediasValidEvent()
{
    var mediaId = tinymceSelectMediasDialog.selectedMedias[0];

    var element = $("#select_medias_dialog .media[data-media-id="+mediaId+"]");
    var media = JSON.parse(decodeURIComponent($(element).data("media")));

    var mediaFormat = $("#select_medias_dialog input[name=media_format]:checked").val();

    var mediaUrl = "";
    if (mediaFormat == "") {
        mediaUrl = media.image.url;
    } else {
        mediaUrl = media.infos.formats_urls[mediaFormat];
    }

    $("#"+tinymceSelectMediasInputId).val(mediaUrl);

    $("#select_medias_dialog").css("z-index", 10000);
    $("#select_medias_dialog .lazy-dialog-close-button").css("z-index", 11000);
    return true;
}