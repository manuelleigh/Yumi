<?php Session::init(); if (Session::get('rol') == 1 OR Session::get('rol') == 2 OR Session::get('rol') == 3) { ?>
<?php
date_default_timezone_set($_SESSION["zona_horaria"]);
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$fecha = date("d-m-Y");
$fechaa = date("m-Y");
?>
<input type="hidden" id="moneda" value="<?php echo Session::get('moneda'); ?>"/>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h4 class="m-b-0 m-t-0">Inventario</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL; ?>inventario/stock" class="link">Inicio</a></li>
            <li class="breadcrumb-item active">Stock</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-b-0">
                <div class="message-box contact-box">
                    <h2 class="add-ct-btn">
                    <div class="ml-auto">
                            <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="" href="javascript:void();" id="excel"></a>
                                    <a class="" href="javascript:void();" id="pdf"></a>
                                    <a href="javascript:void();" id="downticket" tabindex="0" aria-controls="table" class="dropdown-item p-t-0 p-b-0" title="Descargar Pdf"><span><i class="fas fa-file-pdf"></i> Descargar en Ticket</span></a>
                                </div>
                            </div>
                        </div>
                    </h2> <br>
                </div>
            </div>
            <div class="card-body p-b-0 p-r-0 p-t-0">
                <div class="row floating-labels m-t-5">
                    <div class="col-lg-4">
                        <div class="form-group m-b-40">
                            <div class="input-group">
                                <input type="text" class="form-control font-14 text-center" name="start" id="start" value="<?php echo '01-'.$fechaa; ?>" autocomplete="off"/>
                                <span class="input-group-text bg-gris">al</span>
                                <input type="text" class="form-control font-14 text-center" name="end" id="end" value="<?php echo $fecha; ?>" autocomplete="off"/>
                            </div>
                            <label>Rango de fechas</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group m-b-40">
                            <select class="selectpicker form-control" name="filtro_tipo_ins" id="filtro_tipo_ins" data-style="form-control btn-default" data-live-search="true" autocomplete="off" data-size="5">
                                <option value="%" active>Mostrar Todo</option>
                                <optgroup>
                                    <option value="1">INSUMO</option>
                                    <option value="2">PRODUCTO</option>
                                </optgroup>
                            </select>
                            <span class="bar"></span>
                            <label for="filtro_tipo_ins">Tipo</label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group m-t-20">
                            <input type="checkbox" name="filtro_stock_minimo" id="filtro_stock_minimo" value="%" class="chk-col-red" />
                            <label for="filtro_stock_minimo">Ver solo por debajo del stock mínimo</label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group m-b-10">
                            <input type="text" class="form-control global_filter" id="global_filter" autocomplete="off">
                            <span class="bar"></span>
                            <label for="global_filter">B&uacute;squeda</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive b-t m-b-10">
                <table id="table" class="table table-hover table-condensed stylish-table" width="100%">
                        <thead class="table-head">
                            <tr>
                                <th>Tipo</th>
                                <th>Codigo</th>
                                <th>Categor&iacute;a</th>
                                <th>Nombre</th>
                                <th>U. Medida</th>
                                <th class="text-right">Stock Inicial</th>
                                <th class="text-right">Entradas</th>
                                <th class="text-right">Cant. Compradas</th>
                                <th class="text-right">Salidas</th>
                                <th class="text-right">Cant. Vendidas</th>
                                <th class="text-right">Stock m&iacute;nimo</th>
                                <th class="text-right">Stock Actual</th>
                                <th class="text-right">Stock Real</th>
                            </tr>
                        </thead>
                        <tbody class="tb-st"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>