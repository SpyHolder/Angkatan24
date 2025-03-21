<x-User-Layout>
    @if(session('sukses'))
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

                            <a href="/user-add" class="btn btn-primary rounded">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                Add New User Login
                            </a>
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
                                                    <form id="destroy" action="{{ route('user-destroy',$data->login_id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger m-1 rounded show_delete" data-toggle="tooltip" type="submit">
                                                            <span class="btn-label"><i class="fa fa-trash"></i></span>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-warning rounded m-1" type="button" onclick='EditNews({!! json_encode($data) !!})'>
                                                        <span class="btn-label"><i class="fa fa-edit"></i></span>
                                                        Edit
                                                    </button>
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
    <div id="NewsModal"></div>

</x-User-Layout>