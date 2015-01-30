	<script type="text/javascript">
					$(function () {
							$('#statistik').highcharts({
								chart: {
									type: 'line',
									marginRight: 50,
									marginBottom: 25
								},
								title: {
									text: 'Dately Average Page Hits',
									x: -20 //center
								},
								subtitle: {
									text: 'Source: megasoft-id.com',
									x: -20
								},
								xAxis: {
									categories: [<?PHP echo $a_tanggal_s; ?>]
								},
								series: [{
									name: 'Visits',
									data: [<?PHP echo str_replace(",0", "", $a_hits_s); ?>]
								}],
								yAxis: {
									title: {
										text: 'Page Hits'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									valueSuffix: ' Page Hits'
								},
								legend: {
									layout: 'vertical',
									align: 'right',
									verticalAlign: 'top',
									x: -10,
									y: 100,
									borderWidth: 0
								}
								
							});
						});
		</script>
		<script type="text/javascript">
		$(function () {
				$('#statistik2').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Statistic Browser use by user'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage}%</b>',
						percentageDecimals: 0
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
									return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
								}
							}
						}
					},
					series: [{
						type: 'pie',
						name: 'Browser Use',
						data: [
							['Firefox',   <?PHP echo substr($percen_firefox,0,4); ?>],
							['IE',       <?PHP echo substr($percen_ie,0,4); ?>],
							{
								name: 'Chrome',
								y: <?PHP echo substr($percen_chrome,0,4); ?>,
								sliced: true,
								selected: true
							},
							['Safari',    <?PHP echo substr($percen_safari,0,4); ?>],
							['Opera',     <?PHP echo substr($percen_opera,0,4); ?>],
							['Others',   <?PHP echo substr($percen_others,0,4); ?>]
						]
					}]
				});
			});
		</script>