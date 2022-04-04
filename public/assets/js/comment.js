$(document).ready(function(){
    $(document).on('click', '.submitComment', function(e){
        e.preventDefault();
        $.ajax({
            url: $('.commenting-form').attr('action'),
            type: $('.commenting-form').attr('method'),
            data: $('.commenting-form').serialize(),
            success: function(data){
                $(".none-comment").remove(); 
                $('.post-comments').append(data);
            }
        })
        $('.commenting-form')[0].reset();
        // $count = $(".post-comments > .comment").length;
    });

    let comment = $('.comment').length;
    if(comment > 5){
        $('.comment:gt(4)').hide();
        $('.hideComment').hide();
    }
    let commentShow = 4;

    $(document).on('click', '.showMoreComment', function(e){
        $('.comment').show();
        const countComment = $(this).attr('data-value');
        commentShow += 5;
        $('.comment:gt(' + commentShow + ')').hide();
        if(commentShow >= countComment-1){
            $(this).hide();
            $('.hideComment').show();
        }
    });

    $(document).on('click', '.hideComment', function(e){
        $('.comment').show();
        $('.comment:gt(4)').hide();
        $('.showMoreComment').show();
        $(this).hide();
        commentShow = 4;
    });
});