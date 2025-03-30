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
                                                            method="post" enctype="multipart/form-data" id="btn-submit">
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
                                                            <form id="btn-submit"
                                                                action="{{ route('member-konfirmasi-admin', $member->member_id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <button
                                                                    class="btn btn-success btn-sm m-1 rounded show_confirm"
                                                                    data-toggle="tooltip" >
                                                                    <span class="btn-label"><i
                                                                            class="fa fa-check"></i></span>
                                                                    Konfirmasi
                                                                </button>
                                                            </form>
                                                        @endif
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
    <div id="MemberModal"></div>
    <x-User-Footer></x-User-Footer>
</x-User-Layout>
