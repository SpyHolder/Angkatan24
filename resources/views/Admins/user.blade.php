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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataLogin as $index => $data)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $data->username }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td class="text-center">{{ $data->role }}</td>
                                                <td class="col-5">
                                                    <div class="d-flex justify-content-center">
                                                        <form id="destroy"
                                                            action="{{ route('user-destroy-admin', $data->login_id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-sm btn-danger m-1 rounded show_delete"
                                                                data-toggle="tooltip" type="submit">
                                                                <span class="btn-label"><i
                                                                        class="fa fa-trash"></i></span>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-sm btn-warning rounded m-1"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $data->login_id }}">
                                                            <span class="btn-label"><i class="fa fa-edit"></i></span>
                                                            Edit
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="exampleModal{{ $data->login_id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                                User</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('user-edit-admin',$data->login_id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <label for="username" class="form-label">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        id="username" name="username" required value="{{ $data->username }}">
                                                                </div>
                                                                <div class="container">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="text" class="form-control"
                                                                        id="email" name="email" required value="{{ $data->email }}">
                                                                </div>
                                                                <div class="container">
                                                                    <label for="role" class="form-label">Role</label>
                                                                    <select name="role" id="role" class="form-select">
                                                                        <option value="admin" {{ $data->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="member" {{ $data->role === 'member' ? 'selected' : '' }}>Member</option>
                                                                        <option value="publisher" {{ $data->role === 'publisher' ? 'selected' : '' }}>Publisher</option>
                                                                    </select>
                                                                </div>
                                                                <div class="container">
                                                                    <label for="newPassword" class="form-label">New Password</label>
                                                                    <input type="text" class="form-control"
                                                                        id="newPassword" name="newPassword">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

</x-User-Layout>
