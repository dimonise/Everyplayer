$(function(){
	$( 'textarea.texteditor' ).ckeditor({toolbar:'Full',
    filebrowserBrowseUrl:'/js/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl:'/js/ckfinder/ckfinder.html?Type=Images',
filebrowserImageUploadUrl:'/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
	$( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
});