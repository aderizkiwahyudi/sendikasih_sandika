<x-app-layout>
    
    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <div class="row">
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ count($student) }}</h3>
                            <small>SISWA AKTIF</small>
                        </div>
                    </div>
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ count($teacher) + count($staff) }}</h3>
                            <small>GURU & STAFF</small>
                        </div>
                    </div>
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ count($ppdb) }}</h3>
                            <small>PENDAFTAR PPDB</small>
                        </div>
                    </div>
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ count($penerimaan_guru_staff) }}</h3>
                            <small>PENDAFTAR GURU & STAFF</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>DATA SISWA</h4>
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="width: 100%; height: 450px;"></div>
                        </div>
                    </div>
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ $year->name }}</h3>
                            <small>TAHUN AKADEMIK</small>
                        </div>
                    </div>
                    <div class="col col-md-3 mb-3">
                        <div class="bg-white shadow-sm border rounded p-3">
                            <h3>{{ strtoupper($year->status) }}</h3>
                            <small>SEMESTER</small>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    @push('script')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Unit', 'Jumlah Siswa'],
            ['MI', 11],
            ['SMP', 2],
            ['SMA', 2],
            ]);

            var options = {
            title: 'Jumlah Data Siswa'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
    @endpush    

</x-app-layout>