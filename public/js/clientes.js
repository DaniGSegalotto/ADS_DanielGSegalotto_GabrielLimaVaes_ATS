function deletarCliente(id) {
  // Função JavaScript para confirmar e deletar o cliente
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

function infoCliente(id) {
  // Função JavaScript para exibir informações adicionais sobre o cliente
  Swal.fire({
      title: 'Informações do Cliente',
      text: `Informações detalhadas sobre o cliente com ID: ${id}`,
      icon: 'info',
      confirmButtonText: 'Fechar'
  });
}