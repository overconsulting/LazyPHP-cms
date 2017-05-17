<script type="text/javascript">
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
            <div id="cms_page_element_properties" class="box-body">
                <div id="cms_page_element_name"></div>
                {% form_open id="formProperties" noBootstrapCol="1" %}
                    {% input_text name="id" label="Id" %}
                    {% input_text name="background" label="Couleur de fond" %}
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
