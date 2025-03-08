//! Menyalakan Modal
document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
});
//! Akhir Modal

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

//! Yang berhubungan dengan EditNews
function EditNews(dataNews){
    console.log(dataNews.news_id);
    
    let modalHtml = `
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
                            <img id="imageDisplay${dataNews.news_id}" src="img/news/${dataNews.picture_news}" class="img-fluid rounded-3 mb-1">
                            <input type="file" class="form-control w-50 mx-auto" id="imageInput${dataNews.news_id}" accept="image/*" name="thumbnail">
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

function renderCarousel() {
  const carouselElement = document.getElementById('imageCarousel');
  const carouselInner = document.querySelector('.carousel-inner');
  const carouselIndicators = document.querySelector('.carousel-indicators');
  const prevNextControls = document.querySelector('.carousel-controls');

  // Clear existing content
  carouselInner.innerHTML = '';
  carouselIndicators.innerHTML = '';
  
  // Handle empty state
  if (selectedFiles.length === 0) {
      // carouselElement.style.display = 'none';
    if (prevNextControls) prevNextControls.remove();
    return;
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
    carouselIndicators.appendChild(indicator);
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