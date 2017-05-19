<?php

$content = json_decode($page->content, true);

if ($page->title != '') {
    echo '<h1 class="page-title">'.$page->title.'</h1>';
}

foreach ($content['sections'] as $s => $section) {
    echo '<section class="container"'.attributesToHtml($section['attributes']).stylesToHtml($section['styles']).'>';

    foreach ($section['rows'] as $r => $row) {
        echo '<div class="row"'.attributesToHtml($row['attributes']).stylesToHtml($row['styles']).'>';

        if (count($row['cols']) > 0) {
            $colSize = intval(12 / count($row['cols']));
        } else {
            $colSize = 12;
        }

        foreach ($row['cols'] as $c => $col) {
            echo 
                '<div class="col-lg-'.$colSize.'"'.attributesToHtml($col['attributes']).stylesToHtml($col['styles']).'>'.
                    urldecode($col['content']).
                '</div>';
        }

        echo '</div>';
    }

    echo '</section>';
}

function attributesToHtml($attributes) {
    $html = "";
    if (!empty($attributes)) {
        foreach ($attributes as $k => $v) {
            $html .= ' '.$k.'="'.$v.'"';
        }
    }
    return $html;
}

function stylesToHtml($styles) {
    $html = "";
    if (!empty($styles)) {
        $html .= ' style="';
        foreach ($styles as $k => $v) {
            $html .= ' '.$k.': '.$v.';';
        }
        $html .= '"';
    }
    return $html;
}
