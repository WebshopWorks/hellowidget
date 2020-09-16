<?php
/**
 * Hello Widget
 *
 * @author    WebshopWorks
 * @copyright 2020 WebshopWorks.com
 */

namespace CE;

defined('_PS_VERSION_') or die;

class WidgetHello extends WidgetBase
{
    public function getName()
    {
        return 'hello';
    }

    public function getTitle()
    {
        return $this->l('Hello');
    }

    public function getIcon()
    {
        return 'fa fa-hand-paper-o';
    }

    public function getCategories()
    {
        return array('prestashop');
    }

    protected function _registerControls()
    {
        $this->startControlsSection(
            'section_title',
            array(
                'label' => $this->l('Hello'),
            )
        );

        $this->addControl(
            'name',
            array(
                'label' => $this->l('Name'),
                'type' => ControlsManager::TEXT,
                'placeholder' => $this->l('Enter your name'),
                'default' => $this->l('Developer'),
            )
        );

        $this->addControl(
            'header_size',
            array(
                'label' => __('HTML Tag'),
                'type' => ControlsManager::SELECT,
                'options' => array(
                    'h1' => __('H1'),
                    'h2' => __('H2'),
                    'h3' => __('H3'),
                    'h4' => __('H4'),
                    'h5' => __('H5'),
                    'h6' => __('H6'),
                    'div' => __('div'),
                    'span' => __('span'),
                    'p' => __('p'),
                ),
                'default' => 'h2',
            )
        );

        $this->addResponsiveControl(
            'align',
            array(
                'label' => __('Alignment'),
                'type' => ControlsManager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left'),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center'),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right'),
                        'icon' => 'fa fa-align-right',
                    ),
                    'justify' => array(
                        'title' => __('Justified'),
                        'icon' => 'fa fa-align-justify',
                    ),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->addControl(
            'view',
            array(
                'label' => __('View'),
                'type' => ControlsManager::HIDDEN,
                'default' => 'traditional',
            )
        );

        $this->endControlsSection();

        $this->startControlsSection(
            'section_title_style',
            array(
                'label' => $this->l('Hello'),
                'tab' => ControlsManager::TAB_STYLE,
            )
        );

        $this->addControl(
            'title_color',
            array(
                'label' => __('Text Color'),
                'type' => ControlsManager::COLOR,
                'scheme' => array(
                    'type' => SchemeColor::getType(),
                    'value' => SchemeColor::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->addGroupControl(
            GroupControlTypography::getType(),
            array(
                'name' => 'typography',
                'scheme' => SchemeTypography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            )
        );

        $this->endControlsSection();
    }

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

    protected function l($string)
    {
        return translate($string, 'hellowidget', basename(__FILE__, '.php'));
    }
}
