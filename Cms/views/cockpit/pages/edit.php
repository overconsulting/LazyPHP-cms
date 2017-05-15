<h1 class="page-title">{{ titlePage }}</h1>
<form id="formLogin" method="post" action="{{ formAction }}" class="form form-horizontal">
    <input type="hidden" class="config" name="content" value="" />
    <div class="box box-purple">
        <div class="box-header">
            <h3 class="box-title">{{ titleBox }}</h3>
            <div class="box-tools pull-right">
                <a href="" class="btn btn-primary btn-xs saveConfig"><i class="fa fa-floppy-o"></i></a>
            </div>
        </div>
        <div class="box-body">
            {% input_text name="url" value="/pages/<?php echo $params['page']->id; ?>" label="Url de la page" placeholder="Url de la page" %}
            {% input_text name="title" model="page.title" label="Nom de la page" placeholder="Nom de la page" %}
            {% input_checkbox name="active" model="page.active" label="Actif" %}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="box box-purple">
                <div class="box-header">
                    <h3 class="box-title">Ajouter des éléments HTML</h3>
                </div>
                <div class="box-body">
                    <ul>
                        <li><a href="" class="addSection">Ajouter une section</a></li>
                    </ul>
                </div>
            </div>

            <div class="box boxConfig box-purple">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <div class="elementConf">
                        <input type="hidden" name="id" class="id" value="" />
                        <div id="sectionPanel" class="panel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#sectionPanelStyle" aria-controls="home" role="tab" data-toggle="tab">Style</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="sectionPanelStyle">
                                    <br />
                                    <p align="center"><b>Configuration de la section</b></p>
                                    <div class="form-group">
                                        <label>Fond (couleur) : </label>
                                        <input type="text" name="background" class="form-control updated background" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Fond (image) : </label>
                                        {% input_media name="media_id" label="Image" mediaType="image" %}
                                    </div>

                                    <div class="form-group">
                                        <label>Hauteur : </label>
                                        <input type="text" name="height" class="form-control updated height" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Margin : </label>
                                        <br />
                                        <input type="text" name="margin-top" class="col-lg-3 updated margin-top" value="" />
                                        <input type="text" name="margin-right" class="col-lg-3 updated margin-right" value="" />
                                        <input type="text" name="margin-bottom" class="col-lg-3 updated margin-bottom" value="" />
                                        <input type="text" name="margin-left" class="col-lg-3 updated margin-left" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Padding : </label>
                                        <br />
                                        <input type="text" name="padding-top" class="col-lg-3 updated padding-top" value="" />
                                        <input type="text" name="padding-right" class="col-lg-3 updated padding-right" value="" />
                                        <input type="text" name="padding-bottom" class="col-lg-3 updated padding-bottom" value="" />
                                        <input type="text" name="padding-left" class="col-lg-3 updated padding-left" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Border : </label>
                                        <br />
                                        <input type="text" name="border-width" class="col-lg-3 updated border-width" value="" />
                                        <select class="col-lg-4 updated text-align" name="border-style">
                                            <option value="solid">Pleine</option>
                                            <option value="dotted">Pointillé</option>
                                            <option value="dashed">Tiret</option>
                                            <option value="none">Sans</option>
                                        </select>
                                        <input type="text" name="border-color" class="col-lg-4 updated border-color" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Class : </label>
                                        <input type="text" name="class" class="form-control updated class" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="lignePanel" class="panel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#sectionPanelStyle" aria-controls="home" role="tab" data-toggle="tab">Style</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="sectionPanelStyle">
                                    <br />
                                    <p align="center"><b>Configuration de la ligne</b></p>
                                    <div class="form-group">
                                        <label>Fond d'écran: </label>
                                        <input type="text" name="background-color" class="form-control updated background" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Hauteur : </label>
                                        <input type="text" name="height" class="form-control updated height" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Margin : </label>
                                        <br />
                                        <input type="text" name="margin-top" class="col-lg-3 updated margin-top" value="" />
                                        <input type="text" name="margin-right" class="col-lg-3 updated margin-right" value="" />
                                        <input type="text" name="margin-bottom" class="col-lg-3 updated margin-bottom" value="" />
                                        <input type="text" name="margin-left" class="col-lg-3 updated margin-left" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Padding : </label>
                                        <br />
                                        <input type="text" name="padding-top" class="col-lg-3 updated padding-top" value="" />
                                        <input type="text" name="padding-right" class="col-lg-3 updated padding-right" value="" />
                                        <input type="text" name="padding-bottom" class="col-lg-3 updated padding-bottom" value="" />
                                        <input type="text" name="padding-left" class="col-lg-3 updated padding-left" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Border : </label>
                                        <br />
                                        <input type="text" name="border-width" class="col-lg-3 updated border-width" value="" />
                                        <select class="col-lg-4 updated text-align" name="border-style">
                                            <option value="solid">Pleine</option>
                                            <option value="dotted">Pointillé</option>
                                            <option value="dashed">Tiret</option>
                                            <option value="none">Sans</option>
                                        </select>
                                        <input type="text" name="border-color" class="col-lg-4 updated border-color" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Class : </label>
                                        <input type="text" name="class" class="form-control updated class" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="colPanel" class="panel">
                            <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#style" aria-controls="style" role="tab" data-toggle="tab">Style</a></li>
                                <li role="presentation"><a href="#widget" aria-controls="widget" role="tab" data-toggle="tab">Widget</a></li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="style">
                                    <br />
                                    <p align="center"><b>Configuration de la colonne</b></p>

                                    <div class="form-group">
                                        <label>Fond d'écran : </label>
                                        <input type="text" name="background" class="form-control updated background" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Hauteur : </label>
                                        <input type="text" name="height" class="form-control updated height" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Margin : </label>
                                        <br />
                                        <input type="text" name="margin-top" class="col-lg-3 updated margin-top" value="" />
                                        <input type="text" name="margin-right" class="col-lg-3 updated margin-right" value="" />
                                        <input type="text" name="margin-bottom" class="col-lg-3 updated margin-bottom" value="" />
                                        <input type="text" name="margin-left" class="col-lg-3 updated margin-left" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Padding : </label>
                                        <br />
                                        <input type="text" name="padding-top" class="col-lg-3 updated padding-top" value="" />
                                        <input type="text" name="padding-right" class="col-lg-3 updated padding-right" value="" />
                                        <input type="text" name="padding-bottom" class="col-lg-3 updated padding-bottom" value="" />
                                        <input type="text" name="padding-left" class="col-lg-3 updated padding-left" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Border : </label>
                                        <br />
                                        <input type="text" name="border-width" class="col-lg-3 updated border-width" value="" />
                                        <select class="col-lg-4 updated text-align" name="border-style">
                                            <option value="solid">Pleine</option>
                                            <option value="dotted">Pointillé</option>
                                            <option value="dashed">Tiret</option>
                                            <option value="none">Sans</option>
                                        </select>
                                        <input type="text" name="border-color" class="col-lg-4 updated border-color" value="" />
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Class : </label>
                                        <input type="text" name="class" class="form-control updated class" value="" />
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="widget">
                                    <br />
                                    <div class="fleft"><b>Choisissez votre widget</b></div>
                                    <br />
                                    <div class="choix_widget">
                                        <a href="" class="widget_text btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="" class="widget_image btn btn-default"><i class="fa fa-picture-o"></i></a>
                                        <a href="" class="widget_widget btn btn-default"><i class="fa fa-qrcode"></i></a>
                                    </div>

                                    <div class="admin_widget_text admin_widget">
                                        <div class="form-group">
                                            <label>Color : </label>
                                            <input type="text" name="color" class="form-control updated_widget color" value="" />
                                        </div>

                                        <div class="form-group">
                                            <label>Taille de la police : </label>
                                            <input type="text" name="font-size" class="form-control updated_widget font-size" value="" />
                                        </div>

                                        <div class="form-group">
                                            <label>Text align : </label>
                                            <select class="form-control updated text-align" name="text-align">
                                                <option value="left">Gauche</option>
                                                <option value="center">Centré</option>
                                                <option value="right">Droite</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Hauteur de la ligne : </label>
                                            <input type="text" name="line-height" class="form-control updated_widget line-height" value="" />
                                        </div>

                                        <hr />

                                        <div class="form-group">
                                            <br />
                                            <label>Votre text : </label>
                                            <br />
                                            <textarea name="widget_text_content" class="form-control updated_widget_content" value="" /></textarea>
                                        </div>
                                        <div class="" align="right"><a href="" class="btn btn-default btn-admin-widget">Retour</a></div>
                                    </div>

                                    <div class="admin_widget_image admin_widget">
                                        <div class="form-group">
                                            <br />
                                            <label>Votre image : </label>
                                            <br />
                                            {% input_media name="media_widget_image_id" label="Image" mediaType="image" %}
                                        </div>
                                        <div class="" align="right"><a href="" class="btn btn-default btn-admin-widget">Retour</a></div>
                                    </div>

                                    <div class="admin_widget_widget admin_widget">

                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="box box-purple">
                <div class="box-header">
                    <h3 class="box-title">Rendu HTML</h3>
                    <div class="box-tools pull-right">
                        <a href="" class="btn btn-success btn-xs addSection"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="rendrecontent">
                    <?php $content = json_decode($params['page']->content); ?>
                    <?php
