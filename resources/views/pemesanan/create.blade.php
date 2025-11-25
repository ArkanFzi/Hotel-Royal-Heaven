<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buat Pemesanan</title>
</head>
<body>
    <h1>Buat Pemesanan</h1>
    <form method="POST" action="{{ route('pemesanan.store') }}">
        @csrf
        <div>
            <label>Pilih Kamar</label>
            <select name="id_kamar" required>
                @foreach($kamars as $k)
                    <option value="{{ $k->id_kamar }}">{{ $k->nomor_kamar }} - {{ $k->tipe->nama_tipe ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Check-in</label>
            <input type="date" name="tgl_check_in" required>
        </div>
        <div>
            <label>Check-out</label>
            <input type="date" name="tgl_check_out" required>
        </div>
        <div>
            <label>Pilihan Pembayaran</label>
            <input type="text" name="pilihan_pembayaran" required>
        </div>
        <div>
            <button type="submit">Pesan</button>
        </div>
    </form>
</body>
</html>
