$( "#olho" ).click(function() {
    let senha = document.getElementById("senha");
    
    senha.type == "password" ? senha.type = "text" : senha.type = "password";
    $(this).find("svg").hasClass("fa-eye-slash") ? $(this).find("svg").toggleClass('fa-eye-slash fa-eye') : $(this).find("svg").toggleClass('fa-eye fa-eye-slash');

});

