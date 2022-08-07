<script>
    // data riwayat service
    const dataServicePerbulan = {
        labels: labelsServicePerbulan,
        datasets: [{
            label: "Jumlah Kendaraan Diservice Bulan {{ $bulan->format('F Y') }}",
            data: [
                @if($riwayat_service_perbulan->count() > 0)
                @foreach($riwayat_service_perbulan as $data)
                    {{ $data->jumlah }} ,
                @endforeach
                @endif
            ],
            backgroundColor: [
                @if($riwayat_service_perbulan->count() > 0)
                @foreach($riwayat_service_perbulan as $data)
                'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                @endforeach
                @endif
            ],
            borderColor: [
                @if($riwayat_service_perbulan->count() > 0)
                @foreach($riwayat_service_perbulan as $data)
                'rgb(255, 102, 102)',
                @endforeach
                @endif
            ],
            borderWidth: 1
        }]
    };

    const dataServicePertahun = {
        labels: labelsServicePertahun,
        datasets: [{
            label: "Jumlah Kendaraan Diservice Tahun {{ $bulan->format('Y') }}",
            data: [
                @if($riwayat_service_pertahun->count() > 0)
                @foreach($riwayat_service_pertahun as $data)
                    {{ $data->jumlah }} ,
                @endforeach
                @endif
            ],
            backgroundColor: [
                @if($riwayat_service_pertahun->count() > 0)
                @foreach($riwayat_service_pertahun as $data)
                'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                @endforeach
                @endif
            ],
            borderColor: [
                @if($riwayat_service_pertahun->count() > 0)
                @foreach($riwayat_service_pertahun as $data)
                'rgb(255, 102, 102)',
                @endforeach
                @endif
            ],
            borderWidth: 1
        }]
    };

    // data riwayat digunakan
    const dataDigunakanPerbulan = {
        labels: labelsDigunakanPerbulan,
        datasets: [{
            label: 'Jumlah Kendaraan Dalam Ekspedisi {{ $bulan->format("F Y") }}',
            data: [
                @if($riwayat_digunakan_perbulan->count() > 0)
                @foreach($riwayat_digunakan_perbulan as $data)
                    {{ $data->jumlah }} ,
                @endforeach
                @endif
            ],
            backgroundColor: [
                @if($riwayat_digunakan_perbulan->count() > 0)
                @foreach($riwayat_digunakan_perbulan as $data)
                'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                @endforeach
                @endif
            ],
            borderColor: [
                @if($riwayat_digunakan_perbulan->count() > 0)
                @foreach($riwayat_digunakan_perbulan as $data)
                'rgb(255, 102, 102)',
                @endforeach
                @endif
            ],
            borderWidth: 1
        }]
    };

    const dataDigunakanPertahun = {
        labels: labelsDigunakanPertahun,
        datasets: [{
            label: 'Jumlah Kendaraan Dalam Ekspedisi Tahun {{ $bulan->format("Y") }}',
            data: [
                @if($riwayat_digunakan_pertahun->count() > 0)
                @foreach($riwayat_digunakan_pertahun as $data)
                    {{ $data->jumlah }} ,
                @endforeach
                @endif
            ],
            backgroundColor: [
                @if($riwayat_digunakan_pertahun->count() > 0)
                @foreach($riwayat_digunakan_pertahun as $data)
                'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                @endforeach
                @endif
            ],
            borderColor: [
                @if($riwayat_digunakan_pertahun->count() > 0)
                @foreach($riwayat_digunakan_pertahun as $data)
                'rgb(255, 102, 102)',
                @endforeach
                @endif
            ],
            borderWidth: 1
        }]
    };

    // data BBM Perbulan
    const dataBBMPerbulan = {
        labels: labelsBBMPerbulan,
        datasets: [{
            label: 'Konsumsi BBM/Bulan Tahun {{ $bulan->format("Y") }}',
            data: [
                @foreach($bbm_perbulan as $bbm)
                    {{ $bbm->bbm_liter }} ,
                @endforeach
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    const dataBBMPertahun = {
        labels: labelsBBMPertahun,
        datasets: [{
            label: 'Konsumsi BBM/Hari Bulan {{ $bulan->format("F Y") }}',
            data: [
                @foreach($bbm_pertahun as $bbm)
                    {{ $bbm }} ,
                @endforeach
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
</script>
