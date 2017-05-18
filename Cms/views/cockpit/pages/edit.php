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
        {% input_text name="title" model="page.title" label="Nom de la page" placeholder="Nom de la page" %}
        {% input_checkbox name="active" model="page.active" label="Actif" %}
    </div>
    {% form_close %}
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="box box-purple">
            <div class="box-header">
                <h3 class="box-title">Propriétés</h3>
            </div>
            <div id="cms_page_block_properties" class="box-body">
                <div id="cms_page_block_name">
                </div>
                {% form_open id="formProperties" noBootstrapCol="1" %}
                    <div class="panel-group" id="cms_page_block_properties_accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_styles_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_styles" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_styles">
                                        Styles
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_styles" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_styles_heading">
                                <div class="panel-body">
                                    {% input_text name="color" label="Couleur du texte" data-property-type="style" data-property-name="color" %}
                                    {% input_text name="background" label="Couleur ou image de fond" data-property-type="style" data-property-name="background" %}
                                    {% input_text name="height" label="Hauteur" data-property-type="style" data-property-name="height" %}
                                    <label class="control-label">Paddings</label>
                                    {% input_text name="padding-top" data-property-type="style" data-property-name="padding-top" %}
                                    {% input_text name="padding-right" data-property-type="style" data-property-name="padding-right" %}
                                    {% input_text name="padding-bottom" data-property-type="style" data-property-name="padding-bottom" %}
                                    {% input_text name="padding-left" data-property-type="style" data-property-name="padding-left" %}                                    
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="cms_page_block_properties_accordion_attributes_heading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#cms_page_block_properties_accordion" href="#cms_page_block_properties_accordion_attributes" aria-expanded="false" aria-controls="cms_page_block_properties_accordion_attributes">
                                        Attributs
                                    </a>
                                </h4>
                            </div>
                            <div id="cms_page_block_properties_accordion_attributes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="cms_page_block_properties_accordion_attributes_heading">
                                <div class="panel-body">
                                    {% input_text name="id" label="Id" data-property-type="attribute" data-property-name="id" %}
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
                                    {% input_textarea name="content" label="Contenu HTML" data-property-type="content" %}
                                </div>
                            </div>
                        </div>
                    </div>
                {% form_close %}
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="box box-purple">
            <div class="box-header">
                <h3 class="box-title">Editeur de page</h3>
            </div>
            <div id="cms_page_container" class="box-body">
            </div>
        </div>
    </div>
</div>
