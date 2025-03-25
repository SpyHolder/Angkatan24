<x-User-Layout>
    @if(session('sukses'))
        <div id="validasi-sukses" style="display: none;">{{ session('sukses') }}</div>
    @elseif (session('gagal'))
        <div id="validasi-gagal" style="display: none;">{{ session('gagal') }}</div>
    @endif
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <a href="/news-add-admin" class="btn btn-primary rounded">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                Add New News
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Judul Berita</th>
                                            <th>Publisher</th>
                                            <th>Tanggal & Waktu Pembuatan</th>
                                            <th>Tempat Berita</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loginNews as $berita)
                                        <tr>
                                            <td class="col-5 text-truncate" style="max-width: 150px;">{{ $berita->headline_news }}</td>
                                            <td>{{ $berita->login->username }}</td>
                                            <td class="text-center">{{ $berita->date_publish }} {{ $berita->time_publish }}</td>
                                            <td>{{ $berita->covarage_area }}</td>
                                            <td class="text-center">
                                                @if ($berita->status == 0)    
                                                    <span class="badge badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-success">Complete</span>
                                                @endif
                                            </td>
                                            <td class="col-5">
                                                <div class="d-flex justify-content-center">
                                                    <form id="destroy" action="{{ route('news-destroy-admin',$berita->news_id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger m-1 rounded show_delete" data-toggle="tooltip" type="submit">
                                                            <span class="btn-label"><i class="fa fa-trash"></i></span>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-warning rounded m-1" type="button" onclick='EditNews({!! json_encode($berita) !!})'>
                                                        <span class="btn-label"><i class="fa fa-edit"></i></span>
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('news-konfirmasi-admin',$berita->news_id) }}" method="post"enctype="multipart/form-data" >
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-success m-1 rounded show_confirm" type="submit" data-toggle="tooltip" {{ $berita->status == 1 ? 'hidden' : '' }}>
                                                            <span class="btn-label"><i class="fa fa-check"></i></span>
                                                            Konfirmasi
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="NewsModal"></div>

</x-User-Layout>