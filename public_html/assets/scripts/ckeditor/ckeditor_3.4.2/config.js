/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.skin = 'BootstrapCK-Skin';
        
        //config.toolbar = 'Full';
 
        //config.toolbar = 'simple';

	config.toolbar_Simple =
	[
            //['Source','-','Save','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo','Link','Unlink','Anchor', 'NumberedList','BulletedList','Outdent','Indent','Blockquote','Bold','Italic','Underline','Strike'],
            //['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
           
            '/',
            //['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],,
            ['Format','Font','FontSize','Styles'],
            //['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            //['Link','Unlink','Anchor'],
            //['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
            '/',
            //['Styles','Format','Font','FontSize'],
            //[,],
            //['Maximize', 'ShowBlocks','-','About']
	];
      
};