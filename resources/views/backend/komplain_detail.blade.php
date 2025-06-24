@extends('template.admin')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $title ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= route('admin') ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?= route('komplain.index') ?>">Komplain</a>
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
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="row contacts d-flex justify-content-between">
                        <h6 class="mb-4 text-uppercase">Detail Transaksi</h6>
                        <div class="col-4 invoice-details">
                            <div class="date">Order ID: <a href="{{ route('transaksi.detail', $komplain->transaksi_id) }}"
                                    class=""> {{ $komplain->transaksi->order_id }}</a></div>
                            <div class="date">Pelanggan: {{ $komplain->transaksi->pelanggan->nama_pelanggan }}</div>
                            <div class="date">Email: {{ $komplain->transaksi->pelanggan->user->email }}</div>
                            <div class="date">Tanggal Transaksi: {{ $komplain->transaksi->tanggal_transaksi }}</div>
                            <div class="date">Tanggal Pembayaran: {{ $komplain->transaksi->pembayaran->tanggal_bayar }}
                            </div>
                            <div class="date">Status Transaksi: <b
                                    class="text-primary font-weight-bold">{{ $komplain->transaksi->status_transaksi }}</b>
                            </div>
                            <div class="date">Alamat Pengiriman: <b
                                    class="text-primary font-weight-2">{{ $komplain->transaksi->alamat_pengiriman }}</b>
                            </div>
                            <div class="date">Status Pengiriman: <b
                                    class="text-primary font-weight-2">{{ $komplain->transaksi->pengiriman->status_pengiriman }}</b>
                            </div>

                        </div>
                        <div class="col-6">
                            <h6 class="mb-4 text-uppercase">Komplain</h6>
                            @if ($komplain->gambar_komplain != null)
                                <img src="{{ asset('storage/' . $komplain->gambar_komplain) }}" alt=""
                                    class="img-thumbnail">
                            @endif
                            <p class="fs-3">{{ $komplain->isi_komplain }}</p>
                            <a href="mail:to" target="_blank" class="btn btn-primary">Buat Email Balasan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
