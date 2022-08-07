<script>
    // config riwyat service
    const configServicePerbulan = {
        type: 'bar',
        data: dataServicePerbulan,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        },
    };

    const configServicePertahun = {
        type: 'bar',
        data: dataServicePertahun,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        },
    };

    // config riwayat digunakan
    const configDigunakanPerbulan = {
        type: 'bar',
        data: dataDigunakanPerbulan,
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
    };

    const configDigunakanPertahun = {
        type: 'bar',
        data: dataDigunakanPertahun,
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
    };

    // config
    const configBBMPerbulan = {
        type: 'line',
        data: dataBBMPerbulan,
        options:{
            scales:{
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Liter'
                    }
                }
            }
        }
    };

    const configBBMPertahun = {
        type: 'line',
        data: dataBBMPertahun,
        options:{
            scales:{
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Liter'
                    }
                }
            }
        }
    };
</script>
