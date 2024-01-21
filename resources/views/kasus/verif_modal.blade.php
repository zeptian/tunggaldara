<!-- Modal -->
<div class="modal fade" id="veridModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Kasus</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formVerif">
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
                            <td>Alamat Domisili</td>
                            <td colspan="3">
                                <textarea class="form-control" name="alamat" id="alamat">{{ $pasien->alamat }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Kelurahan</td>
                            <td>
                                <select class="form-control select2" name="kelurahan" id="kelurahan">
                                    @foreach ($kelurahan as $item)
                                        @if ($item->kode == strtoupper($pasien->kdesa))
                                            <option selected value="{{ $item->kode }}">{{ $item->nama }}</option>
                                        @else
                                            <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>RT/RW</td>
                            <td><input class="form-control" type="text" id="rtrw" name="rtrw"
                                    value="{{ $pasien->rtrw }}" /> </td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td colspan="3">
                                <textarea class="form-control" name="alamat_ktp" id="alamat_ktp">{{ $pasien->alamat_ktp }}</textarea>
                            </td>
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
                            <td>Trombosit Awal</td>
                            <td><input type="text" name="trombosit_awal" value="{{ $kasus->trombosit_awal }}"
                                    class="form-control" /></td>
                            <td>Trombosit Tegak</td>
                            <td><input type="text" name="trombosit" value="{{ $kasus->trombosit }}"
                                    class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>HB Awal</td>
                            <td><input type="text" name="hb_awal" value="{{ $kasus->hb_awal }}"
                                    class="form-control" />
                            </td>
                            <td>HB Tegak</td>
                            <td><input type="text" name="hb_tegak"
                                    value="{{ $kasus->hb_tegak }}"class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>HT Awal</td>
                            <td><input type="text" name="ht_awal" value="{{ $kasus->ht_awal }}"
                                    class="form-control" />
                            </td>
                            <td>HT Tegak</td>
                            <td><input type="text" name="ht_tegak" value="{{ $kasus->ht_tegak }}"
                                    class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>IGG</td>
                            <td>
                                <select name="igg" class="form-control">
                                    <option value="x" {{ $kasus->igg == 'x' ? 'selected' : '' }}>Tidak diperiksa
                                    </option>
                                    <option value="0" {{ $kasus->igg == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ $kasus->igg == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </td>
                            <td>IGM</td>
                            <td>
                                <select name="igm" class="form-control">
                                    <option value="x" {{ $kasus->igm == 'x' ? 'selected' : '' }}>Tidak diperiksa
                                    </option>
                                    <option value="0" {{ $kasus->igm == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ $kasus->igm == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>NS1</td>
                            <td colspan="3">
                                <select name="ns1" class="form-control">
                                    <option value="x" {{ $kasus->ns1 == 'x' ? 'selected' : '' }}>Tidak diperiksa
                                    </option>
                                    <option value="0" {{ $kasus->ns1 == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ $kasus->ns1 == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </td>
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
                                    value="{{ $kasus->tgl_verifikasi && $kasus->tgl_verifikasi != '0000-00-00' ? date('d-m-Y', strtotime($kasus->tgl_verifikasi)) : date('d-m-Y') }}"
                                    readonly />
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $("#formVerif").submit(function(e) {
            e.preventDefault();
            var data = objectifyForm($('#formVerif').serializeArray());
            data._token = '{{ csrf_token() }}'
            data._method = 'PUT'
            $.post("{{ route('kasus.verif.save', ['idk' => $kasus->idp]) }}",
                data,
                function(data) {
                    if (data.status) {
                        Swal.fire(data.message, '', 'success');
                        window.location.reload();
                    } else {
                        console.log(data.message)
                        Swal.fire('Gagal Verif', data.message, 'error');
                    }
                })
        })

    });

    function objectifyForm(formArray) {
        //serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++) {
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }
</script>
