(function($){
  var mediaUploadImage = $('#chi-media-upload-image');
  $('.my-color-field').wpColorPicker();
  $('.upload-button').on('click',function(e){
    wp.media.editor.open();
    var button = $(this);
    var id = jQuery(this).prev('input');
    wp.media.editor.send.attachment = function(props, attachement){
      var size = props.size;
      var att = attachement.sizes[size];
      $(id).val(att.url);
      mediaUploadImage.attr('src',att.url);
    };
  });
})(jQuery);
