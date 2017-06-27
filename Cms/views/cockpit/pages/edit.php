<script type="text/javascript">
    var loadCmsPage = true;
    var contentJson = {{ contentJson }};
</script>

<h1 class="page-title">{{ pageTitle }}</h1>
<input type="hidden" class="config" name="content" value="" />
<div class="box box-purple">
    {% form_open id="formPage" action="formAction" class="form-horizontal" %}
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% input_submit name="submit" value="save_and_stay" formId="formPage" class="btn-primary" icon="save" label="Enregistrer &amp; Rester" %}
        </div>
    </div>
    <div class="box-body">
        <input type="hidden" name="content" value="<?php echo htmlspecialchars($page->content); ?>" />
        {% input_text name="title" model="page.title" label="Titre de la page" placeholder="Nom de la page" %}
        {% input_checkbox name="show_page_title" model="page.show_page_title" label="Afficher le titre" %}
        {% input_text name="layout" model="page.layout" label="Layout de la page" placeholder="Layout de la page" %}
        {% input_checkbox name="active" model="page.active" label="Afficher la page" %}
    </div>
    {% form_close %}
</div>

<div class="row">
    <div class="col-lg-3">
        <div id="cms_page_block_properties_container" class="box box-purple">
            <div class="box-header">
                <h3 class="box-title">Propriétés</h3>
            </div>
            <div id="cms_page_block_properties" class="box-body">
                <div id="cms_page_block_name">
                </div>
                {% form_open id="formProperties" noBootstrapCol="1" %}
                    <div class="panel-group" id="cms_page_block_properties_accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_box_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_box" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_box">
                                        Boîte
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_box" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_box_heading">
                                <div class="panel-body">
                                    {% input_select name="fullwidth" label="Contenu pleine largeur" data-property-type="fullwidth" options="fullwidthOptions" %}
                                    {% input_text name="id" label="Id" data-property-type="attribute" data-property-name="id" %}
                                    {% input_text name="class" label="Class" data-property-type="attribute" data-property-name="class" %}
                                    {% input_text name="height" label="Hauteur" data-property-type="style" data-property-name="height" %}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_font_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_font" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_font">
                                        Police
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_font" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_font_heading">
                                <div class="panel-body">
                                    {% input_text name="color" label="Couleur du texte" data-property-type="style" data-property-name="color" %}
                                    {% input_text name="font-size" label="Taille" data-property-type="style" data-property-name="font-size" %}
                                    {% input_select name="font-weight" label="Graisse" options="fontWeightOptions" data-property-type="style" data-property-name="font-weight" %}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_background_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_background" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_background">
                                        Fond
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_background" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_background_heading">
                                <div class="panel-body">
                                    {% input_text name="background" label="Couleur / Image" data-property-type="style" data-property-name="background" %}
                                    {% input_text name="background-color" label="Couleur" data-property-type="" data-property-name="" %}
                                    {% input_media name="background-image" label="Image" data-property-type="" data-property-name="" mediaType="image" mediaCategory="page" %}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_paddingsmargins_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_paddingsmargins" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_paddingsmargins">
                                        Paddings et Marges
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_paddingsmargins" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_paddingsmargins_heading">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label for="paddings" class="control-label col-lg-12">Paddings</label>
                                        <div class="input-box-model-top">
                                            <input id="padding-top" name="padding-top" value="" class="form-control" placeholder="top" data-property-type="style" data-property-name="padding-top" type="text">
                                        </div>
                                        <div class="input-box-model-left-right">
                                            <input id="padding-left" name="padding-left" value="" class="form-control" placeholder="left" data-property-type="style" data-property-name="padding-left" type="text">
                                            <input id="padding-right" name="padding-right" value="" class="form-control" placeholder="right" data-property-type="style" data-property-name="padding-right" type="text">
                                        </div>
                                        <div class="input-box-model-bottom">
                                            <input id="padding-bottom" name="padding-bottom" value="" class="form-control" placeholder="bottom" data-property-type="style" data-property-name="padding-bottom" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="margins" class="control-label col-lg-12">Marges</label>
                                        <div class="input-box-model-top">
                                            <input id="margin-top" name="margin-top" value="" class="form-control" placeholder="top" data-property-type="style" data-property-name="margin-top" type="text">
                                        </div>
                                        <div class="input-box-model-left-right">
                                            <input id="margin-left" name="margin-left" value="" class="form-control" placeholder="left" data-property-type="style" data-property-name="margin-left" type="text">
                                            <input id="margin-right" name="margin-right" value="" class="form-control" placeholder="right" data-property-type="style" data-property-name="margin-right" type="text">
                                        </div>
                                        <div class="input-box-model-bottom">
                                            <input id="margin-bottom" name="margin-bottom" value="" class="form-control" placeholder="bottom" data-property-type="style" data-property-name="margin-bottom" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_content_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_content" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_content">
                                        Contenu
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_content" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_content_heading">
                                <div class="panel-body">
                                    <div class="pull-right">
                                        <button type="button" id="cms_page_content_maximize" class="btn btn-info btn-xs action action-content-maximize" data-action="contentMaximize" title="Agrandir l'éditeur"><i class="fa fa-window-maximize"></i></button>
                                    </div>
                                    <div class="clear-fix">&nbsp;</div>
                                    <div id="cms_page_content">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="active" role="presentation">
                                                <a href="#cms_page_tab_content_html" aria-expanded="true" role="tab" data-toggle="tab">
                                                    Contenu HTML
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#cms_page_tab_content_widgets" aria-expanded="false" role="tab" data-toggle="tab">
                                                    Widgets
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="cms_page_tab_content_html" class="tab-pane in active" role="tabpanel">
                                                {% input_textarea name="content" data-property-type="content" rows="15" %}
                                                <textarea id="cms_page_editor_content"></textarea>
                                            </div>
                                            <div id="cms_page_tab_content_widgets" class="tab-pane" role="tabpanel">
