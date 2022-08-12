const colorsBrown = [
    "#69503c",
    "#735945",
    "#7e634e",
    "#907761",
];

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

$(document).ready(function() {
    
    $.ajax({
        type: 'POST',
        dataType: "JSON",
        async: false,
        url: "ajax/admin_ajax.php?case=buscarInformacoes",
        success: function(d) {

            if (d['totalLeiturasUmidade'] < 1) {
                //Adicionar valores as divs quando o banco está sem dados
                $('#card-number-readings').text('0');
                

                $('#divLeituraAtual').append(
                    '<h5> Nenhum registro encontrado </h5>'
                );

                $('#divLeituras').append(
                    '<h5> Nenhum registro encontrado </h5>'
                );
            }

            if (d['totalRegas'] < 1) {
                $('#card-number-watering').text('0');

                $('#divRegas').append(
                    '<h5> Nenhum registro encontrado </h5>'
                );
            }
            if (d['totalRegas'] >= 1 && d['totalLeiturasUmidade'] >= 1) {

                $('#card-number-readings').text(d['totalLeiturasUmidade']);
                $('#card-number-watering').text(d['totalRegas']);

                graficoLeituraRecente(d['leituras']);

                graficoLeituras(d['leituras']);

                graficoRegas(d['regas']);

            }

        }, error: function(d) {
                Swal.fire({
                    title: 'Erro ao carregar a demanda!',
                    text: 'Por favor, tente novamente mais tarde!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
        }
    })
});

function graficoLeituraRecente (dados) {

    umidade = [];
    label = [];

    leituraRecente = dados[dados.length - 1];

    dataFormatada = dateFormatBr(leituraRecente[2]);

    $('#last-reading').text('Leitura mais recente - Atualizada em: ' + dataFormatada);

    umidade.push(leituraRecente[1]);
    label.push("Umidade em porcentagem");

    var data = {
        labels: label,
        datasets: [
            {
            data: umidade,
            backgroundColor: colorsBrown,
            }
        ]
    };

    var config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
        };

        // Instanciação do novo Gráfico, passando o ID do Canvas do HTML
        let graficoLeituraRecente = new Chart(
            document.getElementById('leituraAtual'),
            config
        );

}

function graficoLeituras (dados) {
    var labels = [];
    var umidade = [];

    dados.forEach(element => {
        // Criar arrays parem serem consumidos pelos gráficos
        labels.push(element[2].slice(11));
        umidade.push(element[1]);
    });

    var data = {
        labels: labels,
        datasets: [
            {
            label: "Umidade em porcentagem",
            data: umidade,
            backgroundColor: "#69503c",
            lineTension: 0.3,
            borderColor: "#69503c",
            pointRadius: 5,
            pointBackgroundColor: "#69503c",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#69503c",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            }
        ]
    };

        var config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
        };

        // Instanciação do novo Gráfico, passando o ID do Canvas do HTML
        let graficoLeituras = new Chart(
            document.getElementById('leiturasHoje'),
            config
        );
}

function graficoRegas (dados) {
    var labels = [];
    var regas = [];

    dados.forEach(element => {

        // Criar arrays parem serem consumidos pelos gráficos
        labels.push(element[1].slice(11));
        regas.push(1);
    });

    var data = {
        labels: labels,
        datasets: [
            {
            label: "Regas",
            data: regas,
            backgroundColor: "#69503c",
            lineTension: 0.3,
            borderColor: "#69503c",
            pointRadius: 5,
            pointBackgroundColor: "#69503c",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#69503c",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            }
        ]
    };

        var config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
        };

        // Instanciação do novo Gráfico, passando o ID do Canvas do HTML
        let graficoRegas = new Chart(
            document.getElementById('regasHoje'),
            config
        );
}

function dateFormatBr (date) {
    ano = date.slice(0,4);
    mes = date.slice(5,7);
    dia = date.slice(8,10);

    hora = date.slice(11);

    return dia + "/" + mes + "/" + ano + " " + hora;
   
}