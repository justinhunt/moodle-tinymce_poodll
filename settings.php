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
 * PoodLL Anywhere settings.
 *
 * @package   tinymce_poodll
 * @copyright 2013 Justin Hunt {@link http://www.poodll.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

   $options = array('0' => get_string('no', 'tinymce_poodll'),
			'1' => get_string('yes', 'tinymce_poodll'));

				
	$settings->add(new admin_setting_configselect('tinymce_poodll/yesorno',
					   get_string('selectyesno', 'tinymce_poodll'),
					   get_string('selectyesnodetails', 'tinymce_poodll'), 0,$options));
	  
}
