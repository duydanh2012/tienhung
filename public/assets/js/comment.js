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
});