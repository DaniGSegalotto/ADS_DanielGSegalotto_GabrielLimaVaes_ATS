function confirmDelete(id) {
    // Função JavaScript para confirmar e deletar o veículo
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
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

function infoVeiculo(id) {
    // Função JavaScript para exibir informações adicionais sobre o veículo
    Swal.fire({
        title: 'Informações do Veículo',
        text: `Informações detalhadas sobre o veículo com ID: ${id}`,
        icon: 'info',
        confirmButtonText: 'Fechar'
    });
}