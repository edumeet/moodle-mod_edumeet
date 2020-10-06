<?php
// This file is part of the edumeet plugin for Moodle - http://moodle.org/
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
 * Define all the restore steps that will be used by the restore_edumeet_activity_task
 *
 * @package    mod_edumeet
 * @category   backup
 * @copyright  2020 Rémai Gábor.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Structure step to restore one edumeet activity
 *
 * @package    mod_edumeet
 * @category   backup
 * @copyright  2020 Rémai Gábor.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_edumeet_activity_structure_step extends restore_activity_structure_step {

    /**
     * Defines structure of path elements to be processed during the restore
     *
     * @return array of {restore_path_element}
     */
    protected function define_structure() {

        // $userinfo = $this->get_setting_value('userinfo');
        $paths = array();
        $paths[] = new restore_path_element('edumeet', '/activity/edumeet');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }
    /**
     * Post-execution actions
     */
    protected function after_execute() {
        // Add edumeet related files, no need to match by itemname (just internally handled context).
        $this->add_related_files('mod_edumeet', 'intro', null);
    }

    /**
     * Process actions
     */
    protected function process_edumeet($data) {
        global $DB;
        $data = (object)$data;
        // $oldid = $data->id;
        $data->course = $this->get_courseid();
        // insert the choice record
        $newitemid = $DB->insert_record('edumeet', $data);
        // immediately after inserting "activity" record, call this
        $this->apply_activity_instance($newitemid);
    }

}