// window.addEventListener('DOMContentLoaded', event => {

//     // Toggle the side navigation
//     const sidebarToggle = document.body.querySelector('#sidebarToggle');
//     if (sidebarToggle) {
//         // Uncomment Below to persist sidebar toggle between refreshes
//         // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
//         //     document.body.classList.toggle('sb-sidenav-toggled');
//         // }
//         sidebarToggle.addEventListener('click', event => {
//             event.preventDefault();
//             document.body.classList.toggle('sb-sidenav-toggled');
//             localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
//         });
//     }
// });

// let usuarios = [];

// $( "#olho" ).click(function() {
//     let senha = document.getElementById("senha");
    
//     senha.type == "password" ? senha.type = "text" : senha.type = "password";
//     $(this).find("svg").hasClass("fa-eye") ? $(this).find("svg").toggleClass('fa-eye fa-eye-slash') : $(this).find("svg").toggleClass('fa-eye-slash fa-eye');
// });

// $( "#olhoConfirmacao" ).click(function() {
//     let senha = document.getElementById("confirmSenha");
    
//     senha.type == "password" ? senha.type = "text" : senha.type = "password";
//     $(this).find("svg").hasClass("fa-eye") ? $(this).find("svg").toggleClass('fa-eye fa-eye-slash') : $(this).find("svg").toggleClass('fa-eye-slash fa-eye');
// });

$("#criarUsuario").on("submit",function(e){
    e.preventDefault();

    nome = $('#nome').val();
    senha =  $('#senha').val();
    confirmacaoSenha =  $('#confirmSenha').val();
    usuario =  $('#usuario').val();

    console.log(nome);
    console.log(senha);
    console.log(confirmacaoSenha);
    console.log(usuario);

    if ($('#nome').hasClass('is-invalid')) {
        $('#nome').focus();
    } else if ($('#usuario').hasClass('is-invalid')) {
        $('#usuario').focus();
    } else if (!senha) {
        Swal.fire({
            title: 'Erro ao criar o usu??rio!',
            text:'Voc?? n??o inseriu a senha do usu??rio!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if (!confirmacaoSenha){
        Swal.fire({
            title: 'Erro ao criar o usu??rio!',
            text:'Voc?? n??o inseriu a confirma????o da senha do usu??rio!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if (senha != confirmacaoSenha) {
        Swal.fire({
            title: 'Erro ao criar o usu??rio!',
            text:'As senhas inseridas s??o diferentes!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else {
        $.ajax({
            type: 'POST',
            dataType: "JSON",
            async: false,
            url: "/newUser_ajax.php?case=criarUsuario",
            data: {
                nome,
                senha,
                confirmacaoSenha,
                usuario
            },
            success: function(d) {
                if (d == 'error'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'N??o foi poss??vel cadastrar o usu??rio, tente novamente mais tarde!',
                        confirmButtonText: 'Ok',
                        showConfirmButton: true
                      });
                } else {
                    Swal.fire(
                        'Sucesso!',
                        'Usu??rio cadastrado com sucesso!',
                        'success'
                    ).then((resultp) => {
                        if (resultp.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }
            }, error: function(d) {
                    Swal.fire({
                        title: 'Erro ao enviar sua mensagem!',
                        text: 'Por favor, tente novamente mais tarde!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
            }
        });
    }
  });

    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            dataType: "JSON",
            async: false,
            url: "ajax/admin_ajax.php?case=buscarUsuarios",
            success: function(d) {
    
                 usuarios = d;

            }, error: function(d) {
                    Swal.fire({
                        title: 'Erro ao carregar os usu??rios!',
                        text: 'N??o ?? poss??vel criar um usu??rio no momento!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
            }
        })
    });

    $("#usuario").blur(function() {
        let validacaoUsuario = $('#usuario').val();

        $('#usuario').removeClass('is-invalid is-valid');

        let resultadoValidacao = usuarios.find(element => element[0] == validacaoUsuario);

        resultadoValidacao || validacaoUsuario == "" ? $('#usuario').addClass('is-invalid') : $('#usuario').addClass('is-valid');
        
      });

    $("#nome").blur(function() {
        let validacaoNome = $('#nome').val();
        let validacaoNomeUpperCase = validacaoNome.toUpperCase();

        console.log(validacaoNomeUpperCase);

        $('#nome').removeClass('is-invalid is-valid');

        let resultadoValidacao = usuarios.find(element => element[1] == validacaoNomeUpperCase);

        console.log(resultadoValidacao);

        resultadoValidacao || validacaoNomeUpperCase == "" ? $('#nome').addClass('is-invalid') : $('#nome').addClass('is-valid');
        
    });



// function adicionarUsuario () {
//     nome = $('#nome').val();
//     senha =  $('#senha').val();
//     confirmacaoSenha =  $('#confirmSenha').val();
//     usuario =  $('#usuario').val();

//     if (!nome) {
//         Swal.fire({
//             title: 'Erro ao criar o usu??rio!',
//             text:'Voc?? n??o inseriu o nome completo do usu??rio!',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         })
//     } else if (!usuario) {
//         Swal.fire({
//             title: 'Erro ao criar o usu??rio!',
//             text:'Voc?? n??o inseriu o usu??rio!',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         })
//     } else if (!senha) {
//         Swal.fire({
//             title: 'Erro ao criar o usu??rio!',
//             text:'Voc?? n??o inseriu a senha do usu??rio!',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         })
//     } else if (!confirmacaoSenha){
//         Swal.fire({
//             title: 'Erro ao criar o usu??rio!',
//             text:'Voc?? n??o inseriu a confirma????o da senha do usu??rio!',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         })
//     } else if (senha != confirmacaoSenha) {
//         Swal.fire({
//             title: 'Erro ao criar o usu??rio!',
//             text:'As senhas inseridas s??o diferentes!',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         })
//     } else {
//         $.ajax({
//             type: 'POST',
//             dataType: "JSON",
//             async: false,
//             url: "ajax/admin_ajax.php?case=criarUsuario",
//             data: {
//                 nome,
//                 senha,
//                 confirmacaoSenha,
//                 usuario
//             },
//             success: function(d) {
//                 if (d == 'error'){
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Erro!',
//                         text: 'N??o foi poss??vel enviar sua mensagem, tente novamente mais tarde!',
//                         confirmButtonText: 'Ok',
//                         showConfirmButton: true
//                       });
//                 } else {
//                     Swal.fire(
//                         'Sucesso!',
//                         'Usu??rio cadastrado com sucesso!',
//                         'success'
//                     ).then((resultp) => {
//                         if (resultp.isConfirmed) {
//                             window.location.reload();
//                         }
//                     })
//                 }
//             }, error: function(d) {
//                     Swal.fire({
//                         title: 'Erro ao enviar sua mensagem!',
//                         text: 'Por favor, tente novamente mais tarde!',
//                         icon: 'error',
//                         confirmButtonText: 'Ok'
//                     });
//             }
//         });
//     }
// }