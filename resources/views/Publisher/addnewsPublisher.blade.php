<x-User-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">New News</h4>

                            <form action="{{ route('news-store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-primary rounded">
                                    <span class="btn-label"><i class="fa fa-save"></i></span>
                                    Save
                                </button>
                        </div>
                        <div class="card-body">

                            <div class="container px-5">
                                <div class="mt-2 text-center">
                                    <p class="h3">Thumbnail Berita</p>
                                    <img id="imageDisplay" src="https://placehold.co/700x400"
                                        class="img-fluid rounded-3 mb-1">
                                    <input type="file" class="form-control w-50 mx-auto" id="imageInput"
                                        accept="image/*" name='thumbnail' accept=".jpeg,.png,.jpg,.gif,.svg" required>
                                </div>
                                <div class="mt-2">
                                    <label for="headline" class="form-label">Judul Berita</label>
                                    <input type="text" class="form-control" id="headline" name="headline" required>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="publisher" class="form-label">Nama Publisher</label>
                                        <input type="text" class="form-control" id="publisher" value="{{ $loginID->username }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="tempat" class="form-label">Tempat Liputan</label>
                                        <input type="text" class="form-control" id="tempat" name="covarage" required>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="tanggal" class="form-label">Tanggal Pembuatan</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="waktu" class="form-label">Waktu Pembuatan</label>
                                        <input type="time" class="form-control" id="waktu" name="waktu" readonly>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="isi" class="form-label">Isi Berita</label>
                                    <textarea name="content" id="summernote" class="form-control" required></textarea>
                                </div>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-User-Layout>
