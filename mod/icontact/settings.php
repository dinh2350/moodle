<?php

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    // Popup Height setting
    $settings->add(new admin_setting_configtext(
        'mod_icontact/popupheight', // Setting name
        get_string('popupheight', 'mod_icontact'), // Setting label
        get_string('popupheightexplain', 'mod_icontact'), // Setting description
        450, // Default value
        PARAM_INT // Param type
    ));
}
