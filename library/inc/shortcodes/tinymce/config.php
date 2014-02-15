<?php
/**
 * Reactor Shortcodes Config
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author ThemeZilla (@themezilla / themezilla.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Alert Config
 */
$reactor_shortcodes['alert'] = array(
	'no_preview' => true,
	'params'     => array(
		'content' => array(
			'std'   => __('Alert Text', 'reactor'),
			'type'  => 'text',
			'label' => __('Alert\'s Text', 'reactor'),
			'desc'  => __('Add the alert\'s text', 'reactor'),
		),
		'type' => array(
			'type'    => 'select',
			'label'   => __('Alert Style', 'reactor'),
			'desc'    => __('Select the alert\'s style, ie the alert\'s colour', 'reactor'),
			'options' => array(
				''          => __('Standard', 'reactor'),
				'success'   => __('Success', 'reactor'),
				'alert'     => __('Alert', 'reactor'),
				'secondary' => __('Secondary', 'reactor'),
			)
		),
		'shape' => array(
			'type'    => 'select',
			'label'   => __('Alert Type', 'reactor'),
			'desc'    => __('Select the alert\'s type', 'reactor'),
			'options' => array(
				''       => __('Square', 'reactor'),
				'radius' => __('Radius', 'reactor'),
				'round'  => __('Round', 'reactor'),
			)
		),
		'close' => array(
			'type'    => 'select',
			'label'   => __('Closing X', 'reactor'),
			'desc'    => __('Display a X on the alert to close it', 'reactor'),
			'options' => array(
				'true'  => __('True', 'reactor'),
				'false' => __('False', 'reactor'),
			)
		)
	),
	'shortcode'   => '[alert shape="{{shape}}" type="{{type}}" close="{{close}}"] {{content}} [/alert]',
	'popup_title' => __('Insert Alert Shortcode', 'reactor')
);

/**
 * Button Config
 */
