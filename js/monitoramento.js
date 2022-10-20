var urlAtual = window.location.href;

function obterDados() {

    $.ajax({
        url: `${urlAtual}lib/app.php`,
        type: "GET",
        data: {
            action: 'obterDados'
        },
        success: function (data) {
            adicionarCartao(data)
            removerAvisoDeConfiguracao()
        },
        error: function () {
            adicionarAvisoDeConfiguracao()
        },
        complete: function () {
            setTimeout(obterDados, 10000)
            $('#load').hide()
        }
    });
}

obterDados();

function adicionarCartao(data) {

    if ($('.cartao').length) {
        $('.cartao').remove()
    }
    for (let i in data) {
        $('#cartoes').append(`
        <div class="cartao cartao-${data[i].status}">
            <div class='nome'>${data[i].nome}</div>
            <p class='agente'>
            <img class='px-1' src="./img/user.png" height=20 alt="${data[i].agente} foto">${data[i].agente}
            </p>
            <span class="icone-${data[i].status} icone-posicao"></span>
        </div>`)
    }
}

function adicionarAvisoDeConfiguracao() {
    $('#text-config').text('Configure o banco de dados')
}
function removerAvisoDeConfiguracao(){
    $('#text-config').empty()
}
