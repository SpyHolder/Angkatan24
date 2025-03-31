<x-User-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">New Members</h4>

                            <form
                                action="{{ empty($dataLogin) ? route('member-store') : route('member-update', $dataLogin->member_id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @if (!empty($dataLogin))
                                    @method('PUT')
                                @endif
                                <button class="btn btn-primary rounded" id="btn-submit">
                                    <span class="btn-label"><i class="fa fa-save"></i></span>
                                    Save
                                </button>
                                <div id="deletedImagesContainer"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="container col-4">
                                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                            <div id="imageCarousel" class="carousel slide">
                                                <div class="carousel-inner" id="carousel-inner">

                                                    @if (empty($dataLogin))
                                                    <div class="carousel-item active" id="default-carousel">
                                                        <img src="https://placehold.co/400x500"
                                                        class="d-block object-fit-cover w-100"
                                                        alt="Slide 1">
                                                    </div>
                                                    @else
                                                    @foreach ($dataLogin->relasiMany as $key => $image)
                                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                                                id="image-{{ $image->member_picture_id }}">
                                                                <img src="{{ asset('img/member/' . $image->member_picture) }}"
                                                                    class="d-block w-100" width="100">
                                                                <div class="carousel-caption d-none d-md-block">
                                                                    <button type="button"
                                                                        onclick="removeIMG('{{ $image->member_picture_id }}')"
                                                                        class="btn btn-danger">
                                                                        Hapus Gambar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                </div>
                                                <div id="carousel-controls" class="invisible">
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#imageCarousel" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"></span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#imageCarousel" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @if (empty($dataLogin))
                                        <input type="file" class="text-center form-control mt-3" id="imageInput"
                                            name="memberImage[]" multiple required accept=".jpg,.jpeg,.png,.svg">
                                    @else
                                        <input type="file" id="newImages" class="text-center form-control mt-3" name="new_images[]" multiple accept=".jpg,.jpeg,.png,.svg" onchange="previewImages(event)">
                                    @endif
                                </div>

                                <div class="container">
                                    <div class="d-flex">
                                        <div class="col-7">
                                            <label for="fullname" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                required value="{{ $dataLogin->full_name ?? '' }}" placeholder="Masukkan nama lengkap">
                                        </div>
                                        <div class="container">
                                            <label for="nim" class="form-label">NIM</label>
                                            <input type="number" class="form-control" id="nim" name="nim"
                                                required value="{{ $dataLogin->nim ?? '' }}" max="9999999999">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Berikan deskripsi diri kalian">{{ $dataLogin->description ?? '' }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="Quote" class="form-label">Quote</label>
                                        <textarea name="quote" id="Quote" class="form-control" rows="3" placeholder="Masukkan quote Yang Sesuai denga kalian">{{ $dataLogin->quote ?? '' }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="YearIn" class="form-label">Year In</label>
                                            <input value="2024" name="yearin" type="number" class="form-control"
                                                id="YearIn" readonly value="{{ $dataLogin->year_in ?? '' }}">
                                        </div>
                                        <div class="col">
                                            <label for="YearOut" class="form-label">Year Out</label>
                                            <input type="number" class="form-control" id="YearOut" name="yearout"
                                                minlength="4" min="2023" max="2069" placeholder="YYYY"
                                                value="{{ $dataLogin->year_out ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="url" class="form-control" id="instagram"
                                                name="instagram" value="{{ $dataLogin->instagram ?? '' }}" placeholder="Masukkan URL Instagram">
                                        </div>
                                        <div class="col">
                                            <label for="Github" class="form-label">Github</label>
                                            <input type="url" class="form-control" id="Github" name="github"
                                                value="{{ $dataLogin->github ?? '' }}" placeholder="Masukkan URL Github">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="LinkedID" class="form-label">LinkedID</label>
                                            <input type="url" class="form-control" id="LinkedID"
                                                name="linkedid" value="{{ $dataLogin->linkedid ?? '' }}" placeholder="Masukkan URL LinkedIn">
                                        </div>
                                        <div class="col">
                                            <label for="Website" class="form-label">Website</label>
                                            <input type="url" class="form-control" id="Website" name="website"
                                                value="{{ $dataLogin->website ?? '' }}" placeholder="Masukkan URL Website">
                                        </div>
                                    </div>
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

    <script>
        let newImageCounter = 0; // Counter untuk memberi ID unik ke gambar baru

        function previewImages(event) {
            const files = event.target.files;
            const carouselInner = document.querySelector(".carousel-inner");

            for (let file of files) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    newImageCounter++; // Tambah ID unik
                    let newImageId = `new-image-${newImageCounter}`;

                    let newItem = document.createElement("div");
                    newItem.classList.add("carousel-item");
                    newItem.setAttribute("id", newImageId); // Tambahkan ID unik

                    newItem.innerHTML = `
                <img src="${e.target.result}" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <button type="button"
                        onclick="removeIMG('${newImageId}')"
                        class="btn btn-danger">
                        Hapus Gambar
                    </button>
                </div>
            `;

                    carouselInner.appendChild(newItem);

                    // Jika ini gambar pertama yang baru diunggah, jadikan aktif
                    if (carouselInner.children.length === files.length + document.querySelectorAll(".carousel-item")
                        .length) {
                        newItem.classList.add("active");
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        function removeIMG(imageId) {
            const imageDiv = document.getElementById(`image-${imageId}`); // Untuk gambar lama
            const imageDivNew = document.getElementById(imageId); // Untuk gambar baru
            const hiddenInputContainer = document.getElementById("deletedImagesContainer");
            let imageDivActive = null;

            // Cari gambar berikutnya untuk dijadikan active
            if (imageDiv && imageDiv.nextElementSibling) {
                imageDivActive = imageDiv.nextElementSibling;
            } else if (imageDivNew && imageDivNew.nextElementSibling) {
                imageDivActive = imageDivNew.nextElementSibling;
            } else {
                // Jika tidak ada next sibling, coba cari gambar sebelumnya
                if (imageDiv && imageDiv.previousElementSibling) {
                    imageDivActive = imageDiv.previousElementSibling;
                } else if (imageDivNew && imageDivNew.previousElementSibling) {
                    imageDivActive = imageDivNew.previousElementSibling;
                }
            }

            // Hapus elemen gambar
            if (imageDiv) {
                imageDiv.remove();
            }
            if (imageDivNew) {
                imageDivNew.remove();
            }

            // Jadikan gambar berikutnya aktif jika ada
            if (imageDivActive) {
                imageDivActive.classList.add('active');
            }

            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "delete_images[]";
            input.value = imageId;
            hiddenInputContainer.appendChild(input);

            // Jika gambar baru dihapus, kosongkan input file
            const fileInput = document.getElementById("newImages");
            if (fileInput) {
                let dataTransfer = new DataTransfer();
                for (let i = 0; i < fileInput.files.length; i++) {
                    let file = fileInput.files[i];
                    if (imageId !== `new-image-${i + 1}`) { // Pastikan hanya file yang tidak dihapus tetap ada
                        dataTransfer.items.add(file);
                    }
                }
                fileInput.files = dataTransfer.files;
            }
        }
    </script>

</x-User-Layout>