$compteur_section = 0;
if ($content == "") {
    $content['section'] = (object) array(
        'name' => "section_1",
        'class' => '',
        'styles' => (object) array(),
        'lignes' => (object) array(
            "section_1_ligne_1" => (object) array(
                'name' => "section_1_ligne_1",
                'class' => '',
                'styles' => (object) array(),
                'cols' => (object) array(
                    "section_1_ligne_1_col_1" => (object) array(
                        'name' => "section_1_ligne_1_col_1",
                        'class' => '',
                        'styles' => (object) array(),
                        'widgets'   => (object) array(
                            'content'     => 'Center',
                            'content_id'  => null,
                            'label'       => 'Widget Text',
                            'type'        =>  'text',
                            'styles'      => (object) array()
                        ),
                    )
                )
            )
        )
    );
}

foreach ($content as $section) {
    $compteur_section++;
    ?>
<section id="<?php echo $section->name ?>" class="section section<?php echo $compteur_section; ?> <?php echo $section->class ?>" style="<?php foreach ($section->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
    <div class="action">
        <div class="label label-default sectionConfig">Section <?php echo $compteur_section; ?></div>
        <a href="" class="label-success addLigne label"><i class="fa fa-plus"></i> ligne</a>
        <a href="" class="label-danger delSection label"><i class="fa fa-trash-o"></i> section</a>
    </div>
<?php
$compteur_ligne = 0;
foreach ($section->lignes as $ligne) {
    $compteur_ligne++;
    ?>
    <div class="row row<?php echo $compteur_ligne; ?> <?php echo $ligne->class ?>" id="<?php echo $ligne->name ?>" style="<?php foreach ($ligne->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
        <div class="action">
            <div class="label label-default ligneConfig">Ligne <?php echo $compteur_ligne; ?></div>
            <a href="" class="label-success addCol label"><i class="fa fa-plus"></i> colonne</a>
            <a href="" class="label-danger delLigne label"><i class="fa fa-trash-o"></i> ligne</a>
        </div>
<?php
$compteur_col=0;
foreach ($ligne->cols as $col) {
    $compteur_col++;
?>
    <div class="col col-lg-<?php echo 12/count((array)$ligne->cols); ?> <?php echo $col->class ?>" id="<?php echo $col->name ?>" style="<?php foreach ($col->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
        <div class="action">
            <div class="label label-default colConfig">Col <?php echo $compteur_col; ?></div>
            <a href="" class="label-danger delCol label"><i class="fa fa-trash-o"></i> col</a>
        </div>
        <?php if (property_exists($col, "widgets")) { ?>
            <?php if (!empty((array)$col->widgets)) { ?>
                <div class="content_widget" style="<?php if (property_exists($col->widgets, "styles")) { ?>
                    <?php foreach ($col->widgets->styles as $key_styles => $value_styles) { ?>
                        <?php echo $key_styles.": ".$value_styles; ?>
                    <?php } ?>
                <?php } ?>">
                    <?php if (isset($col->widgets->type) && $col->widgets->type == "text") { ?>
                        <?php echo $col->widgets->content; ?>
                    <?php } ?>
                    <?php if (isset($col->widgets->type) && $col->widgets->type == "image") { ?>
                        <?php echo $col->widgets->content; ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="content_widget">Center</div>
            <?php } ?>
        <?php } else { ?>
            <div class="content_widget">Center</div>
        <?php } ?>
    </div>
<?php } ?>
        <input type="hidden" class="nbSectionLigneCol" value="<?php echo $compteur_col ?>" />
    </div>
    <?php } ?>
    <input type="hidden" value="<?php echo $compteur_ligne ?>" class="nbSectionLigne" name="nbSectionLigne" />
</section>
    <?php
}
?>
<input type="hidden" class="nbSection" value="<?php echo $compteur_section; ?>" />
</div>
                    <div class="rendreaction">
                        <div class="row">
                            <div class="col col-lg-12">
                                <a href="" class="btn btn-success addSection"><i class="fa fa-plus"></i> Ajouter une Section</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="htmlElement">
        <section class="section section1">
            <input type="hidden" value="1" class="nbSectionLigne" name="nbSectionLigne" />
            <div class="action">
                <div class="label label-default sectionConfig">Section 1</div>
                <a href="" class="label-success addLigne label"><i class="fa fa-plus"></i> ligne</a>
                <a href="" class="label-danger delSection label"><i class="fa fa-trash-o"></i> section</a>
            </div>
            <div class="row row1">
                <input type="hidden" class="nbSectionLigneCol" value="1" />
                <div class="action">
                    <div class="label label-default ligneConfig">Ligne 1</div>
                    <a href="" class="label-success addCol label"><i class="fa fa-plus"></i> colonne</a>
                    <a href="" class="label-danger delLigne label"><i class="fa fa-trash-o"></i> ligne</a>
                </div>
                <div class="col col-lg-12">
                    <div class="action">
                        <div class="label label-default colConfig">Col 1</div>
                        <a href="" class="label-danger delCol label"><i class="fa fa-trash-o"></i> col</a>
                    </div>
                    <div class="content_widget">Center</div>
                </div>
            </div>
        </section>

        <div class="row row1">
            <input type="hidden" class="nbSectionLigneCol" value="1" />
            <div class="action">
                <div class="label label-default ligneConfig">Ligne 1</div>
                <a href="" class="label-success addCol label"><i class="fa fa-plus"></i> colonne</a>
                <a href="" class="label-danger delLigne label"><i class="fa fa-trash-o"></i> ligne</a>
            </div>
            <div class="col col-lg-12">
                <div class="action">
                    <div class="label label-default colConfig">Col 1</div>
                    <a href="" class="label-danger delCol label"><i class="fa fa-trash-o"></i> col</a>
                </div>
                <div class="content_widget">Center</div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    config = {};
    <?php foreach ($content as $section) { ?>
        <?php if (isset($section->name)) { ?>
            config.<?php echo $section->name ?> = {
                "name": "<?php echo $section->name ?>",
                "class": "<?php echo $section->class ?>",
                "lignes": {
                    <?php foreach ($section->lignes as $ligne) { ?>
                        "<?php echo $ligne->name ?>": {
                            "name": "<?php echo $ligne->name ?>",
                            "class": "<?php echo $ligne->class ?>",
                            'styles': {
                                <?php foreach ($ligne->styles as $key => $value) { ?>
                                    "<?php echo $key ?>": "<?php echo $value ?>",
                                <?php } ?>
                            },
                            "cols": {
                                <?php foreach ($ligne->cols as $col) { ?>
                                    "<?php echo $col->name ?>": {
                                        "name": "<?php echo $col->name ?>",
                                        "class": "<?php echo $col->class ?>",
                                        'styles': {
                                            <?php foreach ($col->styles as $key => $value) { ?>
                                                "<?php echo $key ?>": "<?php echo $value ?>",
                                            <?php } ?>
                                        },
                                        'widgets': {
                                            "content": <?php echo json_encode($col->widgets->content) ?>,
                                            "content_id": <?php echo json_encode($col->widgets->content_id) ?>,
                                            "label": <?php echo json_encode($col->widgets->label) ?>,
                                            "type": <?php echo json_encode($col->widgets->type) ?>,
                                            'styles': {
                                                <?php if (property_exists($col->widgets, "styles")) { ?>
                                                    <?php foreach ($col->widgets->styles as $key => $value) { ?>
                                                        "<?php echo $key ?>": <?php echo json_encode($value) ?>,
                                                    <?php } ?>
                                                <?php } ?>
                                            }
                                        },
                                    },
                                <?php } ?>
                            }
                        },
                    <?php } ?>
                },
                'styles': {
                    <?php foreach ($section->styles as $key => $value) { ?>
                        "<?php echo $key ?>": "<?php echo $value ?>",
                    <?php } ?>
                }
            };
        <?php } ?>
    <?php } ?>

    cible = "rendrecontent";
    console.log(config);

    function addSection() {
        sections = $('.nbSection').val();
        sections++;

        // On créé la div
        $('.'+cible).append('<section class="section section'+sections+'"></section>');

        // On récupère le code de la section
        html = $('#htmlElement .section').html();

        $('.section'+sections).html(html);

        // On met à jour les valeurs
        section = $('.section'+sections);

        section.find('.label:first').html('Section '+sections);
        section.attr('id', 'section_'+sections);

        $('.'+cible).find('.nbSection').val(sections);
        ligne_id = section.attr('id')+"_ligne_1";
        col_id = ligne_id+"_col_1";

        section.find('.row').attr('id', ligne_id);
        section.find('.row').find('.col').attr('id', col_id);
        
        // On ajout la section à la config
        config['section_'+sections] = {
            "name": 'section_'+sections,
            "class": "",
            "lignes": {},
            'styles': {}
        };
        config['section_'+sections]['lignes'][ligne_id] = {
            "name": ligne_id,
            "class": "",
            "styles": {},
            "cols": {}
        };
        
        config['section_'+sections]['lignes'][ligne_id]['cols'][col_id] = {
            "name": col_id,
            "styles": {},
            "class": "",
            'widgets': {
                'content'     : 'Center',
                'content_id'  : null,
                'label'       : 'Widget Text',
                'type'        : 'text',
                'styles'      : {}
            },
        };
    }

    function addLigne(obj) {
        // On récupère la section
        section = $(obj).parent().parent();
        
        // On récupère le nombre de Ligne et on le met à jour
        nbLigne = section.find('.nbSectionLigne').val();
        newNbLigne = (parseInt(nbLigne)+1);
        
        section.find('.nbSectionLigne').val(newNbLigne);

        // On affiche la nouvelle ligne
        html = $('#htmlElement .row').html();
        section.append('<div class="row row'+newNbLigne+'"></div>');
        row = section.find('.row'+newNbLigne);
        row.append(html);

        // On met à jour l'id de la ligne
        row.attr('id', section.attr('id')+"_"+'ligne_'+newNbLigne);

        // on met à jour l'id de la col
        row.find('.col').attr('id', section.attr('id')+"_"+'ligne_'+newNbLigne+'_col_1');

        // On met à jour la config
        config[section.attr('id')]["lignes"][section.attr('id')+"_ligne_"+newNbLigne]= 
        {
            "name": section.attr('id')+"_ligne_"+newNbLigne,
            "class": "",
            "styles": {},
            "cols": {}
        };

        col_id = section.attr('id')+"_ligne_"+newNbLigne+"_col_1";
        
        config[section.attr('id')]['lignes'][section.attr('id')+"_ligne_"+newNbLigne]['cols'][col_id] = {
            "name": col_id,
            "class": "",
            "styles": {},
            'widgets': {
                'content'     : 'Center',
                'content_id'  : null,
                'label'       : 'Widget Text',
                'type'        : 'text',
                'styles'      : {}
            },
        };

        // On met à jour les infos de la nouvelle ligne
        row.find(".label:first").html('Ligne '+newNbLigne);
    }

    function addCol(obj) {
        // On récupère le nombre de colonne
        nbCol = $(obj).parent().parent().find('.nbSectionLigneCol').val();
        
        if (nbCol > 5) {
            alert('Vous ne pouvez pas ajouter plus de colonne');
        } else {
            // On calcule le bon nom
            newNbCol = (parseInt(nbCol)+1);
            $(obj).parent().parent().find('.nbSectionLigneCol').val(newNbCol);
            newSizeCol = (12/newNbCol);
            
            // On set les valeurs
            row = $(obj).parent().parent();

            // on vire les ancienne class
            row.find( ".col" ).removeClass('col-lg-'+(12/parseInt(nbCol)));

            // on ajout la nouvelle colonne
            section = $(obj).parent().parent().parent().attr('id');
            col_id = row.attr('id')+"_col_"+newNbCol;
            row.append('<div class="col" id='+col_id+'><div class="action"><div class="label label-default colConfig">Col '+newNbCol+'</div><a href="" class="label-danger delCol label"><i class="fa fa-trash-o"></i> col</a></div><div class="content_widget">Center</div></div>');

            config[section]['lignes'][row.attr('id')]['cols'][col_id] = {
                "name": col_id,
                "class": "",
                "styles": {},
                'widgets': {
                    'content'     : 'Center',
                    'content_id'  : null,
                    'label'       : 'Widget Text',
                    'type'        : 'text',
                    'styles'      : {}
                },
            };

            $(obj).parent().parent().find('.nbSectionLigneCol').val(newNbCol);
            // $(obj).parent().attr('id', col_id)

            // on set les nouvelles valeurs
            row.find( ".col" ).addClass('col-lg-'+newSizeCol);
        }
    }

    // Partie pour les hover sur les blocs de configuration
    /*function hasBorderConfig(id) {
        hasBorderConfig = false
        if (config[id].hasOwnProperty("border-color")) {
            hasBorderConfig = true;
        }
        if (config[id].hasOwnProperty("border-width")) {
            hasBorderConfig = true;
        }
        if (config[id].hasOwnProperty("border-style")) {
            hasBorderConfig = true;
        }

        return hasBorderConfig;
    }*/

    /*$(document).on('mouseenter', '.rendrecontent .section', function() {
        $(this).css('border', '1px dashed #000');
    });

    $(document).on('mouseleave', '.rendrecontent .section', function() {
        // if (!hasBorderConfig($(this).attr('id'))) {
            $(this).css('border', '1px dashed #C0C0C0');
        // }
    });

    $(document).on('mouseenter', '.rendrecontent .row', function() {
        $(this).css('border', '1px dashed #000');
        $(this).parent().css('border', '1px dashed #C0C0C0');
    });

    $(document).on('mouseleave', '.rendrecontent .row', function() {
        $(this).css('border', '1px dashed #C0C0C0');
        $(this).parent().css('border', '1px dashed #000');
    });

    $(document).on('mouseenter', '.rendrecontent .col', function() {
        $(this).css('border', '1px dashed #000');
        $(this).parent().css('border', '1px dashed #C0C0C0');
    });

    $(document).on('mouseleave', '.rendrecontent .col', function() {
        $(this).css('border', '1px dashed #C0C0C0');
        $(this).parent().css('border', '1px dashed #000');
    });*/

    
    // Partie pour les clicks sur les boutons d'ajout
    $(document).on('click', '.addSection', function(event) {
        event.preventDefault();
        addSection();
    });

    $(document).on('click', '.addLigne', function(event) {
        event.preventDefault();
        addLigne(this);
    });

    $(document).on('click', '.addCol', function(event) {
        event.preventDefault();
        addCol(this);
    });

    // Partie pour les clicks de configration
    $(document).on('click', '.sectionConfig', function(event) {
        event.preventDefault();
        showPanel('section', this);
    });

    $(document).on('click', '.ligneConfig', function(event) {
        event.preventDefault();
        showPanel('ligne', this);
    });

    $(document).on('click', '.colConfig', function(event) {
        event.preventDefault();
        showPanel('col', this);
    });

    $(document).on('click', '.saveConfig', function(event) {
        event.preventDefault();
        saveConfig(config);
    });

    $(document).on('click', '.widget_text', function(event) {
        event.preventDefault();
        // On recupère le html
        $('.admin_widget_text').find('textarea').val( $('#' + $('.elementConf .id').val() + " .content_widget").html() );
        $('.admin_widget_image').hide();
        $('.admin_widget_text').show();
        $('.choix_widget').hide();
    });

    $(document).on('click', '.widget_image', function(event) {
        event.preventDefault();
        // On recupère le html

        $('.admin_widget_text').hide();
        $('.admin_widget_image').show();
        $('.choix_widget').hide();
    });

    $(document).on('click', '.widget_widget', function(event) {
        event.preventDefault();
        // On recupère le html

        $('.admin_widget_text').hide();
        $('.admin_widget_image').show();
        $('.choix_widget').hide();
    });

    $(document).on('click', '.btn-admin-widget', function(event) {
        event.preventDefault();
        $('.admin_widget_text').hide();
        $('.admin_widget_image').hide();
        $('.choix_widget').show();
    });

    $(document).on('click', '.delSection', function(event) {
        event.preventDefault();
        hidePanel();
        nbSection = $(this).parent().parent().parent().find('.nbSection').val();
        if (nbSection > 1) {
            $(this).parent().parent().parent().find('.nbSection').val((nbSection-1));
            delete config[$(this).parent().parent().attr("id")];
            $(this).parent().parent().remove();
        } else {
            alert('Il doit toujours y a voir au moins une section');
        }
    });

    $(document).on('click', '.delLigne', function(event) {
        event.preventDefault();
        hidePanel();
        nbLigne = $(this).parent().parent().parent().find('.nbSectionLigne').val();
        if (nbLigne > 1) {
            $(this).parent().parent().parent().find('.nbSectionLigne').val((nbLigne-1));
            ligne_id = $(this).parent().parent().attr("id");
            splitid = ligne_id.split("_");
            section_id=splitid[0]+"_"+splitid[1];
            delete config[section_id]['lignes'][ligne_id];
            $(this).parent().parent().remove();


            // On parcours les lignes pour mettre à jour
            count = (parseInt(splitid[3])+1);
            len = (Object.keys(config[section_id]['lignes']).length+1);
            for (; count <= len; count++) {
                id = section_id+'_ligne_'+count;
                new_id = section_id+'_ligne_'+(count-1);
                
                // On s'occupe de la partie config
                config[section_id]['lignes'][id]['name'] = new_id;
                config[section_id]['lignes'][new_id] = config[section_id]['lignes'][id];
                delete config[section_id]['lignes'][id];
                len_col = (Object.keys(config[section_id]['lignes'][new_id]["cols"]).length+1);

                // On modifie le HTML
                $("#"+id).find('.ligneConfig').html("Ligne "+ (count-1));
                $("#"+id).attr('id', new_id);

                // On modifie les Cols en fonction du nouvel id
                console.log(len_col);
                count_col = 1;
                for (; count_col < len_col; count_col++) {
                    console.log(id+"_col_"+count_col);
                    config[section_id]['lignes'][new_id]['cols'][id+"_col_"+count_col]['name'] = new_id+'_col_'+count_col;
                    config[section_id]['lignes'][new_id]['cols'][new_id+'_col_'+count_col] = config[section_id]['lignes'][new_id]['cols'][id+"_col_"+count_col];
                    delete config[section_id]['lignes'][new_id]['cols'][id+"_col_"+count_col];
                }
            }

        } else {
            alert('Il doit toujours y a voir au moins une ligne');
        }
    });

    $(document).on('click', '.delCol', function(event) {
        event.preventDefault();
        hidePanel();
        nbCol = $(this).parent().parent().parent().find('.nbSectionLigneCol').val();
        if (nbCol > 1) {
            col_id = $(this).parent().parent().attr("id");
            splitid = col_id.split("_");
            section_id = splitid[0]+"_"+splitid[1];
            ligne_id = section_id+"_"+splitid[2]+"_"+splitid[3];
            
            // On supprime la ligne en trop
            delete config[section_id]['lignes'][ligne_id]['cols'][col_id];
            $(this).parent().parent().remove();

            // Ici on refait les div correctement
            newNbCol = parseInt(nbCol)-1;
            $('#'+ligne_id+' .nbSectionLigneCol').val(newNbCol);
            newSizeCol = (12/newNbCol);
            $('#'+ligne_id+' .col').removeClass().addClass('col col-lg-'+newSizeCol);

            // On fait une boucle pour remettre la configuration et les id
            count = (parseInt(splitid[5])+1);
            len = (Object.keys(config[section_id]['lignes'][ligne_id]['cols']).length+1);
            for (; count <= len; count++) {
                id = ligne_id+'_col_'+count;
                new_id = ligne_id+'_col_'+(count-1);
                
                // On s'occupe de la partie config
                config[section_id]['lignes'][ligne_id]['cols'][id]['name'] = ligne_id+'_col_'+ (count-1);
                config[section_id]['lignes'][ligne_id]['cols'][new_id] = config[section_id]['lignes'][ligne_id]['cols'][id];
                delete config[section_id]['lignes'][ligne_id]['cols'][id];

                // On modifie le HTML
                $("#"+id).find('.colConfig').html("Col "+ (count-1));
                $("#"+id).attr('id', new_id);
            }

        } else {
            alert('Il doit toujours y a voir au moins une colonne');
        }
    });

    function saveConfig(config) {
        $('.config').val(JSON.stringify(config));
        $('#formLogin').submit();
    }

    function hidePanel() {
        $('.boxConfig').hide();
    }

    function showPanel(className, obj) {
        closeBoxConfig(className);
        $('.boxConfig').show();
        id = $(obj).parent().parent().attr('id');
        $('#'+className+'Panel').show();
        $('.boxConfig .box-title').html("Configuration du bloc "+id);
        $('.boxConfig .id').val(id);

        // On set les valeurs
        if (className == "section") {
            $.each(config[id]['styles'], function( index, value ) {
                $('.boxConfig .'+index).val(value);
            });
            $('.boxConfig .class').val(config[id]['class']);
        }

        if (className == "ligne") {
            splitid = id.split("_");
            section_id=splitid[0]+"_"+splitid[1];
            
            $.each(config[section_id]['lignes'][id]['styles'], function( index, value ) {
                $('.boxConfig .'+index).val(value);
            });
            $('.boxConfig .class').val(config[section_id]['lignes'][id]['class']);
        }
        
        if (className == "col") {
            splitid = id.split("_");
            section_id=splitid[0]+"_"+splitid[1];
            ligne_id = section_id+"_"+splitid[2]+"_"+splitid[3];
            
            $.each(config[section_id]['lignes'][ligne_id]['cols'][id]['styles'], function( index, value ) {
                $('.boxConfig .'+index).val(value);
            });
            $('.boxConfig .class').val(config[section_id]['lignes'][ligne_id]['cols'][id]['class']);
        }
    }

    function closeBoxConfig() {
        $('.boxConfig').find('input').val('');
        $('.boxConfig .panel').hide();
        $('.boxConfig').hide();
    }

    // Partie live update des champs
    $('.boxConfig #sectionPanel .updated').bind('keyup',function() {
        // On fait le live update
        $("#"+$(".boxConfig .id").val()).css($(this).attr("name"), $(this).val());

        // On sauvegarde la config de l'éléments
        if ($(this).attr("name") == 'class') {
            config[$(".boxConfig .id").val()]['class'] = $(this).val();
        } else {
            config[$(".boxConfig .id").val()]['styles'][$(this).attr("name")] = $(this).val();
        }
    });

    $('.boxConfig #sectionPanel #media_id_url').bind('change',function() {
        // On fait le live update
        // console.log("change fond 'écran");
        $("#"+$(".boxConfig .id").val()).css("background", "url("+$(this).parent().find('#media_id_url').val()+")");
        $("#"+$(".boxConfig .id").val()).css("background-size", "cover");
        $("#"+$(".boxConfig .id").val()).css("background-position", "center center");

        // On sauvegarde la config de l'éléments
        // console.log("#"+$(".boxConfig .id").val(), $(this).attr("name"));
        config[$(".boxConfig .id").val()]['styles']["background"] = "url("+$(this).parent().find('#media_id_url').val()+")";
        config[$(".boxConfig .id").val()]['styles']["background-size"] = "cover";
        config[$(".boxConfig .id").val()]['styles']["background-position"] = "center center";
    });

    // Partie live update des champs
    $('.boxConfig #colPanel .updated').bind('keyup',function() {
        // On fait le live update
        $("#"+$(".boxConfig .id").val()).css($(this).attr("name"), $(this).val());
        
        col_id=$(".boxConfig .id").val();
        var id = col_id.split("_");
        section_id=id[0]+"_"+id[1];
        ligne_id = section_id+"_"+id[2]+"_"+id[3];

        // On sauvegarde la config de l'éléments
        if ($(this).attr("name") == 'class') {
            config[section_id]['lignes'][ligne_id]['cols'][col_id]['class'] = $(this).val();
        } else {
            config[section_id]['lignes'][ligne_id]['cols'][col_id]['styles'][$(this).attr("name")] = $(this).val();
        }
    });

    $('.boxConfig #colPanel .updated').bind('change',function() {
        // On fait le live update
        $("#"+$(".boxConfig .id").val()).css($(this).attr("name"), $(this).val());

        col_id=$(".boxConfig .id").val();
        var id = col_id.split("_");
        section_id=id[0]+"_"+id[1];
        ligne_id = section_id+"_"+id[2]+"_"+id[3];

        // On sauvegarde la config de l'éléments
        if ($(this).attr("name") == 'class') {
            config[section_id]['lignes'][ligne_id]['cols'][col_id]['class'] = $(this).val();
        } else {
            config[section_id]['lignes'][ligne_id]['cols'][col_id]['styles'][$(this).attr("name")] = $(this).val();
        }
    });

    $('.boxConfig #colPanel #media_widget_image_id_url').bind('change',function() {
        col_id=$(".boxConfig .id").val();
        var id = col_id.split("_");
        section_id=id[0]+"_"+id[1];
        ligne_id = section_id+"_"+id[2]+"_"+id[3];

        
        // On sauvegarde la config de l'éléments
        widgets = config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets'] = {};
        widgets[$(this).attr("name")] = "<img src='"+$(this).parent().find('#media_widget_image_id_url').val()+"' alt='' />";
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['label'] = "Widget Image";
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['type'] = 'image';
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['content_id'] = null;
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['content'] = "<img src='"+$(this).parent().find('#media_widget_image_id_url').val()+"' alt='' />";

        $("#"+$(".boxConfig .id").val()+" .content_widget").html("<img src='"+$(this).parent().find('#media_widget_image_id_url').val()+"' alt='' />");
    });

    // Partie live update des champs
    $('.boxConfig #lignePanel .updated').bind('keyup',function() {
        // On fait le live update
        $("#"+$(".boxConfig .id").val()).css($(this).attr("name"), $(this).val());

        ligne_id = $(".boxConfig .id").val();
        var id = ligne_id.split("_");
        section_id=id[0]+"_"+id[1];

        // On sauvegarde la config de l'éléments
        if ($(this).attr("name") == 'class') {
            config[section_id]['lignes'][ligne_id]['class'] = $(this).val();
        } else {
            config[section_id]['lignes'][ligne_id]['styles'][$(this).attr("name")] = $(this).val();
        }
    });

    $('.boxConfig #colPanel .updated_widget').bind('keyup',function() {
        // On fait le live update
        $("#"+$(".boxConfig .id").val() + " .content_widget").css($(this).attr("name"), $(this).val());

        col_id=$(".boxConfig .id").val();
        var id = col_id.split("_");
        section_id=id[0]+"_"+id[1];
        ligne_id = section_id+"_"+id[2]+"_"+id[3];

        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['styles'][$(this).attr("name")] = $(this).val();

    });

    $('.boxConfig #colPanel .updated_widget_content').bind('keyup',function() {
        // On fait le live update
        // $("#"+$(".boxConfig .id").val()).css($(this).attr("name"), $(this).val());
        
        col_id=$(".boxConfig .id").val();
        var id = col_id.split("_");
        section_id=id[0]+"_"+id[1];
        ligne_id = section_id+"_"+id[2]+"_"+id[3];

        // On sauvegarde la config de l'éléments
        // widgets = config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets'] = {};
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets'][$(this).attr("name")] = $(this).val();
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['label'] = "Widget Text";
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['type'] = 'text';
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['content_id'] = null;
        config[section_id]['lignes'][ligne_id]['cols'][col_id]['widgets']['content'] = $(this).val();

        $("#"+$(".boxConfig .id").val()+" .content_widget").html($(this).val());
    });
</script>