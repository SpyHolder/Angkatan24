<x-User-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">New Members</h4>

                            <form action="{{ empty($dataLogin) ? route('member-store') : route('member-update',$dataLogin->member_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (!empty($dataLogin))
                                    @method('PUT')
                                @endif
                                <button class="btn btn-primary rounded">
                                    <span class="btn-label"><i class="fa fa-save"></i></span>
                                    Save
                                </button>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
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
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                            required value="{{ $dataLogin->full_name ?? '' }}">
                                        </div>
                                        <div class="container">
                                            <label for="nim" class="form-label">NIM</label>
                                            <input type="number" class="form-control" id="nim" name="nim"
                                                required value="{{ $dataLogin->nim ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="5">{{ $dataLogin->description ?? '' }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="Quote" class="form-label">Quote</label>
                                        <textarea name="quote" id="Quote" class="form-control" rows="3">{{ $dataLogin->quote ?? '' }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="YearIn" class="form-label">Year In</label>
                                            <input value="2024" name="yearin" type="number"
                                                class="form-control" id="YearIn" readonly value="{{ $dataLogin->year_in ?? '' }}">
                                        </div>
                                        <div class="col">
                                            <label for="YearOut" class="form-label">Year Out</label>
                                            <input type="number" class="form-control" id="YearOut"
                                                name="yearout" minlength="4" min="2023" placeholder="YYYY" value="{{ $dataLogin->year_out ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" class="form-control" id="instagram"
                                                name="instagram" value="{{ $dataLogin->instagram ?? '' }}">
                                        </div>
                                        <div class="col">
                                            <label for="Github" class="form-label">Github</label>
                                            <input type="text" class="form-control" id="Github"
                                                name="github" value="{{ $dataLogin->github ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="LinkedID" class="form-label">LinkedID</label>
                                            <input type="text" class="form-control" id="LinkedID"
                                                name="linkedid" value="{{ $dataLogin->linkedid ?? '' }}">
                                        </div>
                                        <div class="col">
                                            <label for="Website" class="form-label">Website</label>
                                            <input type="text" class="form-control" id="Website"
                                                name="website" value="{{ $dataLogin->website ?? '' }}">
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

</x-User-Layout>
