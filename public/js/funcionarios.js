function deletarFuncionarios (id) {
    Swal.fire({
        title: "Você tem certeza?",
        text: "Você não poderá reverter isso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, delete!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deletado!",
            text: "O funcionário foi deletado.",
            icon: "success"
          });
          document.getElementById('form-' + id).submit();
        }
      });
    }
    