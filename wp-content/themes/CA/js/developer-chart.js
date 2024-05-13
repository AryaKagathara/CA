const DATA_COUNT = 5;
const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };
const data = {
	//labels: Utils.months({count: NUM_DATA}),
	labels: [
		'Individual',
		'Partnership',
		'PVT',
		'LTD',
		'Trust'
	],
	datasets: [
		{
			label: 'My First Dataset',
			data: [399, 100, 200, 100, 699],
			backgroundColor: [
				'#2A76F4',
				'#00F4FF',
				'#009CFF',
				'#00D9FF',
				'#1561DF'
			],
			borderWidth: 0,
			hoverOffset: 10
		}]
};
const config = {
	type: 'doughnut',
	data: data,
	options: {
		aspectRatio: 2,
		responsive: true,
		plugins: {
			legend: {
				position: 'left',
				labels: {
					// This more specific font property overrides the global property
					font: {
						size: 16, color: '#959595', letterSpacing: '0.04em',
					}
				}
			},
			title: {
				display: false,
				text: 'Chart.js Doughnut Chart'
			}
		}
	},
	//plugins: [htmlLegendPlugin],
};
Chart.defaults.font.size = 16;
const pieChart = new Chart(
	document.getElementById('pieChart'),
	config
);



const ctx = document.getElementById('barChart').getContext('2d');
ctx.beginPath();
ctx.setLineDash([5, 15]);
ctx.moveTo(0, 50);
ctx.lineTo(300, 50);
ctx.stroke();


const barChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ['Approval', 'Todo', 'In-Progress', 'Completed', 'Checked'],
		datasets: [{
			// label: data,
			data: [92, 187, 165, 237, 300],
			backgroundColor: [
				'#2A76F4',
				'#2A76F4',
				'#2A76F4',
				'#2A76F4',
				'#2A76F4'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)'
			],
			backdropPadding: 100,
			lineWidth: 100,
			tickLength: 100,
			tickBorderDash: [0],
			base: -2,
			borderWidth: 0,
			borderRadius: 10,
			barThickness: 10,
		}],
	},
	options: {
		scales: {
			// The following will affect the vertical lines (xAxe) of your dataset
			xAxes: [{
				gridLines: {
					// You can change the color, the dash effect, the main axe color, etc.
					borderWidth: 1,
					borderDashOffset: 2,
					color: "#348632"
				}
			}],
			x: {
				grid: {
					display: false,
				}
			},
			y: {
				grid: {
					display: true,
					borderWidth: 2,
					borderDash: [4, 4],
					color: "#D9D9D9",
				}
			}
		},
		plugins: {
			legend: {
				labels: false,
			}
		}
	}
});