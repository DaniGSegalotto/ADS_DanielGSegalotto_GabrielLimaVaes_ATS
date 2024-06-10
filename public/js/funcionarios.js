function deletarFuncionario(id) {
  // Função JavaScript para confirmar e deletar o funcionário
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

function infoFuncionario(id) {
  // Função JavaScript para exibir informações adicionais sobre o funcionário
  Swal.fire({
      title: 'Informações do Funcionário',
      text: `Informações detalhadas sobre o funcionário com ID: ${id}`,
      icon: 'info',
      confirmButtonText: 'Fechar'
  });
}