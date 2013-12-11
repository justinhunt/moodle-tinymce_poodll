<?php

// This file is not a part of Moodle - http://moodle.org/
// This is a none core contributed module.
//
// This is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// The GNU General Public License
// can be see at <http://www.gnu.org/licenses/>.

/*
 * __________________________________________________________________________
 *
 * PoodLL TinyMCE for Moodle 2.x
 *
 * This plugin need to use together with Poodll filter.
 *
 * @package    poodll
 * @subpackage tinymce_poodll
 * @copyright  2013 UC Regents
 * @copyright  2013 Justin Hunt  {@link http://www.poodll.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * __________________________________________________________________________
 */

define('NO_MOODLE_COOKIES', false);

require('../../../../../../config.php');
require_once($CFG->dirroot . '/filter/poodll/poodllresourcelib.php');
//require_once($CFG->dirroot.'/repository/lib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/lib/editor/tinymce/plugins/poodll/tinymce/poodll.php');

if (isset($SESSION->lang)) {
    // Language is set via page url param.
    $lang = $SESSION->lang;
} else {
    $lang = 'en';
}
require_login();  // CONTEXT_SYSTEM level.
$editor = get_texteditor('tinymce');
$plugin = $editor->get_plugin('poodll');
$itemid = optional_param('itemid', '', PARAM_TEXT);
$recorder = optional_param('recorder', '', PARAM_TEXT);

/*
@header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php print_string('title', 'tinymce_poodll')?></title>
<script type="text/javascript" src="<?php echo $editor->get_tinymce_base_url(); ?>tiny_mce_popup.js"></script>
<script type="text/javascript" src="<?php echo $plugin->get_tinymce_file_url('js/poodll.js'); ?>"></script>

</head>
*/

//contextid
$usercontextid=context_user::instance($USER->id)->id;

//$updatecontrol
$updatecontrol = 'myfilename';

// Load the recorder.
switch($recorder){
 case 'video':
 	$recorderhtml =  fetchVideoRecorderForSubmission('auto', 'none', $updatecontrol, $usercontextid,'user','draft',$itemid);
 	break;
 case 'snapshot':
 	$recorderhtml =  fetchSnapshotCameraForSubmission($updatecontrol, "apic.jpg",350,400,$usercontextid,'user','draft',$itemid);
 	break;
 case 'whiteboard':
 	$recorderhtml =  fetchWhiteboardForSubmission($updatecontrol, $usercontextid,'user','draft',$itemid,400,350);
 	break;
 case 'audiored5':
 	$recorderhtml =  fetchAudioRecorderForSubmission('auto', 'none', $updatecontrol, $usercontextid,'user','draft',$itemid);
 	break; 		
 case 'audiomp3':
 default:
	$recorderhtml =  fetchMP3RecorderForSubmission($updatecontrol, $usercontextid ,'user','draft',$itemid);
}

$PAGE->set_pagelayout('popup');
$PAGE->set_title(get_string('title', 'tinymce_poodll'));
$PAGE->set_heading('');
$PAGE->requires->js(new moodle_url($editor->get_tinymce_base_url() . 'tiny_mce_popup.js'),true);
$PAGE->requires->js(new moodle_url($plugin->get_tinymce_file_url. 'js/poodll.js'),true);
echo $OUTPUT->header();
?>


<div style="text-align: center;">
<?php

echo $recorderhtml;

?>
</div>
<form>
   <div>
      <input id="<?php echo $updatecontrol; ?>" type="hidden" name="<?php echo $updatecontrol; ?>" />
      <input type="hidden" name="contextid" value= "<?php echo $usercontextid;?>" id="context_id" />
      <input type="hidden" name= "wwwroot" value="<?php echo $CFG->wwwroot;?>" id="wwwroot" />
      <p id="messageAlert">After you have finished recording, press Insert.</p>
      <input type="button" id="insert" name="insert" value="{#insert}" onclick="tinymce_poodll_Dialog.insert('<?php echo $recorder; ?>','<?php echo $updatecontrol; ?>');" />  
      <input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
      <input type="hidden" name="action" value="download">
   </div>
</form>
<?php
echo $OUTPUT->footer();