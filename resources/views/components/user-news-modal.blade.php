<div class="modal fade" id="exampleModal${dataNews.news_id}" tabindex="-1" aria-labelledby="exampleModalLabel${dataNews.news_id}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/news-update/${dataNews.news_id}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="oldThumbnail" value="${dataNews.picture_news}">
                <div class="modal-body d-flex">
    
                    <div class="container">
                        <div class="mt-2 text-center">
                            <p class="h3">Thumbnail Berita</p>
                            <img id="imageDisplay" src="img/news/${dataNews.picture_news}" class="img-fluid rounded-3 mb-1">
                            <input type="file" class="form-control w-50 mx-auto" id="imageInput" accept="image/*" name="thumbnail">
                        </div>
                        <div class="mt-2">
                            <label for="judul" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="judul" value="${dataNews.headline_news}" name="headline">
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="publisher" class="form-label">Nama Publisher</label>
                                <input type="text" class="form-control" id="publisher" value="${dataNews.publisher}" name="publisher">
                            </div>
                            <div class="col">
                                <label for="tempat" class="form-label">Tempat Liputan</label>
                                <input type="text" class="form-control" id="tempat" value="${dataNews.covarage_area}" name="covarage">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="date" class="form-label">Tanggal Pembuatan</label>
                                <input type="date" class="form-control" id="date" readonly value="${dataNews.date_publish}" name="tanggal">
                            </div>
                            <div class="col">
                                <label for="time" class="form-label">Waktu Pembuatan</label>
                                <input type="time" class="form-control" id="time" readonly value="${dataNews.time_publish}" name="waktu">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="description" class="form-label">Isi Berita</label>
                            <textarea name="content" id="summernote${dataNews.news_id}" class="form-control">${dataNews.content_news}</textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary rounded">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>