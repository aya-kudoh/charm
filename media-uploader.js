//カスタムフィールド　メディアアップローダー
// jQuery(document).ready(function($){
//     var custom_uploader;
//     $('.upload_button').click(function(e) {
//         e.preventDefault();
//         if (custom_uploader) {
//             custom_uploader.open();
//             return;
//         }
//         custom_uploader = wp.media({
//             title: 'Choose Image',
//             button: {
//                 text: 'Choose Image'
//             },
//             multiple: true
//         });
//         custom_uploader.on('select', function() {
//             var images = custom_uploader.state().get('selection');
//             images.each(function(file){
//                 $('#view').append('<img src="'+file.toJSON().url+'" />');
//             });
//         });
//         custom_uploader.open();
//     });
// });
