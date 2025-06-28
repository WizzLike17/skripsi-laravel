<table>
    <thead>
        <tr>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Kegiatan</th>
            <th>Nilai</th>
            <th>Total Nilai</th>
            <th>Hasil (Total Nilai / 5)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswaSertifikat as $item)
            <tr>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->mahasiswa->nim }}</td>
                <td>
                    @foreach ($item->sertifikat as $s)
                        {{ $s->nama_kegiatan ?? '-' }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($item->sertifikat as $s)
                        {{ $s->nilai ?? '-' }}<br>
                    @endforeach
                    @if ($item->sertifikat->isEmpty())
                        <span>-</span>
                    @endif
                </td>
                <td>{{ $item->total_nilai }}</td>
                <td>{{ number_format($item->hasil, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
