<?php
$content = json_decode($params['page']->content);

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
                    <?php if (property_exists($col, "widgets")) { ?>
            <?php foreach ($col->widgets as $value) { ?>
                <?php echo $value; ?>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
    </div>
    <?php } ?>
</section>
    <?php

}
?>
