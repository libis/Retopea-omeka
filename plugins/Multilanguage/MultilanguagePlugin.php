<?php
class MultilanguagePlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
            'install',
            'uninstall',
            'config',
            'config_form',
            'admin_head',
            'admin_footer',
            'initialize',
            'exhibits_browse_sql',
            'simple_pages_pages_browse_sql'
            );

    protected $_filters = array(
            'locale',
            'guest_user_links',
            'admin_navigation_main',
            );

    protected $_translationTable = null;

    protected $locale_code;

    public function hookInitialize($args)
    {
        add_translation_source(dirname(__FILE__) . '/languages');
    }

    public function hookExhibitsBrowseSql($args)
    {
        $this->modelBrowseSql($args, 'Exhibit');
    }

    public function hookSimplePagesPagesBrowseSql($args)
    {
        $this->modelBrowseSql($args, 'SimplePagesPage');
    }

    public function modelBrowseSql($args, $model)
    {
        if (! is_admin_theme()) {
            $select = $args['select'];
            $db = get_db();
            $alias = $db->getTable('MultilanguageContentLanguage')->getTableAlias();
            $modelAlias = $db->getTable($model)->getTableAlias();
            $select->joinLeft(array($alias => $db->MultilanguageContentLanguage),
                            "$alias.record_id = $modelAlias.id", array());
            $select->where("$alias.record_type = ?", $model);
            $select->where("$alias.lang = ?", $this->locale_code);
        }
    }
    public function filterGuestUserLinks($links)
    {
        $links['Multilanguage'] = array('label' => __('Preferred Language'), 'uri' => url('multilanguage/user-language/user-language'));
        return $links;
    }

    public function filterAdminNavigationMain($nav)
    {
        $nav['Multilanguage'] = array('label' => __('Preferred Language'), 'uri' => url('multilanguage/user-language/user-language'));
        $nav['Multilanguage_content'] = array(
                'label' => __('Multilanguage Content'),
                'uri'   => url('multilanguage/translations/content-language')
                );
        return $nav;
    }

    public function filterLocale($locale)
    {
        //setdefault
        $defaultCodes = "nl_BE";
        $this->locale_code = "nl_BE";

        //check session
        $langNamespace = new Zend_Session_Namespace('lang');
        if (isset($langNamespace->lang)):
          $this->locale_code = $langNamespace->lang;
        endif;

        //if exhibit change language (in case of a direct link)
        $url = explode("/",$_SERVER['REQUEST_URI']);
        if(in_array("exhibits",$url) && in_array("show",$url)):
          //slug comes after show
          $key = array_search ("show",$url);
          $slug = $url[$key+1];
          $db = get_db();
          $exhibit = $db->getTable('Exhibit')->findBySlug($slug);
          $lang = MultilanguageContentLanguage::lang("Exhibit",$exhibit->id);
          $this->locale_code = $lang;
          $langNamespace->lang = $lang;
        endif;

        //check url
        if(isset($_GET['lang'])):
          $lang = $_GET['lang'];
        else:
            return $this->locale_code;
        endif;

        if ($lang == "nl"):
            $this->locale_code = "nl_BE";
            $langNamespace->lang = "nl_BE";
        elseif($lang == "en_US"):
            $this->locale_code = "en_US";
            $langNamespace->lang = "en_US";
        endif;

        return $this->locale_code;
    }

    public function hookAdminFooter()
    {
        echo "<script type='text/javascript'>
        var baseUrl = '" . WEB_ROOT . "';
        </script>
        ";
    }

    public function hookAdminHead()
    {
        queue_css_file('multilanguage');
        queue_js_file('multilanguage');
    }

    public function hookInstall()
    {
        $db = $this->_db;
        $sql = "
CREATE TABLE IF NOT EXISTS $db->MultilanguageTranslation (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `locale_code` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `translation` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `element_id` (`element_id`,`record_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
                    ";

        $db->query($sql);

        $sql = "
CREATE TABLE IF NOT EXISTS $db->MultilanguageContentLanguage (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `record_id` int(10) unsigned NOT NULL,
  `lang` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
        ";

        $db->query($sql);

        $sql = "

CREATE TABLE IF NOT EXISTS $db->MultilanguageUserLanguage (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `lang` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

        ";

        $db->query($sql);
    }

    public function hookUninstall()
    {
        $db = $this->_db;
        $sql = "DROP TABLE $db->MultilanguageTranslation ";
        $db->query($sql);

        $sql = "DROP TABLE $db->MultilanguageContentLanguage ";
        $db->query($sql);


        $sql = "DROP TABLE $db->MultilanguageUserLanguage";
        $db->query($sql);

    }

    public function hookConfig($args)
    {
        $post = $args['post'];
        $elements = array();
        $elTable = get_db()->getTable('Element');
        foreach($post['element_sets'] as $elId) {
            $element = $elTable->find($elId);
            $elSet = $element->getElementSet();
            if(!array_key_exists($elSet->name, $elements)) {
                $elements[$elSet->name] = array();
            }
            $elements[$elSet->name][] = $element->name;
        }
        set_option('multilanguage_elements', serialize($elements));
        set_option('multilanguage_language_codes', serialize($post['multilanguage_language_codes']));
    }

    public function hookConfigForm()
    {
        include('config_form.php');
    }

    public function translateField($components, $args)
    {
        $record = $args['record'];
        $element = $args['element'];
        $type = get_class($record);
        $languages = unserialize(get_option('multilanguage_language_codes'));
        $html = __('Translate to: ');
        foreach ($languages as $code) {
            $html .= " <li data-element-id='{$element->id}' data-code='$code' data-record-id='{$record->id}' data-record-type='{$type}' class='multilanguage-code'>$code</li>";
        }
        $components['form_controls'] .= "<ul class='multilanguage' >$html</ul>";
        return $components;
    }

    public function translate($translateText, $args)
    {
        $db = $this->_db;
        $record = $args['record'];
        //since I'm being cheap and not differentiating Items vs Collections
        //or any other ActsAsElementText up above in the filter definitions (themselves weird),
        //I risk getting null values here
        //after the filter happens for 'element_text'
        if (! empty($args['element_text'])) {
            $elementText = $args['element_text'];

            $elementId = $elementText->element_id;

            $translation = $db->getTable('MultilanguageTranslation')->getTranslation($record->id, get_class($record), $elementId, $this->locale_code, $translateText);
            if ($translation) {
                $translateText = $translation->translation;
            }
        }
        return $translateText;
    }
}
