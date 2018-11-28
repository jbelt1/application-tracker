$(document).ready(()=>{
    $(".application-top").click(function() {
        $(this).next().slideToggle("fast");
    });

    $("#avatar").click(function() {
        $("#profile-edit").slideToggle("fast");
    })
})