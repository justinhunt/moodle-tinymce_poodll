/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	tinymce.create('tinymce.plugins.poodllPlugin', {
		init : function(ed, url) {
			this.editor = ed;

			// Register commands
			ed.addCommand('mcepoodll', function() {

				ed.windowManager.open({
					file : url + '/poodll.htm',
					width : 480,
					height : 400 ,
					inline : 1
				}, {
					plugin_url : url
				});
			});

			// Register buttons
			ed.addButton('poodll', {
				title : 'poodll.desc',
				cmd : 'mcepoodll',
				image: url + '/img/icon.png'
			});
			//you could add a shortcut here
			//ed.addShortcut('ctrl+k', 'poodll.poodll_desc', 'mcepoodll');

		
		},

		getInfo : function() {
			return {
				longname : 'PoodLL Anywhere',
				author : 'Justin Hunt',
				version : '1.0.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('poodll', tinymce.plugins.poodllPlugin);
})();