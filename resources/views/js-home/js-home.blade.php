@include('js-home.partials.labels')
@include('js-home.partials.datas')
@include('js-home.partials.configs')
<script>

    // chart riwayat service
    const myChartServicePerbulan = new Chart(
        document.getElementById('myChartServicePerbulan'),
        configServicePerbulan
    );

    const myChartServicePertahun = new Chart(
        document.getElementById('myChartServicePertahun'),
        configServicePertahun
    );

    // chart riwayat digunakan
    const myChartDigunakanPerbulan = new Chart(
        document.getElementById('myChartDigunakanPerbulan'),
        configDigunakanPerbulan
    );

    const myChartDigunakanPertahun = new Chart(
        document.getElementById('myChartDigunakanPertahun'),
        configDigunakanPertahun
    );

    // chart Penggunaan BBM
    const myChartBBMPerbulan = new Chart(
        document.getElementById('myChartBBMPerbulan'),
        configBBMPerbulan
    );

    const myChartBBMPertahun = new Chart(
        document.getElementById('myChartBBMPertahun'),
        configBBMPertahun
    );

</script>