$reactor_shortcodes['button'] = array(
	'no_preview' => false,
	'params'     => array(
		'content' => array(
			'std'   => __('Button Text', 'reactor'),
			'type'  => 'text',
			'label' => __('Button\'s Text', 'reactor'),
			'desc'  => __('Add the button\'s text', 'reactor'),
		),
		'url' => array(
			'std'   => '',
			'type'  => 'text',
			'label' => __('Button URL', 'reactor'),
			'desc'  => __('Add the button\'s url eg http://example.com', 'reactor')
		),
		'type' => array(
			'type'    => 'select',
			'label'   => __('Button Style', 'reactor'),
			'desc'    => __('Select the button\'s style, ie the button\'s colour', 'reactor'),
			'options' => array(
				''          => __('Standard', 'reactor'),
				'success'   => __('Success', 'reactor'),
				'alert'     => __('Alert', 'reactor'),
				'secondary' => __('Secondary', 'reactor'),
			)
		),
		'size' => array(
			'type'    => 'select',
			'label'   => __('Button Size', 'reactor'),
			'desc'    => __('Select the button\'s size', 'reactor'),
			'options' => array(
				''       => __('Medium', 'reactor'),
				'tiny'   => __('Tiny', 'reactor'),
				'small'  => __('Small', 'reactor'),
				'large'  => __('Large', 'reactor'),
			)
		),
		'shape' => array(
			'type'    => 'select',
			'label'   => __('Button Type', 'reactor'),
			'desc'    => __('Select the button\'s type', 'reactor'),
			'options' => array(
				''       => __('Square', 'reactor'),
				'radius' => __('Radius', 'reactor'),
				'round'  => __('Round', 'reactor'),
			)
		),
		'expand' => array(
			'type'    => 'select',
			'label'   => __('Expand', 'reactor'),
			'desc'    => __('Expands the button to full width', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		),
		'disabled' => array(
			'type'    => 'select',
			'label'   => __('Disabled', 'reactor'),
			'desc'    => __('Button will be in a disabled state', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		)
	),
	'shortcode' => '[button url="{{url}}" shape="{{shape}}" size="{{size}}" type="{{type}}" expand="{{expand}}" disabled="{{disabled}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'reactor')
);

/**
 * Columns Config
 */
$reactor_shortcodes['columns'] = array(
	'params'      => array(),
	'shortcode'   => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'reactor'),
	'no_preview'  => true,
	
	'child_shortcode' => array(
		'params' => array(
			'first_last' => array(
				'type'    => 'select',
				'label'   => __('First or Last', 'reactor'),
				'desc'    => __('Select if this column is the first or last in the row', 'reactor'),
				'options' => array(
					''      => '',
					'first' => __('First', 'reactor'),
					'last'  => __('Last', 'reactor'),
				)
			),
			'large' => array(
				'type'    => 'select',
				'label'   => __('Large Grid', 'reactor'),
				'desc'    => __('Select the number of columns for the large screen grid', 'reactor'),
				'options' => array(
					'12' => '12',
					'11' => '11',
					'10' => '10',
					'9'  => '9',
					'8'  => '8',
					'7'  => '7',
					'6'  => '6',
					'5'  => '5',
					'4'  => '4',
					'3'  => '3',
					'2'  => '2',
					'1'  => '1',
				)
			),
			'small' => array(
				'type'    => 'select',
				'label'   => __('Small Grid', 'reactor'),
				'desc'    => __('Select the number of columns for the small screen grid', 'reactor'),
				'options' => array(
					'12' => '12',
					'11' => '11',
					'10' => '10',
					'9'  => '9',
					'8'  => '8',
					'7'  => '7',
					'6'  => '6',
					'5'  => '5',
					'4'  => '4',
					'3'  => '3',
					'2'  => '2',
					'1'  => '1',
				)
			),
			'content' => array(
				'std'   => '',
				'type'  => 'textarea',
				'label' => __('Column Content', 'reactor'),
				'desc'  => __('Add the column content.', 'reactor'),
			)
		),
		'shortcode'    => '[column large="{{large}}" small="{{small}}" first_last="{{first_last}}"] {{content}} [/column] ',
		'clone_button' => __('Add Column', 'reactor')
	)
);

/**
 * Flex Video Config
 */
$reactor_shortcodes['flex_video'] = array(
	'no_preview' => true,
	'params'     => array(
		'widescreen' => array(
			'type'  => 'select',
			'label' => __('Widescreen', 'reactor'),
			'desc'  => __('Select if the video widescreen', 'reactor'),
			'options' => array(
				'true'  => __('True', 'reactor'),
				'false' => __('False', 'reactor'),
			)
		),
		'vimeo' => array(
			'type'  => 'select',
			'label' => __('Vimeo', 'reactor'),
			'desc'  => __('Select if the video is vimeo to remove padding', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		),
		'content' => array(
			'std'   => '',
			'type'  => 'textarea',
			'label' => __('Video Embed Code', 'reactor'),
			'desc'  => __('Enter the code to embed the video', 'reactor'),
		)
	),
	'shortcode'   => '[flex_video widescreen="{{widescreen}}" vimeo="{{vimeo}}"] {{content}} [/flex_video]',
	'popup_title' => __('Insert Flex Video Shortcode', 'reactor')
);

/**
 * Glyph Icon Config
 */
$reactor_shortcodes['glyph_icon'] = array(
	'no_preview' => true,
	'params'     => array(
		'type'   => array(
			'type'  => 'select',
			'label' => __('Icon Cateogry', 'reactor'),
			'desc'  => __('Select the category for the icon', 'reactor'),
			'options' => array(
				'general'    => __('General', 'reactor'),
				'enclosed'   => __('Enclosed', 'reactor'),
				'social'     => __('Social', 'reactor'),
				'accessible' => __('Accessible', 'reactor'),
			)
		),
		'icon' => array(
			'std'  => '',
			'type'  => 'text',
			'label' => __('Icon', 'reactor'),
			'desc'  => __('Enter the name of the icon from http://zurb.com/playground/foundation-icons', 'reactor')
		),
		'style' => array(
			'std'  => '',
			'type'  => 'text',
			'label' => __('Styles', 'reactor'),
			'desc'  => __('Enter any styles for the icon as inline CSS ( ie. color: #000; )', 'reactor')
		),
		'content' => array(
			'std'   => '',
			'type'  => 'textarea',
			'label' => __('Text', 'reactor'),
			'desc'  => __('Enter any text to be displayed with the icon', 'reactor'),
		)
	),
	'shortcode' => '[glyph_icon type="{{type}}" icon="{{icon}}" style="{{style}}"] {{content}} [/glyph_icon]',
	'popup_title' => __('Insert Glyph Icon Shortcode', 'reactor')
);

/**
 * Label Config
 */
$reactor_shortcodes['label'] = array(
	'no_preview'  => true,
	'params'      => array(
		'content' => array(
			'std'   => __('Label Text', 'reactor'),
			'type'  => 'text',
			'label' => __('Alert\'s Text', 'reactor'),
			'desc'  => __('Add the label\'s text', 'reactor'),
		),
		'type' => array(
			'type'    => 'select',
			'label'   => __('Label Style', 'reactor'),
			'desc'    => __('Select the label\'s style, ie the label\'s colour', 'reactor'),
			'options' => array(
				''          => __('Standard', 'reactor'),
				'success'   => __('Success', 'reactor'),
				'alert'     => __('Alert', 'reactor'),
				'secondary' => __('Secondary', 'reactor'),
			)
		),
		'shape' => array(
			'type'    => 'select',
			'label'   => __('Label Type', 'reactor'),
			'desc'    => __('Select the label\'s type', 'reactor'),
			'options' => array(
				''       => __('Square', 'reactor'),
				'radius' => __('Radius', 'reactor'),
				'round'  => __('Round', 'reactor'),
			)
		)
	),
	'shortcode'   => '[label shape="{{shape}}" type="{{type}}"] {{content}} [/label]',
	'popup_title' => __('Insert Label Shortcode', 'reactor')
);

/**
 * Panel Config
 */
$reactor_shortcodes['panel'] = array(
	'no_preview' => true,
	'params'     => array(
		'callout'   => array(
			'type'  => 'select',
			'label' => __('Callout Style', 'reactor'),
			'desc'  => __('Callout style is a brighter panel', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		),
		'shape' => array(
			'type'  => 'select',
			'label' => __('Label Type', 'reactor'),
			'desc'  => __('Select the button\'s type', 'reactor'),
			'options' => array(
				''       => __('Square', 'reactor'),
				'radius' => __('Radius', 'reactor'),
			)
		),
		'content' => array(
			'std'   => __('Panel Text', 'reactor'),
			'type'  => 'textarea',
			'label' => __('Panel\'s Text', 'reactor'),
			'desc'  => __('Add the panel\'s text', 'reactor'),
		)
	),
	'shortcode' => '[panel shape="{{shape}}" callout="{{callout}}"] {{content}} [/panel]',
	'popup_title' => __('Insert Panel Shortcode', 'reactor')
);

/**
 * Price Table Config
 */
$reactor_shortcodes['price_table'] = array(
    'params' => array(
        'title' => array(
            'std'   => __('Title', 'reactor'),
            'type'  => 'text',
            'label' => __('Title', 'reactor'),
            'desc'  => __('Title of the price table', 'reactor'),
        ),
        'price' => array(
            'std'   => '0.00',
            'type'  => 'text',
            'label' => __('Price', 'reactor'),
            'desc'  => __('Price for the price table', 'reactor'),
        ),
        'desc' => array(
			'std'   => '',
            'type'  => 'text',
            'label' => __('Description', 'reactor'),
            'desc'  => __('Description of the price table', 'reactor'),
        ),
        'button' => array(
            'std'   => __('Buy Now', 'reactor'),
            'type'  => 'text',
            'label' => __('Button Text', 'reactor'),
            'desc'  => __('Text for the button on the price table', 'reactor'),
        ),
	),
    'no_preview'  => true,
    'shortcode'   => '[price_table title="{{title}}" price="{{price}}" desc="{{desc}}" button="{{button}}"] {{child_shortcode}}  [/price_table]',
    'popup_title' => __('Insert Price Table Shortcode', 'reactor'),
    
    'child_shortcode' => array(
        'params' => array(
            'content' => array(
                'std'   => '',
                'type'  => 'textarea',
                'label' => __('Section Content', 'reactor'),
                'desc'  => __('Add the tabs content', 'reactor')
            )
        ),
        'shortcode'    => '[pt_item] {{content}} [/pt_item]',
        'clone_button' => __('Add Price Table Item', 'reactor')
    )
);

/**
 * Progress Bar Config
 */
$reactor_shortcodes['progress_bar'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type'    => 'select',
			'label'   => __('Progress Bar Style', 'reactor'),
			'desc'    => __('Select the progress bar\'s style, ie the progress bar\'s colour', 'reactor'),
			'options' => array(
				''          => __('Standard', 'reactor'),
				'success'   => __('Success', 'reactor'),
				'alert'     => __('Alert', 'reactor'),
				'secondary' => __('Secondary', 'reactor'),
			)
		),
		'shape' => array(
			'type'    => 'select',
			'label'   => __('Progress Bar Type', 'reactor'),
			'desc'    => __('Select the progress bar\'s type', 'reactor'),
			'options' => array(
				''       => __('Square', 'reactor'),
				'radius' => __('Radius', 'reactor'),
				'round'  => __('Round', 'reactor'),
			)
		),
		'columns' => array(
			'type'    => 'select',
			'label'   => __('Progress Bar Length', 'reactor'),
			'desc'    => __('Select the progress bar\'s length in columns', 'reactor'),
			'options' => array(
				'12' => '12',
				'11' => '11',
				'10' => '10',
				'9'  => '9',
				'8'  => '8',
				'7'  => '7',
				'6'  => '6',
				'5'  => '5',
				'4'  => '4',
				'3'  => '3',
				'2'  => '2',
				'1'  => '1',
			)
		),
		'fill' => array(
			'std'   => '100%',
			'type'  => 'text',
			'label' => __('Progress Bar Fill', 'reactor'),
			'desc'  => __('Enter the progress bar\'s fill amount', 'reactor'),
		),
		'content' => array(
			'std'   => __('Bar Text', 'reactor'),
			'type'  => 'text',
			'label' => __('Progress Bar\'s Text', 'reactor'),
			'desc'  => __('Add the progress bar\'s text', 'reactor'),
		)
	),
	'shortcode'   => '[progress_bar shape="{{shape}}" type="{{type}}" fill="{{fill}}" columns="{{columns}}"] {{content}} [/progress_bar]',
	'popup_title' => __('Insert Progress Bar Shortcode', 'reactor')
);

/**
 * Reveal Modal Config
 */
$reactor_shortcodes['reveal_modal'] = array(
	'no_preview' => true,
	'params' => array(
		'text' => array(
			'type'  => 'text',
			'label' => __('Open Modal Text', 'reactor'),
			'desc'  => __('Add the link that will open the modal window', 'reactor'),
			'std'   => __('Click here', 'reactor'),
		),
		'size' => array(
			'type'    => 'select',
			'label'   => __('Modal Size', 'reactor'),
			'desc'    => __('Select the size of the modal window', 'reactor'),
			'options' => array(
				''       => __('Medium', 'reactor'),
				'tiny'   => __('Tiny', 'reactor'),
				'small'  => __('Small', 'reactor'),
				'Large'  => __('Large', 'reactor'),
				'xlarge' => __('X-Large', 'reactor'),
			)
		),
		'button' => array(
			'type'  => 'select',
			'label' => __('Button Link', 'reactor'),
			'desc'  => __('Select if the link that opens the modal is a button', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		),
		'content' => array(
			'std'   => __('Content', 'reactor'),
			'type'  => 'textarea',
			'label' => __('Modal Content', 'reactor'),
			'desc'  => __('Add the content for the modal. Will accept HTML', 'reactor'),
		),
		
	),
	'shortcode'   => '[reveal_modal text="{{text}}" size="{{size}}" button="{{button}}"] {{content}} [/reveal_modal]',
	'popup_title' => __('Insert Reveal Modal Shortcode', 'reactor')
);

/**
 * Sections Config
 */
$reactor_shortcodes['sections'] = array(
    'params' => array(
		'type' => array(
			'type'    => 'select',
			'label'   => __('Sections Type', 'reactor'),
			'desc'    => __('Select the type of sections to use', 'reactor'),
			'options' => array(
				'tabs'         => __('Tabs', 'reactor'),
				'accordion'    => __('Accordion', 'reactor'),
				'vertical-nav' => __('Vertical Nav', 'reactor'),
			)
		),
	),
    'no_preview'  => true,
    'shortcode'   => '[section_group type="{{type}}"] {{child_shortcode}}  [/section_group]',
    'popup_title' => __('Insert Sections Shortcode', 'reactor'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std'   => __('Title', 'reactor'),
                'type'  => 'text',
                'label' => __('Section Title', 'reactor'),
                'desc'  => __('Title of the section', 'reactor'),
            ),
		'active' => array(
			'type'    => 'select',
			'label'   => __('Active', 'reactor'),
			'desc'    => __('Select if this section is active on page load', 'reactor'),
			'options' => array(
				'false' => __('False', 'reactor'),
				'true'  => __('True', 'reactor'),
			)
		),
            'content' => array(
                'std'   => __('Tab Content', 'reactor'),
                'type'  => 'textarea',
                'label' => __('Section Content', 'reactor'),
                'desc'  => __('Add the tabs content', 'reactor')
            )
        ),
        'shortcode' => '[section title="{{title}}"] {{content}} [/section]',
        'clone_button' => __('Add Section', 'reactor')
    )
);

