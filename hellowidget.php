<?php
/**
 * Hello Widget for Creative Elements
 *
 * @author    WebshopWorks
 * @copyright 2021 WebshopWorks.com
 */

defined('_PS_VERSION_') or die;

class HelloWidget extends Module
{
    /**
     * Module Constructor
     *
     * @param string $name Module unique name
     * @param Context $context
     */
    public function __construct($name = null, Context $context = null)
    {
        $this->name = 'hellowidget';
        $this->tab = 'front_office_features';
        $this->version = '0.2.0';
        $this->author = 'WebshopWorks';
        $this->ps_versions_compliancy = ['min' => '1.7.0', 'max' => '1.7'];
        $this->bootstrap = true;
        $this->displayName = $this->l('Hello Widget');
        $this->description = $this->l('This is a sample widget, what you can use to extend Creative Elements - Elementor based PageBuilder.');

        parent::__construct($this->name, null);
    }

    /**
     * Register module to the actionCreativeElementsInit hook at install
     */
    public function install()
    {
        return parent::install() && $this->registerHook('actionCreativeElementsInit');
    }

    /**
     * Add module to Creative Elements' actions
     */
    public function hookActionCreativeElementsInit()
    {
        CE\add_action('elementor/elements/categories_registered', [$this, 'registerCategory']);

        CE\add_action('elementor/widgets/widgets_registered', [$this, 'registerWidget']);
    }

    /**
     * Register a custom widget category
     */
    public function registerCategory($elements_manager)
    {
        $elements_manager->addCategory('my-widgets', [
            'title' => $this->l('My Widgets'),
            'icon' => 'fa fa-font',
        ]);
    }

    /**
     * Include and register a widget
     */
    public function registerWidget($widgets_manager)
    {
        include _PS_MODULE_DIR_ . $this->name . '/classes/WidgetHello.php';

        $widgets_manager->registerWidgetType(new CE\WidgetHello());
    }
}
