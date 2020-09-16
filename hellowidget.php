<?php
/**
 * Hello Widget
 *
 * @author    WebshopWorks
 * @copyright 2020 WebshopWorks.com
 */

defined('_PS_VERSION_') or die;

class HelloWidget extends Module
{
    public function __construct($name = null, Context $context = null)
    {
        $this->name = 'hellowidget';
        $this->tab = 'front_office_features';
        $this->version = '0.1.0';
        $this->author = 'WebshopWorks';
        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => '1.7'];
        $this->bootstrap = true;
        $this->displayName = $this->l('Hello Widget');
        $this->description = $this->l('This is a sample widget, what you can use to extend Creative Elements - Elementor based PageBuilder.');

        parent::__construct($this->name, null);
    }

    public function install()
    {
        return parent::install() && $this->registerHook('actionCreativeElementsInit');
    }

    public function hookActionCreativeElementsInit()
    {
        CE\add_action('elementor/widgets/widgets_registered', [$this, 'registerWidget']);
    }

    public function registerWidget()
    {
        include _PS_MODULE_DIR_ . $this->name . '/classes/WidgetHello.php';

        CE\Plugin::instance()->widgets_manager->registerWidgetType(new CE\WidgetHello());
    }
}
