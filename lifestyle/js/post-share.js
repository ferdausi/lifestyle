
jQuery(document).ready(function(){
    $(".bottom").hide();
    $(".top").on("click",function () {
        $(this).next().show();
        $(this).hide();

    });

});
