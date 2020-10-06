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
 * Provides the restore activity task class
 *
 * @package    mod_edumeet
 * @category   backup
 * @copyright  2020 Rémai Gábor.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/edumeet/backup/moodle2/restore_edumeet_stepslib.php');

class restore_edumeet_activity_task extends restore_activity_task {

    protected function define_my_settings() {
        // No particular settings for this activity.
    }

    /**
     * Define (add) particular steps this activity can have
     */
    protected function define_my_steps() {
        // We have just one structure step here.
        $this->add_step(new restore_edumeet_activity_structure_step('edumeet_structure', 'edumeet.xml'));
    }


    /**
     * Define the contents in the activity that must be
     * processed by the link decoder
     */
    static public function define_decode_contents() {
        $contents = array();

        $contents[] = new restore_decode_content('edumeet', array('intro'), 'edumeet');

        return $contents;
    }

    /**
     * Define the decoding rules for links belonging
     * to the activity to be executed by the link decoder
     */
    static public function define_decode_rules() {
        $rules = array();

        $rules[] = new restore_decode_rule('EDUMEETVIEWBYID', '/mod/edumeet/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('EDUMEETINDEX', '/mod/edumeet/index.php?id=$1', 'course_module');

        return $rules;

    }

    /**
     * Define the restore log rules that will be applied
     * by the {restore_logs_processor} when restoring
     * edumeet logs. It must return one array
     * of {restore_log_rule} objects
     */
    static public function define_restore_log_rules() {
        $rules = array();

        $rules[] = new restore_log_rule('edumeet', 'add', 'view.php?id={course_module}', '{edumeet}');
        $rules[] = new restore_log_rule('edumeet', 'update', 'view.php?id={course_module}', '{edumeet}');
        $rules[] = new restore_log_rule('edumeet', 'view', 'view.php?id={course_module}', '{edumeet}');

        return $rules;
    }

    
}