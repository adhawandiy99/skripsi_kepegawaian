<div class="tab-pane fade" id="pills-testing" role="tabpanel" aria-labelledby="pills-testing-tab">
    <div class="row">
        <hr class="dropdown-divider">
        <p class="mb-4"><strong>Data Riwayat Diklat :</strong></p>
        <table class="table table-bordered table-sm">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Diklat</th>
                    <th>Penyelenggara</th>
                    <th>Tempat Diklat</th>
                    <th>Tanggal Pelaksanaan | Tanggal Selesai</th>
                    <th>No STTPL</th>
                    <th>Pejabat Yang TTD</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                     $no = 1;
                @endphp
                @forelse ($user->diklat_pns as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama_diklat }}</td>
                    <td>{{ $item->penyelenggara }}</td>
                    <td>{{ $item->tempat_diklat }}</td>
                    <td>{{ $item->tgl_pelaksanaan }} s.d {{ $item->tgl_selesai }}  </td>
                    <td>{{ $item->no_sttpl }}</td>
                    <td>{{ $item->ttd_pejabat }}</td>
                    <td class="text-warning">{{ $item->status_diklat }}</td>
                </tr>
                @empty
                <td colspan="4">Data Tidak Ada</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
