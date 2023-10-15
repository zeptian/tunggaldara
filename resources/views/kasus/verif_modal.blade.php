<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Kasus</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Identitas Pasien</h3>
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>{{ $pasien->nama . ' (' . $pasien->jkl . ')' }}</td>
                        <td>Orang Tua</td>
                        <td>{{ $pasien->ortu }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $pasien->alamat . ' RT/RW:' . $pasien->rtrw }}</td>
                    </tr>
                </table>
                <h3>Hasil Pemeriksaan</h3>
                <table class="table">
                    <tr>
                        <td>Tempat Perawatam</td>
                        <td>{{ $kasus->rs }}</td>
                        <td>Tanggal Lapor</td>
                        <td>{{ $kasus->tgl_lp }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>{{ $kasus->tgl_rs }}</td>
                        <td>Tanggal Gejala</td>
                        <td>{{ $kasus->tgl_sk }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Diagnosa</td>
                        <td>{{ $kasus->tegak }}</td>
                        <td>Diagnosa</td>
                        <td>{{ $kasus->jenis }}</td>
                    </tr>
                    <tr>
                        <td>Kasus</td>
                        <td>{{ $kasus->status }}</td>
                        <td>Sumber data</td>
                        <td>{{ $kasus->sumber }}</td>
                    </tr>
                    <tr>
                        <td>Panas</td>
                        <td>{{ $kasus->panas == 'x' ? 'Tidak diperiksa' : ($kasus->panas == '1' ? 'Ya' : 'Tidak') }}
                        </td>
                        <td>Uji RL</td>
                        <td>{{ $kasus->uji_rl == 'x' ? 'Tidak diperiksa' : ($kasus->uji_rl == '1' ? 'Ya' : 'Tidak') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Gejala</td>
                        <td colspan="3">{{ $kasus->gejala }}</td>
                    </tr>
                    <tr>
                        <td>Trombosit</td>
                        <td>{{ $kasus->trombosit }}</td>
                        <td>HB Tegak</td>
                        <td>{{ $kasus->hb_tegak }}</td>
                    </tr>
                    <tr>
                        <td>HT Awal</td>
                        <td>{{ $kasus->ht_awal }}</td>
                        <td>HT Tegak</td>
                        <td>{{ $kasus->ht_tegak }}</td>
                    </tr>
                    <tr>
                        <td>IGG</td>
                        <td>{{ $kasus->igg == 'x' ? 'Tidak diperiksa' : ($kasus->igg == '1' ? 'Ya' : 'Tidak') }}</td>
                        <td>IGM</td>
                        <td>{{ $kasus->igm == 'x' ? 'Tidak diperiksa' : ($kasus->igm == '1' ? 'Ya' : 'Tidak') }}</td>
                    </tr>
                    <tr>
                        <td>NS1</td>
                        <td colspan="3">
                            {{ $kasus->ns1 == 'x' ? 'Tidak diperiksa' : ($kasus->ns1 == '1' ? 'Ya' : 'Tidak') }}</td>
                    </tr>
                    <tr>
                        <td>Pemeriksa</td>
                        <td colspan="3">{{ $kasus->pemeriksa }}</td>
                    </tr>
                </table>

                <h3>Verifikasi</h3>
                <table class="table">
                    <tr>
                        <th>Tanggal Verif</th>
                        <th><input type="text" class="form-control"
                                value="{{ $kasus->tgl_verifikasi ?? date('d-m-Y') }}" readonly />
                        </th>
                    </tr>
                    <tr>
                        <th>Diagnosa Verif</th>
                        <th>
                            <select name="diag_akhir" class="form-control">
                                <option></option>
                                <option {{ $kasus->diag_akhir == 'DBD' ? 'selected' : '' }}>DBD</option>
                                <option {{ $kasus->diag_akhir == 'DSS' ? 'selected' : '' }}>DSS</option>
                                <option {{ $kasus->diag_akhir == 'DD' ? 'selected' : '' }}>DD</option>
                                <option {{ $kasus->diag_akhir == 'NON Kriteria' ? 'selected' : '' }}>NON Kriteria
                                </option>
                            </select>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
