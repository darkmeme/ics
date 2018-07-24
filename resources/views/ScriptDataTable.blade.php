<script type="text/javascript">
        
 
function estiloTabla(id){

$(document).ready(function() {

var table = $(id).DataTable({
  "aaSorting": [[ 0, "desc" ]],
});

new $.fn.dataTable.Buttons( table, {
    buttons: [
      {
        "extend": "pdf",
        "titleAttr": 'Exportar a PDF',
        "messageTop": 'Reporte de listado de tarjetas.',
        "filename": 'Reporte de tarjetas',
        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "orientation": 'landscape',
            "  pageSize": 'Letter',
        "exportOptions": {
                  "columns": ':visible'
              }
      },
      {
        "extend": "copy",
        "titleAttr": 'Copiar a Porta Papeles',
        "text": "<i class='fa fa-copy bigger-110 pink'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                  "columns": ':visible'
              }
      },
      {
        "extend": "excel",
        "titleAttr": 'Exportar a Excel',
        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                  "columns": ':visible'
              }
      },
      {
        "extend": 'print',
        "titleAttr": 'Imprimir Documento',
        "text": "<i class='fa fa-print bigger-110 grey'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                  "columns": ':visible'
              }
      }
       ]
} );

table.buttons().container()
    .appendTo( $('.col-sm-6 :eq(0)', table.table().container() ) );
} );

} //fin de la funcion principal

</script>