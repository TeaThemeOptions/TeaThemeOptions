<?php

namespace Takeatea\TeaThemeOptions\Fields\Color;

use Takeatea\TeaThemeOptions\TeaThemeOptions;
use Takeatea\TeaThemeOptions\TeaFields;

/**
 * TEA COLOR FIELD
 *
 *
 * To add this field, simply make the same as follow:
 * array(
 *     'type' => 'color',
 *     'title' => 'What is your favorite Coke?',
 *     'id' => 'my_color_field_id',
 *     'default' => '#000000',
 *     'description' => 'Do not choose the Coke Zero, right? ;)'
 * )
 *
 */

if (!defined('TTO_CONTEXT')) {
    die('You are not authorized to directly access to this page');
}

//----------------------------------------------------------------------------//

/**
 * Tea Fields Color
 *
 * To get its own Fields
 *
 * @package Tea Fields
 * @subpackage Tea Fields Color
 * @since 1.5.2.14
 *
 */
class Color extends TeaFields
{
    //Define protected vars

    /**
     * Constructor.
     *
     * @since 1.3.0
     */
    public function __construct(){}


    //------------------------------------------------------------------------//

    /**
     * MAIN FUNCTIONS
     **/

    /**
     * Build HTML component to display in all the Tea T.O. defined pages.
     *
     * @param array $content Contains all data
     * @param array $post Contains all post data
     *
     * @since 1.4.0
     */
    public function templatePages($content, $post = array(), $prefix = '')
    {
        //Check if an id is defined at least
        if (empty($post)) {
            //Check if an id is defined at least
            $this->checkId($content);
        }
        else {
            //Modify content
            $content = $content['args']['contents'];
        }

        //Default variables
        $id = $content['id'];
        $title = isset($content['title']) ? $content['title'] : __('Tea Color', TTO_I18N);
        $default = isset($content['default']) ? $content['default'] : '';
        $description = isset($content['description']) ? $content['description'] : '';

        //Default way
        if (empty($post)) {
            //Check selected
            $val = TeaThemeOptions::get_option($prefix.$id, $default);
        }
        //On CPT
        else {
            //Check selected
            $val = get_post_meta($post->ID, $post->post_type . '-' . $id, true);
            $val = empty($val) ? $default : $val;
        }

        //Get template
        include(TTO_PATH.'/Fields/Color/in_pages.tpl.php');
    }
}
