document.addEventListener('DOMContentLoaded', function () {
    //! Menyalakan Modal
    // var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    //     myModal.show();
    //! Akhir Modal
});

// document.getElementById("btn-submit").addEventListener("submit", function (event) {
//     // Tampilkan loading saat form dikirim
//     event.preventDefault();
//     document.getElementById("loading").classList.remove("visually-hidden");
//     setTimeout(() => {
//         // document.getElementById("loading").classList.add("visually-hidden");
//         event.target.submit();
//     }, 3000);
// });

//! IDK Part 2
WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["template/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
//! IDK Part 2 End

//! Text Editor
$('#summernote').summernote({
    height: 400,
     toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']], 
            ['view', ['fullscreen', 'codeview']]
        ]
});
//! End Text Editor

//!  Start Delete SweetAllert
$('.show_delete').click(function(event) {
    event.preventDefault();  // Menghentikan aksi default (misalnya pengiriman form)

    Swal.fire({
        title: "Yakin mau dihapus?",
        text: "Data yang dihapus akan hilang selamanya",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
        $(this).closest('form')[0].submit();
        }
    });
});
//!  End Delete SweetAllert

//!  Start Logout SweetAllert
$('.show_logout').click(function(event) {
    event.preventDefault();  // Menghentikan aksi default (misalnya pengiriman form)

    Swal.fire({
        title: "Yakin mau Logout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout"
    }).then((result) => {
        if (result.isConfirmed) {
        $(this).closest('form')[0].submit();
        }
    });
});
//!  End Logout SweetAllert

//! Start Validasi sukses
const suksesElement = document.getElementById('validasi-sukses');
    if (suksesElement) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",  // Ganti icon sesuai dengan pesan yang ingin ditampilkan
            title: suksesElement.textContent,
        });
    }
//! End Validasi sukses

//! Start Validasi gagal
const gagalElement = document.getElementById('validasi-gagal');
    if (gagalElement) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "error",  // Ganti icon sesuai dengan pesan yang ingin ditampilkan
            title: gagalElement.textContent
        });
    }
//! End Validasi gagal

//!  Start Konfirmasi SweetAllert
$('.show_confirm').click(function(event) {
    event.preventDefault();  // Menghentikan aksi default (misalnya pengiriman form)

    Swal.fire({
        title: "Sudah dikonfirmasi?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
        $(this).closest('form')[0].submit();
        }
    });
});
//!  End Konfirmasi SweetAllert

//! Yang berhubungan dengan EditNews
async function EditNews(dataNews){
    var publisher = "";
    try {
        let response = await fetch(`/login-info/${dataNews.login_id}`);
        let data = await response.json();
        publisher = data[0].username;
    } catch (error) {
        console.error('Error:', error);
    }
    let tglFormat = dataNews.date_publish.split("T")[0];
    let modalHtml = `
<div class="modal fade" id="exampleModal${dataNews.news_id}" tabindex="-1" aria-labelledby="exampleModalLabel${dataNews.news_id}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/news-update-admin/${dataNews.news_id}" method="post" enctype="multipart/form-data" id="btn-submit">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="oldThumbnail" value="${dataNews.picture_news}">
                <div class="modal-body d-flex">
    
                    <div class="container">
                        <div class="mt-2 text-center">
                            <p class="h3">Thumbnail Berita</p>
                            <img id="imageDisplay${dataNews.news_id}" src="img/news/${dataNews.picture_news}" class="img-fluid rounded-3 mb-1">
                            <input type="file" class="form-control w-50 mx-auto" id="imageInput${dataNews.news_id}" accept=".jpg,.jpeg,.png,.svg" name="thumbnail">
                        </div>
                        <div class="mt-2">
                            <label for="judul" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="judul" value="${dataNews.headline_news}" name="headline">
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="publisher" class="form-label">Nama Publisher</label>
                                <input type="text" class="form-control" id="publisher" value="${publisher}" readonly>
                            </div>
                            <div class="col">
                                <label for="tempat" class="form-label">Tempat Liputan</label>
                                <input type="text" class="form-control" id="tempat" value="${dataNews.covarage_area}" name="covarage">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="date" class="form-label">Tanggal Pembuatan</label>
                                <input type="date" class="form-control" id="date" readonly value="${tglFormat}" name="tanggal">
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
</div>`;

document.getElementById("NewsModal").innerHTML = modalHtml;

// Tampilkan modal menggunakan Bootstrap
    let modal = new bootstrap.Modal(document.getElementById(`exampleModal${dataNews.news_id}`));
    modal.show();

    setTimeout(() => {
        $(`#summernote${dataNews.news_id}`).summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }, 300);

    const imageInput = document.getElementById(`imageInput${dataNews.news_id}`);
    const imageDisplay = document.getElementById(`imageDisplay${dataNews.news_id}`);

    // Menambahkan event listener ketika file dipilih
    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0]; // Mengambil file yang dipilih
            if (file) {
                // Membaca file dan mengganti gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    imageDisplay.src = e.target.result; // Mengganti gambar yang ditampilkan
                };
                reader.readAsDataURL(file); // Membaca file gambar
            }
    });
}
//! End EditNews

