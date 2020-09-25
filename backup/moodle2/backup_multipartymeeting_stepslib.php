<?php
// This file is part of the multipartymeeting plugin for Moodle - http://moodle.org/
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
 * Defines backup_multipartymeeting_activity_structure_step class.
 *
 * @package    mod_multipartymeeting
 * @copyright  2020 Rémai Gábor.
 * @copyright  based on work by 2015 UC Regents
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete multipartymeeting structure for backup, with file and id annotations.
 *
 * @package    mod_multipartymeeting
 * @category   backup
 * @copyright  2020 Rémai Gábor.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_multipartymeeting_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        // Are we including userinfo?
        $userinfo = $this->get_setting_value('userinfo');

        // Define the root element describing the multipartymeeting instance.
        $multipartymeeting = new backup_nested_element('multipartymeeting', array('id'), array(
            'course', 'name', 'intro',
            'introformat', 'room', 'pageredirect', 'timecreated',
            'timemodified'));
        // If we had more elements, we would build the tree here.

        // Define data sources.
        $multipartymeeting->set_source_table('multipartymeeting', array('id' => backup::VAR_ACTIVITYID));

        // If we were referring to other tables, we would annotate the relation
        // with the element's annotate_ids() method.

        // Define file annotations.
        // Intro does not need itemid.
        $multipartymeeting->annotate_files('mod_multipartymeeting', 'intro', null);

        // Return the root element (multipartymeeting), wrapped into standard activity structure.
        return $this->prepare_activity_structure($multipartymeeting);
    }
}
