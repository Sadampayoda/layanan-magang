@extends('auth.component.app')


@section('content')
    <div class="body-wrapper mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Selamat datang di layanan magang</h2>
                    @include('component.alert')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div id="grafik">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('/api/data-magang')
            .then(response => response.json())
            .then(data => {
                Highcharts.chart('grafik', {
                    title: {
                        text: 'Data Magang Mahasiswa/Siswa',
                        align: 'left'
                    },
                    subtitle: {
                        text: 'Jumlah keselurahan data mahasiswa mengikuti magang',
                        align: 'left'
                    },
                    yAxis: {
                        title: {
                            text: 'Mahasiswa/siswa Magang'
                        }
                    },
                    xAxis: {
                        categories: Object.keys(data.pkl), // Menampilkan tahun dari data yang sudah disortir
                        title: {
                            text: 'Year'
                        }
                    },
                    series: [{
                        name: 'PKL',
                        data: Object.values(data.pkl)
                    }, {
                        name: 'Prakerin',
                        data: Object.values(data.prakerin)
                    }, {
                        name: 'Magang',
                        data: Object.values(data.magang)
                    }],
                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
@endsection
