<?php
require_once('../../config.php');
require_once('edit_form.php');

$id = optional_param('id', 0, PARAM_INT); // contact id
$icontactid = optional_param('icontact', 0, PARAM_INT); // icontact id
$PAGE->set_pagelayout('admin');

if ($id) {
    $pageparams = array('id' => $id);
    $contact = $DB->get_record('contacts', array('id' => $id));
} else {
    $pageparams = array('icontact' => $icontactid);
    $contact = null;
}

$url = new moodle_url('/mod/icontact/edit.php', $pageparams);
$PAGE->set_url($url);

echo $OUTPUT->header();

$args = array(
    'icontactid' => $icontactid,
    'contact' =>  $contact
);
$mform = new contact_edit_form(null,$args);

if ($mform->is_cancelled()) {
    // redicrect
} elseif ($fromform = $mform->get_data()) {
   if (empty($fromform->contactid)) {
        // In creating the contact.
        $data = new stdClass();
        $data->name=$fromform->name;
        $data->email=$fromform->email;
        $data->phone=$fromform->phone;
        $data->address=$fromform->address;
        $data->datecreated=time();
        $data->icontactid=$fromform->icontactid;
        $DB->insert_record("contacts", $data);
   }
   else{
      // In updating the contact.
        $contactUpdate = $DB->get_record('contacts' , array("id" => $fromform->contactid));
        if($contactUpdate){
            $contactUpdate->name=$fromform->name;
            $contactUpdate->email=$fromform->email;
            $contactUpdate->phone=$fromform->phone;
            $contactUpdate->address=$fromform->address;
            return $DB->update_record('contacts', $contactUpdate);
        }
   }
    
} else {
    $mform->set_data($contact);
    $mform->display();
}