function previewImages(event) {
    const files = event.target.files;
    const carouselInner = document.querySelector(".carousel-inner");
    let newImageCounter = 0; // Counter untuk memberi ID unik ke gambar baru

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


//! Start EditMember
async function EditMemberImg(member) {

    let response = await fetch(`/member-img-info/${member.member_id}`);
    let memberPicture = await response.json();

    let modalHtml = `
<div class="modal fade" id="exampleModal${member.member_id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/member-update/${member.member_id}" method="post" enctype="multipart/form-data"  id="btn-submit">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PUT">
                <div id="deletedImagesContainer"></div>
            <div class="modal-body d-flex">
                <div class="container col-4">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div id="imageCarousel${member.member_id}" class="carousel slide">
                            <div class="carousel-inner" id="carousel-inner">
                                ${memberPicture.map((picture, index) => `
                                    <div class="carousel-item ${index === 0 ? 'active' : ''}" id="image-${ picture.member_picture_id }">
                                        <img src="${window.location.origin}/img/member/${picture.member_picture}"
                                            class="d-block object-fit-cover w-100"
                                            alt="Slide ${index + 1}">
                                            <div class="carousel-caption d-none d-md-block">
                                                <button type="button" onclick="removeIMG('${picture.member_picture_id}')"
                                                    class="btn btn-danger">
                                                    Hapus Gambar
                                                </button>
                                            </div>
                                    </div>
                                `).join('')}
                            </div>
                            <div id="carousel-controls" class="${(memberPicture.length > 1) ? '' : 'invisible'}">
                                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel${member.member_id}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel${member.member_id}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="text-center form-control mt-3" id="newImages" name="new_images[]" multiple onchange="previewImages(event)" accept=".jpg,.jpeg,.png,.svg">
                </div>

                <div class="container">
                    <div class="d-flex">
                        <div class="col-7">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="${member.full_name}" required>
                        </div>
                        <div class="container">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="number" class="form-control" name="nim" id="nim" value="${member.nim}" required max="9999999999">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="form-control" name="description" rows="5">${member.description}</textarea>
                    </div>
                    <div class="mt-3">
                        <label for="Quote" class="form-label">Quote</label>
                        <textarea id="Quote" class="form-control" rows="3" required name="quote">${member.quote}</textarea>
                    </div>
                    <div class="mt-3 d-flex justify-content-between grid gap-3">
                        <div class="row col-8">
                            <div class="col">
                                <label for="Rarity" class="form-label">Rarity</label>
                                <select id="Rarity" class="form-select" name="rarity">
                                    <option value="" ${member.rarity ?? 'selected'  }>-Kosong-</option>
                                    <option value="SSR" ${member.rarity=='SSR' ? 'selected' : ''  }>SSR</option>
                                    <option value="SR" ${member.rarity=='SR' ? 'selected' : ''  }>SR</option>
                                    <option value="R" ${member.rarity=='R' ? 'selected' : ''  }>R</option>
                                    <option value="N" ${member.rarity=='N' ? 'selected' : ''  }>N</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="Rank" class="form-label">Rank</label>
                                
                                <select id="Rank" class="form-select" name="rank">
                                    <option value="" ${member.rank ?? 'selected'  }>-Kosong-</option>
                                    <option value="Ketua Angkatan" ${member.rank=='Ketua Angkatan' ? 'selected' : ''  }>Ketua Angkatan</option>
                                    <option value="Wakil Ketua Angkatan" ${member.rank=='Wakil Ketua Angkatan' ? 'selected' : ''  }>Wakil Ketua Angkatan</option>
                                    <option value="Bendahara" ${member.rank=='Bendahara' ? 'selected' : ''  }>Bendahara</option>
                                    <option value="Seketaris" ${member.rank=='Seketaris' ? 'selected' : ''  }>Seketaris</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="YearIn" class="form-label">Year In</label>
                                <input type="number" class="form-control" id="YearIn" name="yearin" value="${member.year_in}" readonly>
                            </div>
                            <div class="col">
                                <label for="YearOut" class="form-label">Year Out</label>
                                <input type="number" class="form-control" id="YearOut" name="yearout" value="${member.year_out || ''}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram" value="${member.instagram || ''}">
                        </div>
                        <div class="col">
                            <label for="Github" class="form-label">Github</label>
                            <input type="text" class="form-control" id="Github" name="github" value="${member.github || ''}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="LinkedID" class="form-label">LinkedID</label>
                            <input type="text" class="form-control" id="LinkedID" name="linkedid" value="${member.linkedid || ''}">
                        </div>
                        <div class="col">
                            <label for="Website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="Website" name="website" value="${member.website || ''}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>`;


document.getElementById("MemberModal").innerHTML = modalHtml;

// Tampilkan modal menggunakan Bootstrap
    let modal = new bootstrap.Modal(document.getElementById(`exampleModal${member.member_id}`));
    modal.show();
}

//! IDK Start
$("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
});

