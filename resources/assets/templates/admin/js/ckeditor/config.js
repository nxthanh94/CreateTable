/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'vi';
	// config.uiColor = '#AADC6E';
	// config.extraPlugins = 'lineutils, dialogui, dialog, widget, image2';
	config.filebrowserBrowseUrl = baseURL+'/resources/assets/templates/admin/js/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = baseURL+'/resources/assets/templates/admin/js/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = baseURL+'/resources/assets/templates/admin/js/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserImageUploadUrl = baseURL+'/resources/assets/templates/admin/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = baseURL+'/resources/assets/templates/admin/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