/**
 * Tooltip Config
 */
$reactor_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(
		'text' => array(
			'type'  => 'text',
			'label' => __('Tip Text', 'reactor'),
			'desc'  => __('Add the text that will be in the tooltip', 'reactor'),
			'std'   => __('Add tooltip text here', 'reactor'),
		),
		'position' => array(
			'type'    => 'select',
			'label'   => __('Tooltip Position', 'reactor'),
			'desc'    => __('Select where the tooltip should be displayed', 'reactor'),
			'options' => array(
				''      => __('Bottom', 'reactor'),
				'top'   => __('Top', 'reactor'),
				'right' => __('Right', 'reactor'),
				'left'  => __('Left', 'reactor'),
			)
		),
		'width' => array(
			'type'  => 'text',
			'label' => __('Tooltip Width', 'reactor'),
			'desc'  => __('Add a specific width for the tip. Only a number.', 'reactor'),
		),
		'content' => array(
			'std'   => __('Content', 'reactor'),
			'type'  => 'text',
			'label' => __('Modal Content', 'reactor'),
			'desc'  => __('Add the content for the modal. Will accept HTML', 'reactor'),
		),
		
	),
	'shortcode'   => '[tooltip text="{{text}}" position="{{position}}" width="{{width}}"] {{content}} [/tooltip]',
	'popup_title' => __('Insert a Tooltip Shortcode', 'reactor')
);
