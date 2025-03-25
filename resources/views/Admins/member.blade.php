<x-User-Layout>
    @if (session('sukses'))
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

                            <a href="/member-add-admin" class="btn btn-primary rounded">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                Add New Member
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $member)
                                            <tr>
                                                <td>{{ $member->full_name }}</td>
                                                <td>{{ $member->nim }}</td>
                                                <td class="text-center">
                                                    @if ($member->status === 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-success">Complete</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('member-destroy-admin', $member->member_id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-danger btn-sm m-1 rounded show_delete"
                                                                data-toggle="tooltip">
                                                                <span class="btn-label"><i
                                                                        class="fa fa-trash"></i></span>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-warning rounded btn-sm m-1"
                                                            type="button" onclick='EditMemberImg({!! json_encode($member) !!})'
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $member->member_id }}">
                                                            <span class="btn-label"><i class="fa fa-edit"></i></span>
                                                            Edit
                                                        </button>
                                                        @if ($member->status === 0)
                                                            <form
                                                                action="{{ route('member-konfirmasi-admin', $member->member_id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <button
                                                                    class="btn btn-success btn-sm m-1 rounded show_confirm"
                                                                    data-toggle="tooltip">
                                                                    <span class="btn-label"><i
                                                                            class="fa fa-check"></i></span>
                                                                    Konfirmasi
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            {{--! Modal --}}
                                            {{-- <div class="modal fade" id="exampleModal{{ $member->member_id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Member
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex">
                                                            <div class="container col-4">
                                                                <div id="carouselExample" class="carousel slide"
                                                                    data-bs-ride="carousel">
                                                                    <div id="imageCarousel" class="carousel slide">

                                                                        <div class="carousel-inner" id="carousel-inner">
                                                                            <div class="carousel-item active">
                                                                                <img src="https://placehold.co/400x500"
                                                                                    class="d-block object-fit-cover w-100"
                                                                                    alt="Slide 1">
                                                                            </div>
                                                                        </div>

                                                                        <div class="carousel-indicators"
                                                                            id="carousel-indicators"></div>

                                                                    </div>
                                                                </div>
                                                                <input type="file"
                                                                    class="text-center form-control mt-3"
                                                                    id="imageInput" name="memberImage[]" multiple
                                                                    required>
                                                            </div>

                                                            <div class="container">
                                                                <div class="d-flex">
                                                                    <div class="col-7">
                                                                        <label for="fullname" class="form-label">Full
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="fullname" value="{{ $member->full_name }}" required>
                                                                    </div>
                                                                    <div class="container">
                                                                        <label for="nim"
                                                                            class="form-label">NIM</label>
                                                                        <input type="number" class="form-control"
                                                                            id="nim" value="{{ $member->nim }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="description"
                                                                        class="form-label">Description</label>
                                                                    <textarea name="" id="description" class="form-control" rows="5">{{ $member->description }}</textarea>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="Quote"
                                                                        class="form-label">Quote</label>
                                                                    <textarea name="" id="Quote" class="form-control" rows="3" required>{{ $member->quote }}</textarea>
                                                                </div>
                                                                <div
                                                                    class="mt-3 d-flex justify-content-between grid gap-3">
                                                                    <div class="row col-8">
                                                                        <div class="col">
                                                                            <label for="Rarity"
                                                                                class="form-label">Rarity</label>
                                                                            <select name="" id="Rarity"
                                                                                class="form-select">
                                                                                <option value="">SSR</option>
                                                                                <option value="">SR</option>
                                                                                <option value="">R</option>
                                                                                <option value="">N</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="Rank"
                                                                                class="form-label">Rank</label>
                                                                            <input type="text" class="form-control"
                                                                                id="Rank" value="{{ $member->rank }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="YearIn"
                                                                                class="form-label">Year In</label>
                                                                            <input type="number" class="form-control"
                                                                                id="YearIn" value="{{ $member->year_in }}" readonly>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="YearOut"
                                                                                class="form-label">Year Out</label>
                                                                            <input type="number" class="form-control"
                                                                                id="YearOut" value="{{ $member->year_out }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="instagram"
                                                                            class="form-label">Instagram</label>
                                                                        <input type="text" class="form-control"
                                                                            id="instagram" value="{{ $member->instagram }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Github"
                                                                            class="form-label">Github</label>
                                                                        <input type="text" class="form-control"
                                                                            id="Github" value="{{ $member->github }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col">
                                                                        <label for="LinkedID"
                                                                            class="form-label">LinkedID</label>
                                                                        <input type="text" class="form-control"
                                                                            id="LinkedID" value="{{ $member->linkedid }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Website"
                                                                            class="form-label">Website</label>
                                                                        <input type="text" class="form-control"
                                                                            id="Website" value="{{ $member->website }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-primary rounded">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
    <div id="MemberModal"></div>
</x-User-Layout>
