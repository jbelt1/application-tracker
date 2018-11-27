$("#register").on("click", function() {
    var username = $("#registerUsername").val();
    var password = $("#registerPassword").val();
    var verifyPassword = $("#verifyPassword").val();
    
    var invalidMessages = "";
    if (password != verifyPassword) {
        invalidMessages += "Passwords do not match.\n";
    }
    
    if (invalidMessages !== "") {
        $("#registerError").text(invalidMessages);
        return false;
    } else {
        return true;
    }
});