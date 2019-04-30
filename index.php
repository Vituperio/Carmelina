<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="icon" type="image/png" href="img/turtleicon.png" sizes="64x64" />
<link href='fullcalendar.css' rel='stylesheet' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/jquery-ui.custom.min.js'></script>
<script src='fullcalendar.min.js'></script>


<script>

	jQuery(document).ready(function() {

		var r = parseInt(Math.random()*100000);
		var url = window.location;
		var base_url = url.origin+url.pathname;
		window.location.replace(base_url+"#"+r);

		/* initialize the calendar
		-----------------------------------------------------------------*/

		jQuery('#calendar').fullCalendar({
			allDayDefault: true,

			header: {
				left: 'prev,next today',
				center: 'title',
				right: ''
			},

      eventSources: [
				{
	        url: 'start.json',
	        color: '#156713',
				},
				{
					events: function(start, end, timezone, callback){
						var all = new Array();
						var today = new Date();

						tday = formatDate(today.getDate());
						tmonth = formatDate(today.getMonth()+1);
						tyear = today.getFullYear();
						today = tyear+"-"+tmonth+"-"+tday;

						var json = $.getJSON('start.json').done(function(data){
							var start = new Date(data[0].start);

							for (var i=1; i <= 12; i++){
								var newdate = new Date(start.setDate(start.getDate() + (2)));
								var day = newdate.getDate();
								if(day < 10){
                                                                        day = "0" + day;
                                                                }
								var month = newdate.getMonth()+1;
								if(month < 10){
									month = "0" + month;
								}
								var year = newdate.getFullYear();
								all.push({title: data[0].title, start: year + "-" + month + "-" +day, color: '#156713'});
							}

							var firstDate = all[0].start;
							if(firstDate <= today){
								$.post('change.php', {'date': firstDate});
							}
							callback(all);
						});
					},
	      }
			],
		});
	});

	// Add 0 to date.
	function formatDate(d){
		if(d<10){
			d = "0"+d;
		}
		return d;
	}
</script>
<style>
	@import url('https://fonts.googleapis.com/css?family=Architects+Daughter');
	body {
		margin-top: 40px;
		text-align: center;
		font-family: 'Architects Daughter', cursive;
	}
	#calendar {
		width: 800px;
    margin: auto;
	}
</style>
</head>
<body>
		<h1>Alimentazione Carmelina</h1>
		<img src='img/turtle.png' style='width: 70px; height: auto;' />
		<div id='calendar'></div>
		<div style='clear:both'></div>
	</div>
</body>
</html>
