<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <div class="container col-4">
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                        <div id="imageCarousel" class="carousel slide">

                                            <div class="carousel-inner" id="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="https://placehold.co/400x500"
                                                        class="d-block object-fit-cover w-100" alt="Slide 1">
                                                </div>
                                            </div>

                                            <div class="carousel-indicators" id="carousel-indicators"></div>

                                        </div>
                                    </div>
                                    <input type="file" class="text-center form-control mt-3" id="imageInput"
                                        name="memberImage[]" multiple required>
                                </div>

                <div class="container">
                    <div class="d-flex">
                        <div class="col-7">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname">
                        </div>
                        <div class="container">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="number" class="form-control" id="nim">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="" id="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="Quote" class="form-label">Quote</label>
                        <textarea name="" id="Quote" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mt-3 d-flex justify-content-between grid gap-3">
                        <div class="row col-8">
                            <div class="col">
                                <label for="Rarity" class="form-label">Rarity</label>
                                <select name="" id="Rarity" class="form-select">
                                    <option value="">SSR</option>
                                    <option value="">SR</option>
                                    <option value="">R</option>
                                    <option value="">N</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="Rank" class="form-label">Rank</label>
                                <input type="text" class="form-control" id="YearOut">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="YearIn" class="form-label">Year In</label>
                                <input type="number" class="form-control" id="YearIn">
                            </div>
                            <div class="col">
                                <label for="YearOut" class="form-label">Year Out</label>
                                <input type="number" class="form-control" id="YearOut">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="instagram">
                        </div>
                        <div class="col">
                            <label for="Github" class="form-label">Github</label>
                            <input type="text" class="form-control" id="Github">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="LinkedID" class="form-label">LinkedID</label>
                            <input type="text" class="form-control" id="LinkedID">
                        </div>
                        <div class="col">
                            <label for="Website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="Website">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
