<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Activity view page for the plugintype_pluginname plugin.
 *
 * @package   plugintype_pluginname
 * @copyright Year, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once("lib.php");
require_once($CFG->libdir . '/completionlib.php');

$id = required_param('id', PARAM_INT);  // Course Module ID


$url = new moodle_url('/mod/icontact/view.php', array('id'=>$id));
$PAGE->set_url($url);

if (! $cm = get_coursemodule_from_id('icontact', $id)) {
    throw new \moodle_exception('invalidcoursemodule');
}

if (! $course = $DB->get_record("course", array("id" => $cm->course))) {
    throw new \moodle_exception('coursemisconf');
}

require_course_login($course, false, $cm);

if (!$icontact = icontact_get_icontact($cm->instance)) {
    throw new \moodle_exception('invalidIcontactmodule');
}

if (!$contacts = $DB->get_records("contacts", array("icontactid" => $cm->instance,'softdeleted' => 0))) {
    $contacts= [];
}

echo $OUTPUT->header();

// render
$records = [];
foreach ($contacts as $contact) {
    $records[] = [
        'id' => $contact->id,
        'name' => $contact->name,
        'email' => $contact->email,
        'phone' => $contact->phone,
        'address' => $contact->address
    ];
}

$templatecontext = [
    'contacts' => $records,
    'cmid'=>$cm->id,
    'icontactid'=>$icontact->id
];

echo $OUTPUT->render_from_template('mod_icontact/contacts',$templatecontext);