<?php
/**
 * Hello widget for Creative Elements
 *
 * @author    WebshopWorks
 * @copyright 2021 WebshopWorks.com
 */

namespace CE;

defined('_PS_VERSION_') or die;

/**
 * Hello widget class.
 *
 * This is a sample widget for developers.
 */
class WidgetHello extends WidgetBase
{
    /**
     * Get widget name.
     *
     * Retrieve hello widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function getName()
    {
        return 'hello';
    }

    /**
     * Get widget title.
     *
     * Retrieve hello widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function getTitle()
    {
        return $this->l('Hello');
    }

    /**
     * Get widget icon.
     *
     * Retrieve hello widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function getIcon()
    {
        return 'fa fa-hand-paper-o';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the hello widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function getCategories()
    {
        return ['my-widgets'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     */
    public function getKeywords()
    {
        return ['hello', 'developer', 'sample'];
    }

    /**
     * Register hello widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @access protected
     */
    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_title',
            [
                'label' => $this->l('Hello'),
            ]
        );

        $this->addControl(
            'name',
            [
                'label' => $this->l('Name'),
                'type' => ControlsManager::TEXT,
                'placeholder' => $this->l('Enter your name'),
                'default' => $this->l('Developer'),
            ]
        );

        $this->addControl(
            'header_size',
            [
                'label' => __('HTML Tag'),
                'type' => ControlsManager::SELECT,
                'options' => [
                    'h1' => __('H1'),
                    'h2' => __('H2'),
                    'h3' => __('H3'),
                    'h4' => __('H4'),
                    'h5' => __('H5'),
                    'h6' => __('H6'),
                    'div' => __('div'),
                    'span' => __('span'),
                    'p' => __('p'),
                ],
                'default' => 'h2',
            ]
        );

        $this->addResponsiveControl(
            'align',
            [
                'label' => __('Alignment'),
                'type' => ControlsManager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->addControl(
            'view',
            [
                'label' => __('View'),
                'type' => ControlsManager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->endControlsSection();

        $this->startControlsSection(
            'section_title_style',
            [
                'label' => $this->l('Hello'),
                'tab' => ControlsManager::TAB_STYLE,
            ]
        );

        $this->addControl(
            'title_color',
            [
                'label' => __('Text Color'),
                'type' => ControlsManager::COLOR,
                'scheme' => [
                    'type' => SchemeColor::getType(),
                    'value' => SchemeColor::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->addGroupControl(
            GroupControlTypography::getType(),
            [
                'name' => 'typography',
                'scheme' => SchemeTypography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->endControlsSection();
    }

    /**
     * Render hello widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->getSettings();

        $this->addRenderAttribute('heading', 'class', 'elementor-heading-title');

        if (!empty($settings['size'])) {
            $this->addRenderAttribute('heading', 'class', 'elementor-size-' . $settings['size']);
        }

        echo sprintf(
            '<%1$s %2$s>%3$s %4$s</%1$s>',
            $settings['header_size'],
            $this->getRenderAttributeString('heading'),
            $this->l('Hello'),
            $settings['name']
        );
    }

    /**
     * Render hello widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
    protected function _contentTemplate()
    {
        ?>
        <#
        var hello = <?php echo json_encode($this->l('Hello')) ?>,
            name = settings.name || '';

        print('<' + settings.header_size  + ' class="elementor-heading-title elementor-size-' + settings.size + '">Hello ' + name + '</' + settings.header_size + '>');
        #>
        <?php
    }

    /**
     * Get translation for a given widget text
     *
     * @access protected
     *
     * @param string $string    String to translate
     *
     * @return string Translation
     */
    protected function l($string)
    {
        return translate($string, 'hellowidget', basename(__FILE__, '.php'));
    }
}
