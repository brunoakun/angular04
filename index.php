<? 
include("include/session.php");
?>
<!DOCTYPE html>
<html> 
 <head>
	<title><? echo APP_TITLE ?></title>
	<script src="js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

    <!-- dataTables -->
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/angular-datatables.min.js"></script>

    <!-- bootstrap -->
	<script src="js/bootstrap.min.js"></script>	  

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.8.1/dist/sweetalert2.all.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/app.css"> 	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 	
	<link rel="stylesheet" type="text/css" href="css/datatables.bootstrap.css">	
	
    <!-- Sweet Alert -->
    <link href="plugins\sweet-alert2\sweetalert2.min.css" rel="stylesheet" type="text/css">     


    <!-- toastr -->
	<link href="plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
	
	<!-- fontawesome -->
	<script src="https://kit.fontawesome.com/626ece0c1b.js" crossorigin="anonymous"></script>
	


<style>
	.image-upload > input{
		display: none;
	}

	.image-upload img{
		width: 80px;
		cursor: pointer;
	}
</style>




 </head>
       
 <body ng-app="crudApp" ng-controller="CrudController">
		
		<div class="container" ng-init="fetchData()">
			<br />
				<h3 align="center"><? echo APP_TITLE?></h3>
			<br />
			<div class="row">
				<div class="col-md-12">
					
					<div align="right">
						<button type="button" name="add_button" ng-click="addData()" class="btn btn-success">Add</button>
					</div>
					<br />
					<div class="table-responsive" style="overflow-x: unset;">
						<table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30"></th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rec in namesData">
									<td><img ng-src="data/users/{{rec.foto}}" class="img-rounded" width="30"></td>
									<td>{{rec.first_name}}</td>
									<td>{{rec.last_name}}</td>
									<td><button type="button" ng-click="editData(rec, $index)" class="btn btn-warning btn-xs">Edit</button></td>
									<td><button type="button" ng-click="deleteData(rec)" class="btn btn-danger btn-xs">Delete</button></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	 
			
		<?php
		/* ============ browser update ================  */
		include 'include/browser-update.php';

		/* ============ Cookie consent ================  */
		include 'include/cookie-consent.php';
		?>

	</body>
</html>



<!-- Modal form -->
<div class="modal fade" tabindex="-1" role="dialog" id="crudmodal">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<form method="POST" ng-submit="submitForm()">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">{{modalTitle}}</h4>
	      		</div>
	      		<div class="modal-body">

					<div class="row">
						<div class="col-md-2" ng-show="submit_button === 'Edit'">
							<div class="image-upload">
								<label for="file-input" data-toggle="tooltip" data-placement="right" title="Click para cambiar tu foto">
									<img ng-src="data/users/{{foto}}" class="img-thumbnail" style="width:60px;" >
								</label>
								<input id="file-input" type="file" ngf-select="uploadFiles($file, $invalidFiles)" accept="image/*" ngf-max-size="1MB">																						
							</div>
							<i ng-hide="foto === 'noFoto.png'" ng-click="borraFoto(rec, $index)" class="far fa-trash-alt" data-toggle="tooltip" data-placement="right" title="Borrar foto"></i>		
						</div>

						<div class="col-md-10" >
							<div class="form-group" ng-class="{'has-error':first_name_err}">
								<label>Nombre</label>
								<input type="text" name="first_name" ng-model="first_name" class="form-control" />
							</div>
						</div>
					</div>					
					
					<div class="row">
						<div class="col-md-12"  >
							<div class="form-group" ng-class="{'has-error':last_name_err}">
								<label>Apellidos</label>
								<input type="text" name="last_name" ng-model="last_name" class="form-control" />
							</div>
						</div>
					</div>

	      		</div>
	      		<div class="modal-footer">
	      			<input type="hidden" name="hidden_id" value="{{hidden_id}}" />
	      			<input type="submit" name="submit" id="submit" class="btn btn-info" value="{{submit_button}}" />
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	</div>
	        </form>
    	</div>
  	</div>
</div>
 

	
<!-- Sweet-Alert  -->
<script src="plugins\sweet-alert2\sweetalert2.min.js"></script>
<script src="plugins\sweet-alert2\sweet-alert.init.js"></script> 


<!-- toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

    
<!-- ng-file-upload-bower -->
<script src="plugins/ng-file-upload-bower-12.2.13/ng-file-upload-shim.min.js"></script>
<script src="plugins/ng-file-upload-bower-12.2.13/ng-file-upload.min.js"></script>




<script>
	

 	// 	THE CONTROLLER	//


var app = angular.module('crudApp', ['datatables','ngFileUpload']); 

