<?php
require_once('../../config.php');

$id = optional_param('id', 0, PARAM_INT); // contact id
$cmid = required_param('cmid', PARAM_INT); // cmid

$url = new moodle_url('/mod/icontact/delete.php', ['id' => $id, 'cmid' => $cmid]);
$PAGE->set_url($url);

if (! $contactUpdate =  $DB->get_record('contacts', array("id" => $id))) {
    throw new \moodle_exception('invalidcontactsmodule');
}
$contactUpdate->softdeleted = time();
$DB->update_record('contacts', $contactUpdate);

redirect("view.php?id=$cmid");
