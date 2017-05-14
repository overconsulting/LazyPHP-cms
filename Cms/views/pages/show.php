<?php
$content = json_decode($page->content);

foreach ($content as $section) {
    ?>
<section id="<?php echo $section->name ?>" class="<?php echo $section->class ?>" style="<?php foreach ($section->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
<?php
foreach ($section->lignes as $ligne) {
    ?>
    <div class="row" id="<?php echo $ligne->name ?>" style="<?php foreach ($ligne->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
<?php
foreach ($ligne->cols as $col) {
?>
    <div class="col col-lg-<?php echo 12/count((array)$ligne->cols); ?>" id="<?php echo $ligne->name ?>" style="<?php foreach ($col->styles as $key => $value) { ?>
                        <?php echo "$key: $value;"; ?>
                    <?php } ?>">
                    <?php if (!empty((array)$col->widgets)) { ?>
                <div class="content_widget" style="<?php if (property_exists($col->widgets, "styles")) { ?>
                    <?php foreach ($col->widgets->styles as $key_styles => $value_styles) { ?>
                        <?php echo $key_styles.": ".$value_styles; ?>
                    <?php } ?>
                <?php } ?>">
                    <?php if ($col->widgets->type == "text") { ?>
                        <?php echo $col->widgets->content; ?>
                    <?php } ?>
                    <?php if ($col->widgets->type == "image") { ?>
                        <?php echo $col->widgets->content; ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="content_widget">Center</div>
            <?php } ?>
    </div>
<?php } ?>
    </div>
    <?php } ?>
</section>
    <?php

}
?>

<?php

echo Widget\Widget::getWidget('gallery', 3);

?>
