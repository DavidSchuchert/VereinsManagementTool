let modelPath = './../src/app/dashboard/models/m_dashboard.php';

function generateMemberCharts() {
    fetch(modelPath)
        .then(response => response.json())
        .then(data => {
            // Konvertiere die Werte in Zahlen
            let totalMembers = parseInt(data.total_members, 10) || 0;
            let supportMembers = parseInt(data.support_members, 10) || 0;
            let gruendungsMembers = parseInt(data.Gruendungs_members, 10) || 0;
            let ordentlichesMembers = parseInt(data.ordentliches_members, 10) || 0;

            var options = {
                chart: {
                    type: 'bar'
                },
                series: [{
                    name: 'Mitglieder',
                    data: [totalMembers, supportMembers, gruendungsMembers, ordentlichesMembers]
                }],
                xaxis: {
                    categories: ['Gesamt', 'Support', 'Gründungsmitglieder', 'Ordentliche Mitglieder']
                }
            };

            var chart = new ApexCharts(document.querySelector("#membersChart"), options);
            chart.render();
        })
        .catch(error => console.error('Error fetching data:', error));
}

function generateTransactionsCharts() {
    fetch(modelPath)
        .then(response => response.json())
        .then(data => {
            // Konvertiere die Werte in Zahlen
            let einnahme = parseFloat(data.einnahme) || 0;
            let ausgabe = parseFloat(data.ausgabe) || 0;
            let differenz = parseFloat(data.differenz) || 0;

            var options = {
                chart: {
                    type: 'pie'
                },
                series: [einnahme, ausgabe, differenz],
                labels: ['Einnahmen', 'Ausgaben', 'Differenz'],
                colors: ['#CAFF70', '#FF4500', '#CDC673'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors:['#000000']
                    },
                    formatter: function (val, opts) {
                        return opts.w.config.series[opts.seriesIndex] + "€";
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#transactionChart"), options);
            chart.render();
        })
        .catch(error => console.error('Error fetching data:', error));
}

