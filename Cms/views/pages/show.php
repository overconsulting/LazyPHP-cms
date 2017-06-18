<?php

$content = json_decode($page->content, true);

if ($page->title != '' && $page->showPageTitle) {
    echo '<h1 class="page-title">'.$page->title.'</h1>';
}

if (isset($content['sections'])) {
  foreach ($content['sections'] as $s => $section) {
      if ($section['fullwidth']) {
          $containerClass = 'container-fluid';
      } else {
          $containerClass = 'container';
      }

      echo
          '<section'.attributesToHtml($section['attributes']).stylesToHtml($section['styles']).'>'.
              '<div class="'.$containerClass.'">';

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
                  'class' => 'col-md-'.$colSize
              );

              echo
                  '<div'.attributesToHtml($col['attributes'], $attributesToMerge).stylesToHtml($col['styles']).'>'.
                      rawurldecode($col['content']).
                  '</div>';
          }

          echo '</div>';
      }

      echo
              '</div>'.
          '</section>';
  }
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
