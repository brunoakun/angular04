<?php
	/** Cookie consent
	* https://html-online.com/articles/cookie-warning-widget-with-javascript/
	*/
	
?>

<!-- =============== Cookie consent ============= -->
<style>#myCookieConsent {
    z-index: 999;
    min-height: 20px;
    font-family: OpenSans, arial, "sans-serif";
    padding: 10px 20px;
    background: rgba(0,0,0,0.6);
    overflow: hidden;
    position: fixed;
    color: #FFF;
    bottom: 0px;
    right: 10px;
    display: none;
    left: 0;
    text-align: center;
    font-size: 15px;
    font-weight: bold;
}
#myCookieConsent div {
    padding: 5px 0 0;
}
#myCookieConsent a {
    color: #ffba55;
    display: inline-block;
    padding: 0 10px;
}
#myCookieConsent a:hover {
	color: #fda016;
}
#myCookieConsent a#cookieButton {
    display: inline-block;
    color: #000000;
    font-size: 1.1em;
	background: #ffba55;
    text-decoration: none;
    cursor: pointer;
    padding: 2px 20px;
    float: right;
    border-radius: 20px;
}
#myCookieConsent a#cookieButton:hover {
    background: #fda016;
	color: #000;
}
</style>

<div id="myCookieConsent" class="py-2">
	<div class="container">
        <div class="row">
			<div class="col-8 text-left">Las cookies de este sitio web, no recopilan ninguna información personal. Se utilizan únicamente para analizar el tráfico.</div>
			<div class="col-4 text-right"><a id="cookieButton" class="btn btn-dark">Entendido</a></div>
		</div>
	</div>
</div>



<script>
	// Cookie Compliancy BEGIN
	function GetCookie(name) {
	  var arg=name+"=";
	  var alen=arg.length;
	  var clen=document.cookie.length;
	  var i=0;
	  while (i<clen) {
		var j=i+alen;
		if (document.cookie.substring(i,j)==arg)
		  return "here";
		i=document.cookie.indexOf(" ",i)+1;
		if (i==0) break;
	  }
	  return null;
	}
	function testFirstCookie(){
		var offset = new Date().getTimezoneOffset();
		if ((offset >= -180) && (offset <= 0)) { // European time zones
			var visit=GetCookie("cookieCompliancyAccepted");
			if (visit==null){
			   $("#myCookieConsent").fadeIn(400);	// Show warning
		   } else {
				// Already accepted
		   }		
		}
	}
	$(document).ready(function(){
		$("#cookieButton").click(function(){
			//console.log('Understood');
			var expire=new Date();
			expire=new Date(expire.getTime()+7776000000);
			document.cookie="cookieCompliancyAccepted=here; expires="+expire+";path=/";
			$("#myCookieConsent").hide(400);
		});
		testFirstCookie();
	});
	// Cookie Compliancy END
</script>

<!-- //=============== Cookie consent ============= -->