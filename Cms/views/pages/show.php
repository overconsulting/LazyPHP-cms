<?php

$content = json_decode($page->content, true);

if ($page->title != '' && $page->showPageTitle) {
    echo '<h1 class="page-title">'.$page->title.'</h1>';
}

foreach ($content['sections'] as $s => $section) {
    $attr = explode(" ", $section['attributes']['class']);
    $section['attributes']['class'] = implode(" ", array_slice($attr, 1));
    $containerAttr['class'] = $attr[0];
    
    echo '<section'.attributesToHtml($section['attributes']).stylesToHtml($section['styles']).'>';
    //var_dump($section['attributes']);
        echo '<div'.attributesToHtml($containerAttr).'>';

    foreach ($section['rows'] as $r => $row) {
        $attributesToMerge = array(
            'class' => 'row'
        );

        echo '<div'.attributesToHtml($row['attributes'], $attributesToMerge).stylesToHtml($row['styles']).'>';

        if (count($row['cols']) > 0) {
            $colSize = intval(12 / count($row['cols']));
        } else {
            $colSize = 12;
        }

        foreach ($row['cols'] as $c => $col) {
            $attributesToMerge = array(
                'class' => 'col-lg-'.$colSize
            );

            echo 
                '<div'.attributesToHtml($col['attributes'], $attributesToMerge).stylesToHtml($col['styles']).'>'.
                    urldecode($col['content']).
                '</div>';
        }

        echo '</div>';
    }
        echo '</div>';

    echo '</section>';
}

function attributesToHtml($attributes, $attributesToMerge = array()) {
    $html = "";

    if (!empty($attributesToMerge)) {
        $diff = array_diff_key($attributesToMerge, $attributes);
        $attributes = array_merge($attributes, $diff);
        $attributesToMerge = array_diff_key($attributesToMerge, $diff);
    }

    if (!empty($attributes)) {
        foreach ($attributes as $k => $v) {
            if (isset($attributesToMerge[$k])) {
                $v = $v.' '.$attributesToMerge[$k];
            }
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
