<?php
add_translation_source(dirname(__FILE__) . '/languages');
function public_nav_main_bootstrap() {
    $partial = array('common/menu-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function simple_nav(){
    $page = get_current_record('SimplePagesPage');

    $links = simple_pages_get_links_for_children_pages();

    $html ="";

    if(!$links && $page->parent_id != 0):
        $links = simple_pages_get_links_for_children_pages($page->parent_id);
    elseif(!$links && $page->parent_id == 0):
        return "";
    endif;


    $html .="<div class='row'>";
    $html .="<div class='col-md-12'>";
    $html .="<div class='side-nav'>";
    $html .="<ul class='simple-nav'>";
    foreach($links as $link):
        $html .= "<li><a href='".$link['uri']."'>".$link['label']."</a></li>";
    endforeach;
    $html .="</ul></div></div></div>";

    return $html;
}

function libis_get_simple_page_content($title) {
    $page = get_record('SimplePagesPage', array('title' => $title));
    if($page):
        return $page->text;
    else:
        return false;
    endif;
}

function multi_language_nav()
{
  //check default (from config)
  $defaultCodes = Zend_Locale::getDefault();
  $code = current(array_keys($defaultCodes));

  //check session
  $langNamespace = new Zend_Session_Namespace('lang');
  if (isset($langNamespace->lang)):
    $code = $langNamespace->lang;
  endif;

  if($code != "en_US"):
    return 'NL | <a href="'.url("/?lang=en_US").'">EN</a>';
  else:
    return '<a href="'.url("/?lang=nl").'">NL</a> | EN';
  endif;
}

function get_language(){
  //check default (from config)
  $defaultCodes = Zend_Locale::getDefault();
  $code = current(array_keys($defaultCodes));

  //check session
  $langNamespace = new Zend_Session_Namespace('lang');
  if (isset($langNamespace->lang)):
    $code = $langNamespace->lang;
  endif;

  if($code != "en_US"):
    return 'nl';
  else:
    return 'en';
  endif;
}

function libis_get_featured($type = 'item'){
  $records = get_records($type,array('featured'=>'1'));
  if($records):
    return $records;
  else:
    return false;
  endif;
}

function libis_link_to_related_exhibits($item) {

    $db = get_db();
    $html="";

    $select = "
    SELECT e.* FROM {$db->prefix}exhibits AS e
    INNER JOIN {$db->prefix}exhibit_pages AS ep on ep.exhibit_id = e.id
    INNER JOIN {$db->prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$db->prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ? group by e.id";

    $exhibits = $db->getTable("Exhibit")->fetchObjects($select,array($item->id));

    $lang = get_language();

    if(!empty($exhibits)) {
        foreach($exhibits as $exhibit) {
            $lang_ex = MultilanguageContentLanguage::lang('Exhibit',$exhibit->id);
            if (strpos($lang_ex, $lang) !== false) {
                $html .= '<a href="'.exhibit_builder_exhibit_uri($exhibit).'">'.$exhibit->title.'</a><br>';
            }
        }

        if($html):
          $html = '<div class="element in-exhibit"><h3>In <span class="lowercase">'.__("Exhibit").'</span></h3><div class="element-text">'.$html;
          $html .= "</div></div>";
        endif;

        return $html;
    }
}
