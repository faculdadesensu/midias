// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    responsive: true,
    ordering: false,
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ Registros",
      zeroRecords: "Nenhum registro encontrado",
      info: "Mostrar _PAGE_ de _PAGES_ de _TOTAL_ Registros",
      infoEmpty: "Nenhum registro disponível",
      infoFiltered: "(filtrando de _MAX_ resultados)",
      loadingRecords: "Carregando...",
      processing: "Processando...",
      paginate: {
        next: "Próxima",
        previous: "Anterior"
      },
    }
  });
});
