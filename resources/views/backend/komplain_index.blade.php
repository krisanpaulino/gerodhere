@extends('template.admin')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $title ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= route('admin') ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @if (Session::has('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ Session::get('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('danger'))
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ Session::get('danger') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <hr />
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-uppercase">Komplain</h6>
            <div class="table-responsive">
                <table id="example" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaksi</th>
                            <th>Tanggal Komplain</th>
                            <th>Isi Komplain</th>
                            <th>Dengan Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($komplain as $row)
                            <tr class="{{ $row->read == 0 ? 'bg-success' : '' }}">

                                <td>{{ $i++ }}
                                    @if ($row->read == 0)
                                        <span class="badge bg-warning">New</span>
                                    @endif
                                </td>
                                <td>{{ $row->transaksi->order_id }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->isi_komplain }}</td>
                                <td>{{ $row->gambar_komplain != null ? 'ya' : 'tidak' }}</td>
                                <td>
                                    <a href="{{ route('komplain.detail', $row->komplain_id) }}"
                                        class="badge bg-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('cssplugins')
    <link href="{{ asset('/') }}plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('jsplugins')
    <script src="{{ asset('/') }}plugins/datatable/js/jquery.dataTables.min.js"></script>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
