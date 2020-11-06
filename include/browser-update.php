	<?php
	/** Browser update alert 
	* 	https://browser-update.org/customize.html
	*/
	?>
	
	<!-- =============== browser update ============= -->
	<style>
		body .buorg{		
			color: #000;
			font: 1.2rem Calibri, Helvetica, sans-serif;		
			background-color: #fff430;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
			border-bottom: 1px solid #fff430;
		}
		body .buorg-pad {
			padding: 30px 10px;
			line-height:1.4em;
		}
		body #buorgig, 
		body #buorgul, 
		body #buorgpermanent {
			color: #fff;
			box-shadow: none;
			padding: 0.2em 2em;
			border-radius: 0;
			font-weight: normal;
			background: #000000;
			margin: 0.4em;
		}
		body #buorgig {
			background-color: #000000;
		}
	</style>
	<script> 
		var $buoop = {
			required:{e:-4,f:-3,o:-3,s:-1,c:-3},
			reminder:0, 
			reminderClosed:1,
			insecure:true,
			api:2020.05,
			text: 'Su navegador, {brow_name}, requiere actualizarse para el correcto visionado.<br>Le recomendamos el uso de otros navegadores como Chrome o Firefox para un óptimo visionado de los eventos online.<br><a{up_but}>Actualizar</a>  <a{ignore_but}>Ignorar</a>'
			}; 
		function $buo_f(){ 
		 var e = document.createElement("script"); 
		 e.src = "//browser-update.org/update.min.js"; 
		 document.body.appendChild(e);
		};
		try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
		catch(e){window.attachEvent("onload", $buo_f)}
	</script>
	<!-- //=============== browser update ============= -->