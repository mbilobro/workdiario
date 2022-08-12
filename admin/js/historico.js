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

$('#selectStatus').change(function () {
    let status = $('#selectStatus').val();

    if (status != undefined){
        $('#selectFiltroData').removeClass('bg-soft-disabled');
        $('#selectFiltroData').addClass('bg-soft');
        $('#selectFiltroData').prop('disabled', false);
    }
});

$('#selectFiltroData').change(function () {
    let dataFiltro = $('#selectFiltroData').val();
    let novaData = new Date;
    let anoAtual = novaData.getFullYear();

    if (dataFiltro === "Dia") {

        // Ocultar todos os outros filtros 
        $('#filtroMes').css('display', "none");
        $('#filtroMesAno').css('display', "none");
        $('#filtroAno').css('display', "none");
        $('#filtroPorPeriodoInicial').css('display', "none");
        $('#filtroPorPeriodoFinal').css('display', "none");

        // Mostrar o input de filtro por dia
        $('#filtroDia').css('display', "block");

    } else if (dataFiltro === "periodoDias") {

        // Ocultar todos os outros filtros 
        $('#filtroMes').css('display', "none");
        $('#filtroMesAno').css('display', "none");
        $('#filtroAno').css('display', "none");
        $('#filtroDia').css('display', "none");

        // Mostrar os inputs de filtro por período de dias
        $('#filtroPorPeriodoInicial').css('display', "block");
        $('#filtroPorPeriodoFinal').css('display', "block");
        

    } else if (dataFiltro === "Mes") {

        // Ocultar todos os outros filtros 
        $('#filtroDia').css('display', "none");
        $('#filtroAno').css('display', "none");
        $('#filtroPorPeriodoInicial').css('display', "none");
        $('#filtroPorPeriodoFinal').css('display', "none");

        // Mostrar o select e o input de filtro por mês
        $('#filtroMes').css('display', "block");
        $('#filtroMesAno').css('display', "block");

        // Adicionar ano atual ao input de ano
        $('#mesAno').val(anoAtual);


    } else if (dataFiltro === "Ano") {

        // Ocultar todos os outros filtros 
        $('#filtroDia').css('display', "none");
        $('#filtroPorPeriodoInicial').css('display', "none");
        $('#filtroPorPeriodoFinal').css('display', "none");
        $('#filtroMes').css('display', "none");
        $('#filtroMesAno').css('display', "none");

        // Mostrar o input de filtro por ano
        $('#filtroAno').css('display', "block");

        // Adicionar ano atual ao input de ano
        $('#ano').val(anoAtual);
    }
});

