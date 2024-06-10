function deletarMarca(id) {
  // Função JavaScript para confirmar e deletar a marca
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

function infoMarca(id) {
  // Função JavaScript para exibir informações adicionais sobre a marca
  Swal.fire({
      title: 'Informações da Marca',
      text: `Informações detalhadas sobre a marca com ID: ${id}`,
      icon: 'info',
      confirmButtonText: 'Fechar'
  });
}