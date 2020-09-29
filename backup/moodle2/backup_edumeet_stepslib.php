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
 * Defines backup_edumeet_activity_structure_step class.
 *
 * @package    mod_edumeet
 * @copyright  2020 Rémai Gábor.
 * @copyright  based on work by 2015 UC Regents
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete edumeet structure for backup, with file and id annotations.
 *
 * @package    mod_edumeet
 * @category   backup
 * @copyright  2020 Rémai Gábor.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_edumeet_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        // Are we including userinfo?
        // $userinfo = $this->get_setting_value('userinfo');

        // Define the root element describing the edumeet instance.
        $edumeet = new backup_nested_element('edumeet', array('id'), array(
            'course', 'name', 'intro',
            'introformat', 'room', 'pageredirect', 'timecreated',
            'timemodified'));
        // If we had more elements, we would build the tree here.

        // Define data sources.
        $edumeet->set_source_table('edumeet', array('id' => backup::VAR_ACTIVITYID));

        // If we were referring to other tables, we would annotate the relation
        // with the element's annotate_ids() method.

        // Define file annotations.
        // Intro does not need itemid.
        $edumeet->annotate_files('mod_edumeet', 'intro', null);

        // Return the root element (edumeet), wrapped into standard activity structure.
        return $this->prepare_activity_structure($edumeet);
    }
}