function buscarRegistros () {

    let filtroStatus = $('#selectStatus').val();
    let filtroData = $('#selectFiltroData').val();

    // Validar se foi selecionado alguma opção do filtro do status
    if (filtroStatus === null) {
        Swal.fire({
            title: 'Oops!',
            text: 'Por favor, selecione um status!',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    } else if (filtroData === null) {
        Swal.fire({
            title: 'Oops!',
            text: 'Por favor, selecione um filtro de data!',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    } else {
        let data = [];

        // Formatar e validar a data que será enviada ao backend de acordo com o filtro selecionado
        if (filtroData === "Dia") {
            dia = $('#dataFiltro').val();
            if (dia == ""){
                Swal.fire({
                    title: 'Oops!',
                    text: 'Por favor, digite uma data!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                data.push(dia);
                retornarDados(filtroStatus, data);
            }

        } else if (filtroData === "periodoDias") {
            dataInicial = $('#dataFiltroInicial').val();
            dataFinal = $('#dataFiltroFinal').val();

            if(dataInicial == "" || dataFinal == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Por favor, digite as duas datas corretamente!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else if (dataInicial >= dataFinal) {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Por favor, a data inicial deve ser menor do que a data final!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                data.push(dataInicial, dataFinal);
                retornarDados(filtroStatus, data)
            }

        } else if (filtroData === "Mes") {
            let filtroMesAno = $('#mesAno').val();
            let filtroMes = $('#mes').val();

            if (filtroMesAno == "" || filtroMes == null){
                Swal.fire({
                    title: 'Oops!',
                    text: 'Por favor, selecione um mês e digite o ano!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                data.push(filtroMesAno + "-" + filtroMes);
                retornarDados(filtroStatus, data);
            }

        } else if (filtroData === "Ano") {
            ano = $('#ano').val()

            if (ano == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Por favor, digite o ano!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                data.push(ano);
                retornarDados(filtroStatus, data);
            }
        }
    }
        
}

function retornarDataFormatada (data) {
    soData = data.split(' ')

    dataNew = soData[0].split('-');

    ano = dataNew[0];
    mes = dataNew[1];
    dia = dataNew[2];
    hora = soData[1];

    return dia + '/' + mes + '/' + ano + ' ' + hora;
}

function retornarDados (filtroStatus, data) {
    $.ajax({
        type: 'POST',
        dataType: "JSON",
        async: false,
        url: "ajax/admin_ajax.php?case=buscarPorFiltro",
        data: {
            filtroStatus,
            data
        },
        success: function(d) {

            if (d.length === 0) {

                Swal.fire({
                    title: 'Erro ao carregar as demandas!',
                    text: 'Nenhum registro foi encontrado!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });

            } else {

                $('#tableDemandas').empty();

                if (filtroStatus == 'Leituras de umidade') {

                    $('#tableDemandas').append(
                        '<table id="datatablesSimple" class="datatable"> ' +
                        ' <thead>' +
                        ' <tr> ' +
                                '<th style="text-align: center;">ID Umidade</th>' +
                                '<th style="text-align: center;">Umidade</th>' +
                                '<th style="text-align: center;">Data/Hora</th>' +
                                '<th style="text-align: center;">Nome sensor</th>' +
                                '<th style="text-align: center;">ID Sensor</th>' +
                            '</tr>' +
                        '</thead>' +
                        '<tbody>' +
    
                        '</tbody>' +
                        '</table>'
                    );
                        d.forEach(element => {
                                $('#datatablesSimple').append(
                                    '<tr>' +
                                        '<td id="tableIdUmidade">' +  element[0] + '</td>' +
                                        '<td id="tableUmidade">' +  element[1] + '</td>' +
                                        '<td id="tableDataHora">' +  retornarDataFormatada(element[2]) + '</td>' +
                                        '<td id="tableNomeSensor">' +  element[5] + '</td>' +
                                        '<td id="tableIdSensor">' +  element[3] + '</td>' +
                                        '</td>' +
                                    '</tr>' 
                                );
                        });
                } else if (filtroStatus == "Regas") {
                    $('#tableDemandas').append(
                        '<table id="datatablesSimple" class="datatable"> ' +
                        ' <thead>' +
                        ' <tr> ' +
                                '<th style="text-align: center;">ID Regas</th>' +
                                '<th style="text-align: center;">Data/Hora</th>' +
                                '<th style="text-align: center;">Nome sensor</th>' +
                                '<th style="text-align: center;">ID Sensor</th>' +
                            '</tr>' +
                        '</thead>' +
                        '<tbody>' +
    
                        '</tbody>' +
                        '</table>'
                    );
                        d.forEach(element => {
                                $('#datatablesSimple').append(
                                    '<tr>' +
                                        '<td id="tableIdRegas">' +  element[0] + '</td>' +
                                        '<td id="tableDataHora">' +  retornarDataFormatada(element[1]) + '</td>' +
                                        '<td id="tableNomeSensor">' +  element[4] + '</td>' +
                                        '<td id="tableIdSensor">' +  element[3] + '</td>' +
                                        '</td>' +
                                    '</tr>' 
                                );
                        });
                

                }

                    $('#datatablesSimple').DataTable({
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                        }
                    });
            }
            }, error: function(d) {
                Swal.fire({
                    title: 'Erro ao carregar a demanda!',
                    text: 'Por favor, tente novamente mais tarde!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
        }
    });
}

