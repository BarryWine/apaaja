@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('To Do List') }}</div>

                <div class="card-body">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambahkan Kegiatan
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Kegiatan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('simpan') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Hari</label>
                                            <select class="form-control" name="hari">
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                                <option value="Minggu">Minggu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Kegiatan</label>
                                            <textarea class="form-control" name="kegiatan"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="Belum Mulai">Belum Mulai</option>
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="SIMPAN" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>Hari</td>
                            <td>Tanggal</td>
                            <td>Kegiatan</td>
                            <td>Status</td>
                            <td>Edit</td>
                            <td>Hapus</td>
                        </tr>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->hari }}</td>
                            <td>{{$data->tanggal }}</td>
                            <td>{{$data->kegiatan }}</td>
                            <td>
                                @if ($data->status== 'Belum Mulai')
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Belum Mulai']) }}" class="btn btn-primary">Belum Mulai</a>
                                @else
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Belum Mulai']) }}" class="btn btn-outline-primary">Belum Mulai</a>
                                @endif

                                @if ($data->status == 'Proses')
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Proses']) }}" class="btn btn-primary">Proses</a>
                                @else
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Proses']) }}" class="btn btn-outline-primary">Proses</a>
                                @endif

                                @if ($data->status == 'Selesai')
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Selesai']) }}" class="btn btn-primary">Selesai</a>
                                @else
                                <a href="{{ route('ubahStatus',['idkegiatan' => $data->id, 'status' => 'Selesai']) }}" class="btn btn-outline-primary">Selesai</a>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="{{ $data->id }}"
                                    data-hari="{{ $data->hari }}"
                                    data-kegiatan="{{ $data->kegiatan }}">
                                    Edit
                                </button>
                            </td>

                            <td>
                                <form method="POST" action="{{ route('hapus', $data->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="hapus" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kegiatan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('edit') }}">
                        @csrf
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari" id="edit-hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kegiatan</label>
                            <textarea class="form-control" name="kegiatan" id="edit-kegiatan"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Perbarui" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit-id').value = this.dataset.id;
                document.getElementById('edit-hari').value = this.dataset.hari;
                document.getElementById('edit-kegiatan').value = this.dataset.kegiatan;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let elements = document.querySelectorAll(".tanggal-waktu");

            elements.forEach(function(element) {
                let timestamp = element.getAttribute("data-timestamp");
                let date = new Date(timestamp);

                // Format tanggal dengan jam sesuai device user
                let formattedDate = date.toLocaleString("id-ID", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit",
                    hour12: false, // Gunakan format 24 jam
                    timeZoneName: "short"
                });

                element.textContent = formattedDate;
            });
        });
    </script>



    @endsection
