'use strict';
/*eslint-disable new-cap, no-unused-vars, 
	no-use-before-define, no-trailing-spaces, 
	no-mixed-spaces-and-tabs, no-multi-spaces, camelcase, no-loop-func,
	key-spacing */
/*global  $, */
$(document).on('ready', function() {
    $('#input-24').fileinput({
        overwriteInitial: false,
        maxFileSize: 200000,
        initialCaption: '選擇影片'
    });
});

