/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.language = 'ru';
	config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
	config.protectedSource.push(/<(style)[^>]>.<\/style>/ig);
	config.protectedSource.push(/<(script)[^>]>.<\/script>/ig);// разрешить теги <script>
	config.protectedSource.push(/<(i)[^>]>.<\/i>/ig);// разрешить теги <i>
	config.protectedSource.push(/<\?[\s\S]?\?>/g);// разрешить php-код
	config.protectedSource.push(/<!--dev-->[\s\S]<!--\/dev-->/g);
	config.allowedContent = true; / all tags /
};
