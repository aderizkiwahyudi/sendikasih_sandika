<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <style>
            table, tr, td {
                vertical-align: top;
            }
        </style>
        <style type="text/css" media="print">
            @page 
            {
                size: auto;   /* auto is the initial value */
                margin: 0mm;  /* this affects the margin in the printer settings */
            }
        </style>
    @endpush

    <div id="content-wrapper bg-white">
        
        
        <main>
        
            <div class="content p-5">
                <div>
                    <table>
                        <tr>
                            <td class="pe-5">
                                <div class="max-height-200">
                                    <img src="{{ $user->photo ?? "" }}" alt="Photo" width="100px"/>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-9">
                                        <h5>{{ strtoupper($user->name ?? '') }}</h5>
                                        <p>{{$user->account->student ? 'NISN.' : 'NIP.'}} {{ $user->nisn ?? $user->nip ??  '' }} · {{ $user->account->email }} · <span class="statusID">{{ strtoupper(get_status($user->status_id ?? '1')) }}</span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <small class="bio-label">Tempat, Tanggal Lahir</small>
                                        <p>{{$user->birthday_at ?? ''}}, {{ date('d/m/Y', strtotime($user->birthday ?? "")) }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="bio-label">JENIS KELAMIN</small>
                                        <p>{{ ucwords($user->gender ?? '')}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="bio-label">UNIT</small>
                                        <p>{{ $user->account->unit_id == 1 ? 'Belum Memiliki Unit' : unit_name($user->account->unit_id)  }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="bio-label">STATUS AKUN</small>
                                        <p>{{ strtoupper(get_status($user->status_id ?? '1')) }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="alert" class="mt-3"></div>
                <div class="menus-detail-user mt-3">
                    <div class="my-0">
                        <div class="my-3">
                            <div class="mb-3">
                                <h5 class="mb-1">Keuangan Pribadi</h5>
                                <small>Tahun akademik : {{ $yearNow }} Semester {{ $semester }}</small>
                            </div>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach ($contributions as $key => $contribution)
                                            <div class="box mb-4 border p-3">
                                                <h5 class="mb-0">{{ $contribution->name }}</h5>
                                                <small>{{ $contribution->description }}</small>
                                                <table class="table table-stripped">
                                                    <thead>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Nama</td>
                                                            <td class="text-center">Keterangan</td>
                                                            <td class="text-center">Nominal</td>
                                                            <td class="text-center">Dibayar</td>
                                                            <td class="text-center">Status</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $contributionOnYear = $contribution->item->filter(function($val, $key) use ($year_id){
                                                                return $val['year_id'] == $year_id;
                                                            });
        
                                                            #Pembayaran PPDB Hanya muncul satu kali ditahun pertama
                                                            if($key == 0){
                                                                $contributionOnYear = $contribution->item->filter(function($val) use ($user){
                                                                    return $val['year_id'] == $user->year_id ?? 1;
                                                                });
                                                            }
        
                                                            $lunas = 0;
                                                        ?>
                                                        @forelse ($contributionOnYear->values() as $i => $item)
                                                            <?php
                                                                $sum = 0;
                                                                foreach ($item->payment as $key => $payment) {
                                                                    $sum += $payment->nominal;
                                                                }
        
                                                                if($item->nominal == $sum) $lunas +=1;
                                                            ?>  
                                                            <tr class="vertical-align:middle;">
                                                                <td>{{ $i + 1 }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td class="text-center">Rp{{ number_format($item->nominal,0,'.','.') }}</td>
                                                                <td>Rp{{ number_format($sum,0,'.','.') }}</td>
                                                                <td class="text-center">
                                                                        {!! $item->nominal == $sum ? '<small class="text-success">Lunas</small>' : '<small class="text-danger">Belum Lunas</small>'; !!}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">Belum ada data</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4">Status Keseluruhan</td>
                                                            <td colspan="2" class="text-end">
                                                                {!! count($contributionOnYear) == 0 ? '-' : (count($contributionOnYear) == $lunas ? '<small class="text-success">Lunas</small>' : '<small class="text-danger">Belum Lunas</small>'); !!}
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('script')
                <script>
                    window.print();
                </script>
            @endpush
        </main>
    </div>

</x-app-layout>