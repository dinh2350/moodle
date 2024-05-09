<?php
require_once($CFG->libdir.'/formslib.php');

class contact_edit_form extends moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $mform = $this->_form; // Don't forget the underscore!

        $icontactid = $this->_customdata['icontactid'];
        $contact = $this->_customdata['contact'];


        // emlement hidden
        $mform->addElement('hidden', 'icontactid', $icontactid);
        $mform->setType('icontactid', PARAM_INT);

        $mform->addElement('hidden', 'contactid', $contact->id);

        // Add elements name to your form.
        $mform->addElement('text','name', get_string('name' , 'icontact'));
        $mform->addRule('name', get_string('missingname'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        // Add elements email to your form.
        $mform->addElement('text','email', get_string('email' , 'icontact'));
        $mform->addRule('email', get_string('missingemail'), 'required', null, 'client');
        $mform->setType('email', PARAM_TEXT);

        // Add elements phone to your form.
        $mform->addElement('text','phone', get_string('phone' , 'icontact'));
        $mform->addRule('phone', get_string('missingphone'), 'required', null, 'client');
        $mform->setType('phone', PARAM_TEXT);

        // Add elements address to your form.
        $mform->addElement('text','address', get_string('address' , 'icontact'));
        $mform->addRule('address', get_string('missingaddress'), 'required', null, 'client');
        $mform->setType('address', PARAM_TEXT);
        
        // When two elements we need a group.
        $buttonarray = array();
        $classarray = array('class' => 'form-submit');
        $buttonarray[] = &$mform->createElement('submit', 'saveanddisplay', get_string('savechangesanddisplay'), $classarray);
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
    }

    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}