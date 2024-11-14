(function ($) {
    'use_strict';

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        console.log(data);
        $.ajax({
            url: 'controllers/oniontabs-editor.php',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function (url) {
                var image = $('<img>').attr('src', url);

                console.log(image);
                $('.summernote').summernote("insertNode", image[0]);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    $('.summernote').summernote({
        height: 300,
        callbacks: {
            onImageUpload: function (image) {
                //send = sendFile(files[0], editor, welEditable);
                uploadImage(image[0]);
                // console.log(send);
                //$summernote.summernote('insertNode', imgNode);
            }
        },
        toolbar: [
            ['action', ['findnreplace']],
            ['cleaner', ['cleaner']],
            ['style', ['style', 'addclass']],
            ['font', ['fontname', 'height', 'fontsize', 'caseConverter', 'bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture', 'video', 'table', 'link', 'hr']],
            ['view', ['fullscreen', 'codeview']],
        ],
        addclass: {
            debug: false,
            icon: '<i class="fa fa-copyright"></i>',
            classTags: ["bg-accent", "bg-primary", "p-1", "p-2", "p-3", "p-4", "p-5", "m-1", "m-2", "m-3", "m-4", "m-5", { title: "Mail-Button", value: "button button-primary" }, { title: "Primary-Button", value: "btn btn-success" }, "jumbotron", "lead", "img-rounded", "img-circle", "img-fluid", "btn", "btn btn-primary", "btn btn-danger", "text-muted", "text-primary", "text-warning", "text-danger", "text-success", "table-bordered", "table-responsive", "visible-sm", "hidden-xs", "hidden-md", "hidden-lg", "hidden-print"]
        },
        cleaner: {
            action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline: '<br>', // Summernote's default is to use '<p><br></p>'
            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
            icon: '<i class="fa fa-file-code"></i>',
            keepHtml: false, // Remove all Html formats
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>', '<i>', '<a>'], // If keepHtml is true, remove all tags except these
            keepClasses: false, // Remove Classes
            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
            badAttributes: ['style', 'start'], // Remove attributes from remaining tags
            limitChars: false, // 0/false|# 0/false disables option
            limitDisplay: 'both', // text|html|both
            limitStop: false // true/false
        }
    });
    /************************************/
    //inline-editor
    /************************************/
    $('.inline-editor').summernote({
        airMode: true
    });

    /************************************/
    //edit and save mode
    /************************************/
    window.edit = function () {
        $(".click2edit").summernote()
    },
        window.save = function () {
            $(".click2edit").summernote('destroy');
        }

    var edit = function () {
        $('.click2edit').summernote({
            focus: true
        });
    };

    var save = function () {
        var markup = $('.click2edit').summernote('code');
        $('.click2edit').summernote('destroy');
    };

    /************************************/
    //airmode editor
    /************************************/
    $('.airmode-summer').summernote({
        airMode: true
    });
})(jQuery);