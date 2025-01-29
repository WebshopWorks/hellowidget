<?php
/**
 * Hello Widget for Creative Elements
 * https://github.com/WebshopWorks/hellowidget
 *
 * @author    WebshopWorks
 * @copyright 2020-2025 WebshopWorks.com
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 */
namespace MyNamespace;

if (!defined('_PS_VERSION_')) {
    exit;
}

use CE\ControlsManager;
use CE\GroupControlTypography;
use CE\WidgetBase;
use function CE\__;

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
     * @return string Widget name
     */
    public function getName()
    {
        return 'my-hello';
    }

    /**
     * Get widget title.
     *
     * Retrieve hello widget title.
     *
     * @return string Widget title
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
     * @return string Widget icon
     */
    public function getIcon()
    {
        return 'eicon-heading';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the hello widget belongs to.
     * Used to determine where to display the widget in the editor.
     *
     * @return array Widget categories
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
     * @return array Widget keywords
     */
    public function getKeywords()
    {
        return ['hello', 'developer', 'sample'];
    }

    /**
     * Register hello widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
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
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->addGroupControl(
            GroupControlTypography::getType(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->endControlsSection();
    }

    /**
     * Render hello widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render()
    {
        $settings = $this->getSettingsForDisplay();

        $this->addRenderAttribute('heading', 'class', 'elementor-heading-title');

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
     */
    protected function contentTemplate()
    {
        ?>
        <{{ settings.header_size }} class="elementor-heading-title">
            <?php echo $this->l('Hello'); ?> {{{ settings.name }}}
        </{{ settings.header_size }}>
        <?php
    }

    /**
     * Get translation for a given widget text
     *
     * @param string $string String to translate
     *
     * @return string Translation
     */
    protected function l($string)
    {
        return \Translate::getModuleTranslation('hellowidget', $string, basename(__FILE__, '.php'));
    }
}