<?php

echo '<div id="cms_page_widget_select">';

echo '<button type="button" class="btn btn-default action action-select-widget" data-action="selectWidget" data-widget-type="media" data-input-id="selected_media" data-media-type="image">Media</button>';

foreach ($widgets as $widget) {
    echo 
        '<button type="button" class="btn btn-default action action-select-widget" data-action="selectWidget" data-widget-type="'.$widget['type'].'">'.
            $widget['label'].
        '</button>';
}

echo 
    '<div id="cms_page_widget_params_media" class="cms-page-widget-params">'.
        '{% input_media name="selected_media multiple="0" mediaType="image" mediaCategory="page" %}'.
    '</div>';

foreach ($widgets as $widget) {
    echo '<div id="cms_page_widget_params_'.$widget['type'].'" class="cms-page-widget-params">';
    $widgetParams = explode(';', $widget['params']);
    if (!empty($widgetParams) && $widgetParams[0] != '') {
        foreach ($widgetParams as $wp) {
            echo '<div class="cms-page-widget-param">';
            if ($wp == 'id') {
                $widgetParamIdOptions = '';
                foreach ($widget['items'] as $item) {
                    $widgetParamIdOptions .= $item->id.':'.$item->id.';';
                }
                echo '{% input_select name="'.$wp.'" label="'.$wp.'" options="['.trim($widgetParamIdOptions, ';').']" %}';
            } else {
                echo '{% input_text name="'.$wp.'" label="'.$wp.'" %}';
            }
            echo '</div>';
        }
    }
    echo '</div>';
}

echo 
        '<button type="button" class="btn btn-success action action-insert-widget disabled" data-action="insertWidget">'.
            '<i class="fa fa-plus"></i> Insérer le widget'.
        '</button>'.
    '</div>';

?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {% form_close %}
            </div>
            {% input_submit name="submit" value="save_and_stay" formId="formPage" class="btn-primary" icon="save" label="Enregistrer &amp; Rester" %}
        </div>
    </div>

    <div class="col-lg-9">
        <div class="box box-purple">
            <div class="box-header">
                <h3 class="box-title">Editeur de page</h3>
                <div class="box-tools pull-right">
                    {% button url="/pages/$page.id$" new_window="1" type="warning" icon="eye" content="Aperçu" %}
                </div>
            </div>
            <div id="cms_page_container" class="box-body">
            </div>
            <div id="delete_mask"></div>
            <div id="insert_mask"></div>
        </div>
    </div>
</div>
