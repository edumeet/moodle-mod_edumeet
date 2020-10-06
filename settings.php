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
 * Plugin administration pages are defined here.
 *
 * @package     mod_edumeet
 * @category    admin
 * @copyright   2019 Mészáros Mihály <misi@majd.eu>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    // TODO: Define the plugin settings page.
    $settings->add(new admin_setting_configtext(
      'edumeet/baseurl',
      get_string('edumeetbaseurl', 'edumeet'),
      get_string('edumeetbaseurl_desc', 'edumeet'),
      'https://letsmeet.no'
    ));
    $settings->add(new admin_setting_configtext(
      'edumeet/roomlength',
      get_string('edumeetroomlength', 'edumeet'),
      get_string('edumeetroomlength_desc', 'edumeet'),
      8
    ));
}