app.controller('CrudController', function($scope, Upload, $http, $timeout){

    // Inicializar variables
    $scope.form_data = {};
    
    // Cargar datos
	$scope.fetchData = function(){
		$http.post('procesos/fetch_data.php').success(function(data){
			$scope.namesData = data;
		});
	};

    // control Modal de formulario
	$scope.openModal = function(){
		var modal_popup = angular.element('#crudmodal');
		limpiaMensajes();
		modal_popup.modal('show');
	};

	$scope.closeModal = function(){
		var modal_popup = angular.element('#crudmodal');
		modal_popup.modal('hide');
	};

    // Nuevo
	$scope.addData = function(){
		$scope.modalTitle = 'Añadir registro';
		$scope.submit_button = 'Insert';
		$scope.first_name='';
		$scope.last_name=''; 
		$scope.foto='noFoto.png'; 
		$scope.openModal();
	};

    // Editar datos
	$scope.editData = function(rec,index){
		$scope.hidden_id = rec.id;
		$scope.linea=index;
		$scope.modalTitle = 'Editar Datos';
		$scope.submit_button = 'Edit';
		$scope.first_name=rec.first_name;
		$scope.last_name=rec.last_name; 
		$scope.foto=rec.foto; 
		$scope.openModal();
	};


    // Submit form
	$scope.submitForm = function(){
		$http({
			method:"POST",
			url:"procesos/process.php",
			data:{'first_name':$scope.first_name, 'last_name':$scope.last_name, 'action':$scope.submit_button, 'id':$scope.hidden_id}
		}).success(function(data){			
			marcaErrores(data);
			if(data.error != ''){
				data.error3.forEach(muestra_error3);
			}else{
				toastr.success(data.message);
				$scope.form_data = {};
				$scope.closeModal();
				$scope.fetchData();
			}
		});
	};
	
	// Borrar registro
	$scope.deleteData = function(rec){
		limpiaMensajes();
		swal({
            title: "Eliminar registro" ,
            text: "¿Seguro que quieres borrar a <span class='rojo'>"+ rec.first_name + " " + rec.last_name + "</span>?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger m-l-10",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar"
        }).then(function () {
			$http({
				method:"POST",
				url:"procesos/process.php",
				data:{'id': rec.id, 'action':'Delete'}
			}).success(function(data){
				if(data.error != ''){
					data.error3.forEach(muestra_error3);
				}else{
					toastr.info(data.message);
					$scope.fetchData();
				}
			});
		});				 
	};
	

	// Upload Foto
	$scope.uploadFiles = function(file, errFiles) {

		// Validar antes de subir la foto
		var aux =  errFiles && errFiles[0];
		if (aux && aux.$error) toastr.error(aux.$error + " " + aux.$errorParam, "No puedes subir esta foto");

        if (file) {
            file.upload = Upload.upload({
                url: 'procesos/uploadFoto.php',
                data: {'file': file, 'id':$scope.hidden_id}
            });

            file.upload.then(function (response) {
                $timeout(function () {
				console.log(response);
					if(response.data.error != ''){
						response.data.error.forEach(muestra_error3);
					}else{
						$scope.foto=response.data.foto;						// imágen el el form
						$scope.namesData[$scope.linea].foto=$scope.foto;	// Imágen en la lista
					}
                });
            }, function (response) {
				
            });
        }   
	}
	
	// Borrar foto	
	$scope.borraFoto = function(){
		$http({
			method:"POST",
			url:"procesos/process.php",
			data:{'action':'borraFoto', 'id':$scope.hidden_id}
		}).success(function(data){			
			marcaErrores(data);
			if(data.error != ''){
				data.error3.forEach(muestra_error3);
			}else{
				$scope.foto='nofoto.png';							// imágen el el form
				$scope.namesData[$scope.linea].foto='nofoto.png';	// Imágen en la lista
				toastr.success(data.message);
			}
		});
	};
	


    // Funciones Aux    //

	function limpiaMensajes(){
		$scope.first_name_err='';
		$scope.last_name_err='';
	}

	function marcaErrores(data){
		// Enmarca/Desmarca en Rojo los campos con error
		$scope.first_name_err = data.error2.first_name;
		$scope.last_name_err  = data.error2.last_name;
	}
 

	// DataTable Parámetros
	$scope.vm = {};
	$scope.vm.dtInstance = {};
	$scope.vm.dtOptions = {
		"aLengthMenu": [[10, -1], [10, 'All']],

		"aaSorting": [[ 1, "asc" ]],
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"language": {
			"lengthMenu": "Mostrando _MENU_ registros por página",
			"zeroRecords": "No se han encontrado registros",
			"info": "Mostrando (_TOTAL_ Reg.) página  _PAGE_ de _PAGES_",
			"infoEmpty": "Sin datos",
			"infoFiltered": "(filtro activo sobre _MAX_ registros)",
			"sSearch":       "Buscar:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Primero",
				"sPrevious": "Anterior",
				"sNext":     "Siguiente",
				"sLast":     "Último"
			}
		},

		"aoColumns": [
			{ "bSearchable": false, "bSortable": false },
			{ "bSearchable": true, "bSortable": true },
			{ "bSearchable": true, "bSortable": true },
			{ "bSearchable": false, "bSortable": false },
			{ "bSearchable": false, "bSortable": false }
		],

	}

});


/// FIN CONTROLLER	//







$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});



//toastr.options
function muestra_error3(item,index,arr){
	toastr.error(item)
}

toastr.options = {
	"closeButton": true,
	"debug": false,
	"newestOnTop": false,
	"progressBar": false,
	"rtl": false,
	"positionClass": "toast-bottom-left",
	"preventDuplicates": false,
	"onclick": null,
	"showDuration": 300,
	"hideDuration": 1000,
	"timeOut": 5000,
	"extendedTimeOut": 1000,
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
}
	 
</script>