$("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
});

$("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
});

$(document).ready(function() {
            $("#basic-datatables").DataTable({});

            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });

            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });
            
            var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
            
            $("#addRowButton").click(function() {
                $("#add-row")
                .dataTable()
                .fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action,
                    ]);
                $("#addRowModal").modal("hide");
            });
});
//! IDK End

//! Yang berhubungan dengan caraousel Member
let selectedFiles = [];
let carouselInstance = null;

function removeImage(index) {
  selectedFiles.splice(index, 1);
  updateFileInput();
  renderCarousel();
}

function updateFileInput() {
  const dataTransfer = new DataTransfer();
  selectedFiles.forEach(fileData => dataTransfer.items.add(fileData.file));
  document.getElementById('imageInput').files = dataTransfer.files;
}

const defaultCarousel = document.getElementById('default-carousel');
function renderCarousel() {
  const carouselElement = document.getElementById('imageCarousel');
  const carouselInner = document.querySelector('.carousel-inner');
//   const carouselIndicators = document.querySelector('.carousel-indicators');
  const prevNextControls = document.getElementById('carousel-controls');

  // Clear existing content
  carouselInner.innerHTML = '';
//   carouselIndicators.innerHTML = '';
  
  // Handle empty state
  if (selectedFiles.length === 0) {
      // carouselElement.style.display = 'none';
    if (prevNextControls){
        prevNextControls.remove();
        carouselInner.appendChild(defaultCarousel);
    }
    return;
  } else if(selectedFiles.length > 1) {
    prevNextControls.classList.remove('invisible');
  }

  carouselElement.style.display = 'block';

  // Create carousel items
  selectedFiles.forEach((fileData, index) => {
    const carouselItem = document.createElement('div');
    carouselItem.className = `carousel-item ${index === 0 ? 'active' : ''}`;

    // Image element
    const img = document.createElement('img');
    img.className = 'd-block w-100';
    img.src = fileData.dataUrl;
    img.alt = `Uploaded image ${index + 1}`;

    // Remove button
    const removeBtn = document.createElement('button');
    removeBtn.className = 'btn btn-danger position-absolute top-0 end-0 m-2';
    removeBtn.innerHTML = 'X';
    removeBtn.onclick = () => removeImage(index);

    carouselItem.append(img, removeBtn);
    carouselInner.appendChild(carouselItem);

    // Create indicators
    const indicator = document.createElement('button');
    indicator.type = 'button';
    indicator.dataset.bsTarget = '#imageCarousel';
    indicator.dataset.bsSlideTo = index;
    indicator.className = index === 0 ? 'active' : '';
    indicator.setAttribute('aria-label', `Slide ${index + 1}`);
    // carouselIndicators.appendChild(indicator);
  });

  // Handle controls visibility
  const controlsContainer = document.querySelector('.carousel-controls');
  if (selectedFiles.length > 1) {
    if (!controlsContainer) {
      const controls = `
        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>`;
      
      const controlsWrapper = document.createElement('div');
      controlsWrapper.className = 'carousel-controls';
      controlsWrapper.innerHTML = controls;
      carouselElement.appendChild(controlsWrapper);
    }
  } else {
    if (controlsContainer) controlsContainer.remove();
  }

  // Initialize/refresh carousel
  if (carouselInstance) {
    carouselInstance.dispose();
  }
  carouselInstance = new bootstrap.Carousel(carouselElement, {
    interval: false
  });
  carouselInstance.appendChild = ``;
}

document.getElementById('imageInput').addEventListener('change', function(e) {
  const files = Array.from(e.target.files);
  selectedFiles = [];
  
  files.forEach((file, index) => {
    const reader = new FileReader();
    reader.onload = (event) => {
      selectedFiles.push({
        file: file,
        dataUrl: event.target.result
      });
      
      if (selectedFiles.length === files.length) {
        renderCarousel();
        updateFileInput();
      }
    };
    reader.readAsDataURL(file);
  });
});

//! Akhir caraousel Member

//! Yang berhubungan dengan gambar News
const imageInput = document.getElementById('imageInput');
const imageDisplay = document.getElementById('imageDisplay');

// Menambahkan event listener ketika file dipilih
imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0]; // Mengambil file yang dipilih
        if (file) {
            // Membaca file dan mengganti gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                imageDisplay.src = e.target.result; // Mengganti gambar yang ditampilkan
            };
            reader.readAsDataURL(file); // Membaca file gambar
        }
});
//! Akhir dengan gambar News

document.getElementById('tanggal').valueAsDate = new Date();
document.getElementById('waktu').value = new Date().toTimeString().slice(0, 5);