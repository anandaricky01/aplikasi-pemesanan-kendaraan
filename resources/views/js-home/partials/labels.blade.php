<script>
    // label riwayat service
    const labelsServicePerbulan = [
        @if($riwayat_service_perbulan->count() > 0)
        @foreach($riwayat_service_perbulan as $data)
            '{{ $data->kendaraan->plat_no }}' ,
        @endforeach
        @endif
    ];

    const labelsServicePertahun = [
        @if($riwayat_service_pertahun->count() > 0)
        @foreach($riwayat_service_pertahun as $data)
            '{{ $data->kendaraan->plat_no }}' ,
        @endforeach
        @endif
    ];

    // label riwayat digunakan
    const labelsDigunakanPerbulan = [
        @if($riwayat_digunakan_perbulan->count() > 0)
        @foreach($riwayat_digunakan_perbulan as $data)
        '{{ $data->kendaraan->plat_no }}' ,
        @endforeach
        @endif
    ];

    const labelsDigunakanPertahun = [
        @if($riwayat_digunakan_pertahun->count() > 0)
        @foreach($riwayat_digunakan_pertahun as $data)
        '{{ $data->kendaraan->plat_no }}' ,
        @endforeach
        @endif
    ];

    // label BBM Perbulan
    const labelsBBMPertahun = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];

    const labelsBBMPerbulan = [
        @foreach($bbm_perbulan as $bbm)
            "{{ $bbm->tanggal_digunakan }}" ,
        @endforeach
    ];
</script>
