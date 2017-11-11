<?php
	function fill_time_lapse(){
		$fechas_venta = select("select fecha from venta group by fecha");


		for($i=0;$i<sizeof($fechas_venta);$i++){
			echo('	<article class="timeline-item alt">
	                    <div class="text-right">
	                        <div class="time-show first">
	                            <a href="#" class="btn btn-custom">'.array_values($fechas_venta[$i])[0].'</a>
	                        </div>
	                    </div>
	                </article>');
			
			$ventas_dia=select("select id, total, id_usuario from venta where fecha='".array_values($fechas_venta[$i])[0]."'");
			for($j=0;$j<sizeof($ventas_dia);$j++){
				if($j%2==0){
					echo('<article class="timeline-item alt">');
					echo('<div class="timeline-desk">
	                            <div class="panel">
	                                <div class="timeline-box">
	                                    <span class="arrow-alt"></span>
	                                    <span class="timeline-icon"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
	                                    <h4 class="">$'.array_values($ventas_dia[$j])[1].'</h4>
	                                    <p class="timeline-date text-muted"><small> Con el ID: '.array_values($ventas_dia[$j])[0].'</small></p>
	                                    <p>Se llevaron '.array_values(select("select sum(cantidad) from venta_producto where id_venta=".array_values($ventas_dia[$j])[0]."")[0])[0].' productos en la venta.</p>
	                                </div>
	                            </div>
	                        </div>
	                    </article>');
				}else{
					echo('<article class="timeline-item">');
					echo('<div class="timeline-desk">
	                            <div class="panel">
	                                <div class="timeline-box">
	                                    <span class="arrow-alt"></span>
	                                    <span class="timeline-icon"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
	                                    <h4 class="">$'.array_values($ventas_dia[$j])[1].'</h4>
	                                    <p class="timeline-date text-muted"><small> Con el ID: '.array_values($ventas_dia[$j])[0].'</small></p>
	                                    <p>Se llevaron '.array_values(select("select sum(cantidad) from venta_producto where id_venta=".array_values($ventas_dia[$j])[0]."")[0])[0].' productos en la venta.</p>
	                                </div>
	                            </div>
	                        </div>
	                    </article>');
				}
			}
		}
	}
?>