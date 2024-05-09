<?php

function icontact_add_instance($icontact) {
    global $DB;
    $icontact->timemodified = time();
    $icontact->id = $DB->insert_record("icontact", $icontact);
    return $icontact->id;
}

function icontact_update_instance($icontact) {
    global $DB;
    $icontact->id = $icontact->instance;
    $icontact->timemodified = time();
    return $DB->update_record('icontact', $icontact);
}

function icontact_delete_instance($id) {
    global $DB;

    if (! $icontact = $DB->get_record("icontact", array("id"=>"$id"))) {
        return false;
    }

    $result = true;

    if (! $DB->delete_records("icontact", array("id"=>"$icontact->id"))) {
        $result = false;
    }

    return $result;
}

function icontact_get_icontact($icontactid) {
    global $DB;
    if ($icontact = $DB->get_record("icontact", array("id" => $icontactid))) {
        return $icontact;
    }
    return false;
}