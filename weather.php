<!DOCTYPE html>
<html>
<head>
	<title>Acommerce Developer Test</title>
</head>
<body>
<select id="Cities" onchange="setCity()">
	<option value="select color">Select Color</option>
	<option value="Jakarta">Jakarta</option>
	<option value="San Francisco">San Francisco</option>
	<option value="Sydney">Sydney</option>
</select>
<button id="go" onclick="postIt()">Go!</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script>
	var city=null;
	var weather = null;
	var cki = document.cookie.split(';');
	var token = cki[0].split('=')[1];

	window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1245224665509077',
	      xfbml      : true,
	      version    : 'v2.7'
	    });


	};

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   	
	function setCity(){
		var opt = document.getElementById('Cities').value;
		if(opt !== "Select Color"){
			city = opt;
			console.log(city);
			$.ajax({
				url: "http://api.openweathermap.org/data/2.5/weather",
				data: {
					APPID: "bc3ff4a152b3223c5024f2420cc3cfc6",
					q: city	
				},
				success: function(result){
					weather = result.weather[0].description;
				}

			});
			
		}
	}

	function postIt(){
		var time = moment().format("D MMMM YYYY");
		var msg = "The weather of "+city+" at "+ time +" is "+ weather;
		FB.api(
			"/me/feed",
			"POST",
			{
				"access_token":token,
				"message":msg
			},
			function(response){
				if(response && !response.error){
					console.log(response.id);
				} else{
					console.log(response.error);
				}
			}
		);
	}
	console.log(city);
	console.log(document.cookie);

	
	
	
	
</script>


</body>
</html>