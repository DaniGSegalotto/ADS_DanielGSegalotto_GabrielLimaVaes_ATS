function deletarAgendamento(id) {
    // Função JavaScript para confirmar e deletar o agendamento
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-${id}`).submit();
        }
    });
}
function infoAgendamento(id) {
    // Função JavaScript para exibir informações adicionais sobre o agendamento
    Swal.fire({
        title: 'Informações do Agendamento',
        text: `Informações detalhadas sobre o agendamento com ID: ${id}`,
        icon: 'info',
        confirmButtonText: 'Fechar'
    });
}