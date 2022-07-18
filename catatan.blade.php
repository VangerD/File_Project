@extends('layouts.main')
@section('catatan')

<title>MyTRAVEL | Catatan</title>
<form action="/catatan" method="GET">
@csrf
<div class="card">
    <div class="row mt-3 ml-2">
        <div class="col-lg-4">
            <label for="filter" class="form-label">Urut Berdasarkan</label>
            <select class="form-select" aria-label="filter" name="filter" id="filter">
            <option value="">
                @if (request('filter') == 'tanggal_perjalanan')
                Tanggal
                @elseif (request('filter') == 'jam_perjalanan')
                Jam
                @elseif (request('filter') == 'nama_tempat')
                Nama Tempat
                @elseif (request('filter') == 'alamat')
                Alamat
                @elseif (request('filter') == 'suhu_tubuh')
                Suhu Tubuh
                @else
                Pilih
                @endif
            </option>
            <option value="" disabled>---------------------</option>
            <option value="tanggal_perjalanan">Tanggal</option>
            <option value="jam_perjalanan">Jam</option>
            <option value="nama_tempat">Nama Tempat</option>
            <option value="alamat">Alamat</option>
            <option value="suhu_tubuh">Suhu Tubuh</option>
        </select>

            <label for="order" class="form-label">Urut Berdasarkan</label>
            <select class="form-select" aria-label="order" name="order" id="order">
            <option value="">
                @if (request('order') == 'asc')
                Urutan Naik
                @elseif (request('order') == 'desc')
                Urutan Turun
                @else
                Pilih
                @endif
            </option>
            <option value="" disabled>---------------------</option>
            <option value="asc">Urutan Naik</option>
            <option value="desc">Urutan Turun</option>
        </select>
        </div>
        <div class="col-lg-4">
            <label for="search" class="form-label d-inline">Pencarian</label>
            <input type="text" class="form-label" name="search" id="search" placeholder="Cari" value="{{ request('search') }}">
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary">
                <img src="image/search.png">
            </button>
            <a href="/catatan" role="button" class="btn btn-primary">
            <img src="image/reset.png"></a>
        </div>
    </div>
</form>
<section class="mt-1">
    <div class="card">
        <table id="table" class="table table-wrapper table-striped table-light table-hover border-white ">
            <thead class="text-dark">
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Nama Tempat</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Suhu Tubuh (Celcius)</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                   @foreach ($catatan as $item)
                   <tr>
                    <td>{{ date('d F Y', strtotime($item->tanggal_perjalanan)) }}</td>
                    <td>{{ date('H : i', strtotime($item->jam_perjalanan)) }}</td>
                    <td>{{ $item->nama_tempat }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->suhu_tubuh }}&#176;</td>
                    <td >
                        <form action="/catatan/delete/{{ $item->id }}" method="POST">
                            @csrf
                            <button type="submit" class="btn p-0 m-0 text-center">
                                <img src="image/delete.png" width="30px">
                            </button>
                        </form>
                    </td>
                </tr>
                   @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </section>



</div>


@endsection
