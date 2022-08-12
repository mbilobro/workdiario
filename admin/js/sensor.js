window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

$("#infoSensor").on("submit",function(e){
    e.preventDefault();

    nomeSensor = $('#nomeSensor').val();

    if (!nomeSensor || nomeSensor == '') {
        Swal.fire({
            title: 'Erro!',
            text:'O nome do sensor é vazio!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else {
        $.ajax({
            type: 'POST',
            dataType: "JSON",
            async: false,
            url: "ajax/admin_ajax.php?case=alterarInfoSensor",
            data: {
                nomeSensor,
            },
            success: function(d) {
                if (d != true){
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Não foi atualizar as informações!',
                        confirmButtonText: 'Ok',
                        showConfirmButton: true
                      });
                } else {
                    Swal.fire(
                        'Sucesso!',
                        'Informações alteradas com sucesso!',
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
            url: "ajax/admin_ajax.php?case=buscarNomeSensor",
            success: function(d) {
    
                 nomeSensor = d['nomeSensor'];

                 $('#nomeSensor').val(nomeSensor);

            }, error: function(d) {
                    Swal.fire({
                        title: 'Erro ao carregar os usuários!',
                        text: 'Não é possível criar um usuário no momento!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
            }
        })
    });