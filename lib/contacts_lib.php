<?php
function contacts_actual_info($id){
	$usr=select("select nombre,apellido_paterno, apellido_materno, fecha_nac, genero, email, telefono, biografia from usuario where id=".$id."");
	echo('<form enctype="multipart/form-data" action="profile.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

		<div class="form-group">
		<label for="userName">Nombre<span class="text-danger">*</span></label>
		<input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.array_values($usr[0])[0].'">
		</div>
		<div class="form-group">
		<label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
		<input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.array_values($usr[0])[1].'">
		</div>
		<div class="form-group">
		<label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
		<input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.array_values($usr[0])[2].'">
		</div>
		<div class="form-group">
		<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
		<div class="input-group">
		<input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.array_values($usr[0])[3].'">
		<span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
		</div>
		</div>
		<label>Genero<span class="text-danger">*</span></label>
		<div class="form-group">
		<div class="radio radio-info radio-inline">
		<input type="radio" id="inlineRadio1" value="M" name="usr_ge" checked="" ">
		<label for="inlineRadio1"> Masculino </label>
		</div>
		<div class="radio radio-danger radio-inline">
		<input type="radio" id="inlineRadio2" value="F" name="usr_ge">
		<label for="inlineRadio2"> Femenino </label>
		</div>
		</div>
		<hr>
		<div class="form-group" id="emg">
		<label for="usr_em">Email <span class="text-danger">*</span></label>
		<input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.array_values($usr[0])[5].'">
		</div>
		<div class="form-group" id="telf">
		<label for="usr_tel">Telefono <span class="text-danger">*</span></label>
		<input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel" value='.array_values($usr[0])[6].'">
		</div>
		<div class="form-group" id="summer">
		<label for="summernote">Biografia<span class="text-danger"></span></label>
		<fieldset>
		
		<p class="container">
		<textarea class="input-block-level" id="summernote" name="content" rows="2">
		</textarea>
		</p>
		</fieldset>
		
		</div>
		<hr>
		<div class="form-group text-right m-b-0">
		<button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
		<i class="mdi mdi-close"></i>Cancelar
		</button>
		<button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
		<i class="mdi mdi-check"></i>Guardar
		</button>
		</div>
		</form>');
}

function contacts_actual_infoback($id){
	echo('<form enctype="multipart/form-data" action="profile.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

		<div class="form-group">
		<label for="userName">Nombre<span class="text-danger">*</span></label>
		<input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.err_print('usr_nombre').'">
		</div>
		<div class="form-group">
		<label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
		<input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.err_print('usr_app').'">
		</div>
		<div class="form-group">
		<label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
		<input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.err_print('usr_apm').'">
		</div>
		<div class="form-group">
		<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
		<div class="input-group">
		<input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.err_print('usr_fn').'">
		<span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
		</div>
		</div>
		<label>Genero<span class="text-danger">*</span></label>
		<div class="form-group">
		<div class="radio radio-info radio-inline">
		<input type="radio" id="inlineRadio1" value="M" name="usr_ge" '.radio1().'>
		<label for="inlineRadio1"> Masculino </label>
		</div>
		<div class="radio radio-danger radio-inline">
		<input type="radio" id="inlineRadio2" value="F" name="usr_ge"'.radio2().'>
		<label for="inlineRadio2"> Femenino </label>
		</div>
		</div>
		<label>Fotografia<span class="text-danger"></span></label>
		<div class="form-group m-b-0">
		<input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
		<div class="bootstrap-filestyle input-group">
		<span class="group-span-filestyle input-group-btn" tabindex="0">
		
		</span>
		</div>         
		</div>
		<hr>
		<div class="form-group">
		<label for="usr_user">Usuario<span class="text-danger">*</span></label>
		<input type="text" name="usr_user" parsley-trigger="change" required="" placeholder="" class="form-control" id="usr_user">
		</div>
		<div class="form-group">
		<label for="pass1">Contraseña<span class="text-danger">*</span></label>
		<input id="pass1" name="usr_pass" type="password" placeholder="Password" required="" class="form-control">
		</div>
		<div class="form-group">
		<label for="passWord2">Confirmar Contraseña <span class="text-danger">*</span></label>
		<input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" id="passWord2">
		</div>
		<label >Nivel<span class="text-danger">*</span></label>
		<div class="form-group">
		<div class="radio radio-info radio-inline" onchange="yesnoCheck(this);">
		<input type="radio" id="inlineRadio3" value="1" name="usr_niv" '.radiosexo1().'>
		<label for="inlineRadio3"> Empleado </label>
		</div>
		<div class="radio radio-warning radio-inline" onchange="yesnoCheck2(this);">
		<input type="radio" id="inlineRadio4" value="0" name="usr_niv" '.radiosexo1().' >
		<label for="inlineRadio4"> Administrador </label>
		</div>
		</div>

		<div class="form-group" id="emg" style="display:none;">
		<label for="usr_em">Email (Requerido para Administradores)<span class="text-danger">*</span></label>
		<input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.err_print('usr_em').'">
		</div>
		<div class="form-group" id="telf" style="display:none;">
		<label for="usr_tel">Telefono (Requerido para Administradores)<span class="text-danger">*</span></label>
		<input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel">
		</div>
		<div class="form-group" id="summer" style="display:none;">
		<label for="summernote">Biografia<span class="text-danger"></span></label>
		<fieldset>
		
		<p class="container">
		<textarea class="input-block-level" id="summernote" name="content" rows="2">
		</textarea>
		</p>
		</fieldset>
		
		</div>
		<hr>
		<div class="form-group text-right m-b-0">
		
		<button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
		<i class="mdi mdi-check"></i>Guardar
		</button>
		</div>
		</form>');
}
function contacts_information($id){
	$usr=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), telefono, email from usuario where id=".$id."");
	echo('<div class="panel-body">
		<div class="m-b-20">
		<strong>Nombre Completo</strong>
		<br>
		<p class="text-muted">'.array_values($usr[0])[0].'</p>
		</div>
		<div class="m-b-20">
		<strong>Telefono</strong>
		<br>
		<p class="text-muted">'.array_values($usr[0])[1].'</p>
		</div>
		<div class="m-b-20">
		<strong>Correo Electronico</strong>
		<br>
		<p class="text-muted">'.array_values($usr[0])[2].'</p>
		</div>
		</div>');
}


function allcontacts(){
	$id_users=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), email, fotografia, telefono, id from usuario where nivel=0 and activo=1");
	
	for($i=0;$i<sizeof($id_users);$i++){
			//if($i%3==0 )
				 //echo('<div class="row">');
		echo('
			<div class="col-md-4">
			<div class="text-center card-box">
			<div class="clearfix"></div>
			<div class="member-card" style=" height:250px">
			<div class="thumb-xl member-thumb m-b-10 center-block">
			<img src="'.array_values($id_users[$i])[2].'" class="img-circle img-thumbnail" alt="profile-image">
			<i class="mdi mdi-star-circle member-star text-success" title="Usuario Administrador"></i>
			</div>

			<div class="">
			<h4 class="m-b-5">'.array_values($id_users[$i])[0].'</h4>
			<p class="text-muted">'.array_values($id_users[$i])[3].' <span> | <span> <a href="#" class="text-pink">'.array_values($id_users[$i])[1].'</a> </span></p>
			</div>

			
			<a href="profile.php?id='.array_values($id_users[$i])[4].'"><button type="button" class="btn btn-default btn-sm m-t-10">Ver Perfil</button></a>
			</div>
			</div>
			</div>'
		);
			 //if($i%3==0 )
				 //echo('</div>');

			//echo(array_values($id_users[$i])[0]."<br>");
	}
}

?>