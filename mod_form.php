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
 * The main edumeet configuration form.
 *
 * @package     edumeet
 * @copyright   2019 Mészáros Mihály <misi@majd.eu>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package    edumeet
 * @copyright  2019 Mészáros Mihály <misi@majd.eu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_edumeet_mod_form extends moodleform_mod
{

    /**
     * Defines forms elements
     */
    public function definition() {
        global $CFG;

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are showed.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('edumeetname', 'edumeet'), array('size' => '64'));

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'edumeetname', 'edumeet');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // Adding the rest of edumeet settings, spreading all them into this fieldset
        // ... or adding more fieldsets ('header' elements) if needed for better logic.
        // $mform->addElement('static', 'label1', 'edumeetsettings', get_string('edumeetsettings', 'edumeet'));
        // $mform->addElement('header', 'edumeetfieldset', get_string('edumeetfieldset', 'edumeet'));

        $mform->addElement('text', 'room', get_string('room', 'edumeet'), array('size' => '64'));
        $mform->setDefault('room', substr(base64_encode(sha1(mt_rand())), 0, get_config('edumeet')->roomlength));
        $mform->setType('room', PARAM_TEXT);
        $mform->addHelpButton('room', 'room', 'edumeet');

        $mform->addElement('advcheckbox', 'pageredirect', get_string('pageredirect', 'edumeet'));
        // $mform->setDefault('pageredirect', 1);
        $mform->setType('pageredirect', PARAM_BOOL);

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }
}
