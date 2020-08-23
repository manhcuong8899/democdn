function ckeditor (name) {
    var editor = CKEDITOR.replace(name ,{
        language:'vi',
        filebrowserImageBrowseUrl : baseURL+'/plugins/editor/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : baseURL+'/plugins/editor/ckfinder/ckfinder.html?Type=Flash',
        filebrowserImageUploadUrl : baseURL+'/plugins/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : baseURL+'/plugins/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        height: '250px',
        });
}