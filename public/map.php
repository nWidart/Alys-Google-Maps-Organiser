<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<title>TCR-group: Map</title>
		<style>
			.maps_container .img_thumb {
				float: left;
				margin-right: 15px;
				padding: 5px;
				background: #e3e3e3;
				border-radius: 4px;
			}
			body {
				font-family: sans-serif;
			}
			.maps_container h4 {
				margin: 10px 0;
			}
			.maps_container {
				width: 350px;
			}
			.maps_container ul {
				list-style: none;
			}
			.maps_container p {
				margin-left: 145px;
			}
		</style>
		<script src="http://maps.google.com/maps/api/js?sensor=false"
						type="text/javascript"></script>
		<script type="text/javascript">
		//<![CDATA[

		var customIcons = {
			restaurant: {
				icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
				shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
			},
			bar: {
				icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
				shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
			},
			tcrgroup: {
				icon: 'img/tcr-group.png',
				shadow: 'img/tcr-group-shadow.png'
			}
		};

		function load() {
			var map = new google.maps.Map(document.getElementById("map"), {
				center: new google.maps.LatLng(50.911156, 4.481639),
				zoom: 5,
				mapTypeId: 'roadmap',
				mapTypeControlOptions: {
					mapTypeIds : ['Styled']
				},
				mapTypeControl: false,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL,
					position: google.maps.ControlPosition.LEFT_BOTTOM
				},
				streetViewControl: true,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.LEFT_BOTTOM
				},
				panControl: true,
				panControlOptions: {
					position: google.maps.ControlPosition.LEFT_BOTTOM
				},
				styles: [
					{
						featureType: "administrative",
						elementType: "labels",
						stylers: [
						  { visibility: "on" },
						  { weight: 0.1 },
						  { color: "#628199" }
						]
					},
					{
						featureType: "administrative.province",
						elementType: "labels.text",
						stylers: [
						  { visibility: "off" }
						]
					},
					{
						featureType: "poi",
						stylers: [
						  { visibility: "off" }
						]
					},
					{
						featureType: "road.local",
						stylers: [
						  { color: "#ffffff" }
						]
					},
					{
						featureType: "road.local",
						elementType: "labels",
						stylers: [
						  { visibility: "on" },
						  { color: "#808080" },
						  { weight: 0.1 }
						]
					},
					{
						featureType: "transit.station.airport",
						elementType: "geometry.fill",
						stylers: [
						  { lightness: -13 },
						  { visibility: "on" }
						]
					},
					{
						featureType: "road",
						stylers: [
						  { weight: 0.4 },
						  { lightness: 21 },
						  { saturation: -35 }
						]
					}

				]
			});
			var infoWindow = new google.maps.InfoWindow({
				content: "Loading..."
			});

			// Change this depending on the name of your PHP file
			downloadUrl("/genxml.php", function(data) {
				var xml = data.responseXML;
				var markers = xml.documentElement.getElementsByTagName("marker");
				for (var i = 0; i < markers.length; i++) {
					// Setting variables
					var name = markers[i].getAttribute("name");
					var address = markers[i].getAttribute("address");
					var type = markers[i].getAttribute("type");
					var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
					var img = markers[i].getAttribute("img_thumb");
					var rem1 = markers[i].getAttribute("rem1");
					var rem2 = markers[i].getAttribute("rem2");
					var rem3 = markers[i].getAttribute("rem3");
					var rem4 = markers[i].getAttribute("rem4");
					var rem5 = markers[i].getAttribute("rem5");

					// Création
					// var html = "<div class='container'><img src='http://gmaps-org.dev" + img + "' class='img_thumb' /><b>" + name + "</b> <br/>" + address + rem1 +	'</div>';
					var html = "<div class='maps_container'>";
					var html = html + "<img src='http://gmaps-org.dev" + img + "' alt='' class='img_thumb'>";
					var html = html + "<h3>"+name+"</h3>";
					var html = html + "<p>"+address+"</p>";
					var html = html + "<hr>";
					var html = html + "<ul>";
						var html = html + "<li>"+rem1+"</li>";
						var html = html + "<li>"+rem2+"</li>";
						var html = html + "<li>"+rem3+"</li>";
						var html = html + "<li>"+rem4+"</li>";
						var html = html + "<li>"+rem5+"</li>";
					var html = html + "</ul>";
					var html = html + "</div>";
					var icon = customIcons[type] || {};
					var marker = new google.maps.Marker({
						map: map,
						position: point,
						icon: icon.icon,
						shadow: icon.shadow
					});
					bindInfoWindow(marker, map, infoWindow, html);
				}
			});
		}

		function bindInfoWindow(marker, map, infoWindow, html) {
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(html);
				infoWindow.open(map, marker);
			});
		}

		function downloadUrl(url, callback) {
			var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

			request.onreadystatechange = function() {
				if (request.readyState == 4) {
					request.onreadystatechange = doNothing;
					callback(request, request.status);
				}
			};

			request.open('GET', url, true);
			request.send(null);
		}

		function doNothing() {}


		//]]>
	</script>
	</head>

	<body onload="load()">
		<div id="map" style="width: 100%; height: 100%"></div>
	</body>
</html>