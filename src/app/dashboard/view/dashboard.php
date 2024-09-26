<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="./../src/app/dashboard/models/generateCharts.js"></script>


<body onload="generateMemberCharts(); generateTransactionsCharts();">

<div class="container">
    <div id="upper_db">
        <h1>Dashboard</h1>
        <h2>Herzlich Willkommen <?php echo htmlspecialchars($_SESSION['username']) ?> im
            <span style="color: lightskyblue;"><?php echo htmlspecialchars($vereinName) ?></span>
        </h2>
    </div>

    <section id="charts">
        <!-- Diagramm zur Mitgliederanzahl -->
        <div class="chart-container">
            <h2>Mitglieder</h2>
            <div id="membersChart"></div> <!-- Canvas durch Div ersetzt -->
        </div>
        <!-- Diagramm zur Transaktionsberechnung -->
        <div class="chart-container">
            <h2>Zahlungen</h2>
            <div id="transactionChart"></div> <!-- Canvas durch Div ersetzt -->
        </div>
    </section>
</div>



