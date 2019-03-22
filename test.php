<button id="find_btn">Find Me</button>
<div id="result"></div>

<script type="text/javascript">
if ("geolocation" in navigator){ //check geolocation available 
    //try to get user current location using getCurrentPosition() method
    navigator.geolocation.getCurrentPosition(function(position){ 
            alert("GEOLOCALIZACIÓN: \nLatitud: "+position.coords.latitude+"\nLongitud: "+ position.coords.longitude);
        });
}else{
    console.log("Browser doesn't support geolocation!");
}
</script>