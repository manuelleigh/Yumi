$(function() {
    moment.locale('es');
    $('#start').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY',
        time: false,
        lang: 'es-do',
        cancelText: 'Cancelar',
        okText: 'Aceptar'
    });
    $('#end').bootstrapMaterialDatePicker({
        useCurrent: false,
        format: 'DD-MM-YYYY',
        time: false,
        lang: 'es-do',
        cancelText: 'Cancelar',
        okText: 'Aceptar'
    });
    listar();
    $('#inventario').addClass("active");
    $('#i-stock').addClass("active");

    /* BOTON DATATABLES */
    var org_buildButton = $.fn.DataTable.Buttons.prototype._buildButton;
    $.fn.DataTable.Buttons.prototype._buildButton = function(config, collectionButton) {
    var button = org_buildButton.apply(this, arguments);
    $(document).one('init.dt', function(e, settings, json) {
        if (config.container && $(config.container).length) {
           $(button.inserter[0]).detach().appendTo(config.container)
        }
    })    
    return button;
    }
});

$('#start, #end, #filtro_tipo_ins').change( function() {
    listar();
});

var listar = function(){
    function filterGlobal () {
        $('#table').DataTable().search( 
            $('#global_filter').val()
        ).draw();
    }

    var stock_min = 0,
        stock_inicial = 0,
        stock_actual = 0,
        stock_real = 0,
        table =	$('#table')
        .DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel', sheetName: 'Fechas ' +  $('#start').val() + ' al ' + $('#end').val(), title: 'Inventario de insumos y productos desde el ' +  $('#start').val() + ' al ' + $('#end').val(), className: 'dropdown-item p-t-0 p-b-0', text: '<i class="fas fa-file-excel"></i> Descargar en excel', titleAttr: 'Descargar Excel',                    
                    container: '#excel', exportOptions: { columns: [0,1,2,3,4,5,6,7,8,9] }
                },
                {
                    extend: 'pdf', title: 'Inventario de insumos y productos desde el ' +  $('#start').val() + ' al ' + $('#end').val(), className: 'dropdown-item p-t-0 p-b-0', text: '<i class="fas fa-file-pdf"></i> Descargar en pdf', titleAttr: 'Descargar Pdf',
                    container: '#pdf', exportOptions: { columns: [0,1,2,3,4,5,6,7,8,9] }, orientation: 'landscape', 
                    customize : function(doc){ 
                        doc.styles.tableHeader.alignment = 'left'; 
                        doc.content[1].table.widths = [60,'*','*','*','*','*','*','*','*','*','*'];
                    }
                }
            ],
            "destroy": true,
            "responsive": true,
            "dom": "tip",
            "bSort":false,
    		"ajax":{
        		"method": "POST",
        		"url": $('#url').val()+"inventario/stock_list",
                "data": {
                    finicio: $('#start').val(),
                    ffin: $('#end').val(),
                    tipo_ins: $('#filtro_tipo_ins').val(),
                    stock_min: $("input[name='filtro_stock_minimo']").val()
                }
    		},
            "columns":[
                {
                    "data": null,
                    "render": function ( data, type, row) {
                        if(data.id_tipo_ins == 1){
                            return '<span class="label label-warning">INSUMO</span>';
                        } else if(data.id_tipo_ins == 2){
                            return '<span class="label label-success">PRODUCTO</span>';
                        }
                        else if(data.id_tipo_ins == 3){
                            return '<span class="label label-success">PRODUCTO</span>';
                        }
                    }
                },
                {"data": "Producto.ins_cod"},
                {"data": "Producto.ins_cat"},
                {"data": "Producto.ins_nom"},
                {"data": "Producto.ins_med"},
                {"data": null,"render": function ( data, type, row ) {
                    ingresos_si = data.Ingresos_SI.ingresos - 0;
                    comprados_si = data.Comprados_SI.comprados - 0;
                    salidas_si = data.Salidas_SI.salidas - 0;
                    vendidos_si = data.Vendidos_SI.vendidos - 0;

                    stock_inicial = (ingresos_si + comprados_si) - (salidas_si + vendidos_si);
                    return '<div class="text-success text-right">'+stock_inicial.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    ingresos = data.Ingresos.ingresos - 0;
                    return '<div class="text-right">'+ingresos.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    comprados = data.Comprados.comprados - 0;
                    return '<div class="text-right">'+comprados.toFixed(4)+'</div>';
                }},                
                {"data": null,"render": function ( data, type, row ) {
                    salidas = data.Salidas.salidas - 0;
                    return '<div class="text-right">'+salidas.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    vendidos = data.Vendidos.vendidos - 0;
                    return '<div class="text-right">'+vendidos.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    stock_min = data.Producto.ins_sto - 0;
                    return '<div class="text-warning text-right">'+stock_min.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    ingresos = data.Ingresos.ingresos - 0;
                    comprados = data.Comprados.comprados - 0;
                    salidas = data.Salidas.salidas - 0;
                    vendidos = data.Vendidos.vendidos - 0;

                    stock_actual = (ingresos + comprados) - (salidas + vendidos);
                    return '<div class="text-success text-right">'+stock_actual.toFixed(4)+'</div>';
                }},
                {"data": null,"render": function ( data, type, row ) {
                    stock_real = stock_inicial + stock_actual;
                    return '<div class="text-success text-right">'+stock_real.toFixed(4)+'</div>';
                }}                
            ]
	});

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    });
};

$('#filtro_stock_minimo').on('click', function(event){
    if( $(this).is(':checked') ) {
        $('#filtro_stock_minimo').val('0');
        listar();
    } else {
        $('#filtro_stock_minimo').val('%');
        listar();
    }
});
$('#downticket').on('click', function(event){
    window.open($('#url').val()+"inventario/impresion_stock?tipo_ins="+$('#filtro_tipo_ins').val()+"&stock_min="+$('#filtro_stock_minimo').val(),'_blank');
});