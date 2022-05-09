<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/academic-dashboard.css') }}">
    @endpush

    <x-app-header-academic></x-app-header-academic>

    <main>
        <div class="container">
            <div class="row">

                <x-app-aside-academic></x-app-aside-academic>
                
                <div class="col-md-8">
                    <div>
                        <h5 class="mb-1">Keuangan Pribadi</h5>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Keuangan Pribadi</span>
                        </nav>
                    </div>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <form method="post">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <strong>Tahun :</strong>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="tahun" class="form-control">
                                                @foreach ($years as $item)
                                                    <option value="{{ $item->name }}" {{ $item->id == $yearNow->year->id ?? $yearNow->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="status" class="form-control">
                                                <option value="ganjil" {{ strtolower($yearNow->year->status ?? $yearNow->status) == 'ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                                <option value="genap" {{ strtolower($yearNow->year->status ?? $yearNow->status) == 'genap' ? 'selected' : '' }}>Semester Genap</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary w-100">Cek</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                @foreach ($contributions as $contribution)
                                    <div class="box shadow-sm mb-4 border">
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
                                                    $year_id = $yearNow->year->id ?? $yearNow->id;
                                                    $contributionOnYear = $contribution->item->filter(function($val, $key) use ($year_id){
                                                        return $val['year_id'] == $year_id;
                                                    });
                                                    $lunas = 0;
                                                ?>
                                                @forelse ($contributionOnYear as $i => $item)
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
                                                        {!! count($contribution->item) == 0 ? '-' : (count($contribution->item) == $lunas ? '<small class="text-success">Lunas</small>' : '<small class="text-danger">Belum Lunas</small>'); !!}
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
    </main>

</x-app-layout>