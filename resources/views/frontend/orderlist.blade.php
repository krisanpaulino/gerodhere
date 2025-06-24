@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Transaksi Saya</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Daftar Transaksi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
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
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr class="product-box-contain">
                                            <td class="product-detail">
                                                <h4 class="table-title text-content">Tanggal Transaksi</h4>
                                                <h5 class="name">{{ $item->tanggal_transaksi }}</h5>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Total Produk</h4>
                                                <h5>Rp{{ number_format($item->total_produk) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Total Ongkir</h4>
                                                <h5>Rp{{ number_format($item->total_ongkir) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Total Bayar</h4>
                                                <h5>Rp{{ number_format($item->grand_total) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Status</h4>
                                                <h5>{{ $item->status_transaksi }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>

                                            <td class="save-remove">
                                                <h4 class="table-title text-content">Action</h4>
                                                @if ($item->read == 0)
                                                    <span class="badge bg-success">New
                                                    </span>
                                                    @php
                                                        $item->read = 1;
                                                        $item->save();
                                                    @endphp
                                                @endif
                                                <a class="save text-primary"
                                                    href="{{ route('order.detail', $item->transaksi_id) }}">Lihat detail
                                                </a>
                                                @if ($item->status_transaksi == 'proses' && $item->komplain == null)
                                                    <a class="save text-dark" data-bs-toggle="modal"
                                                        data-bs-target="#komplain" data-id="{{ $item->transaksi_id }}"
                                                        href="javascript:;">Buat Komplain
                                                    </a>
                                                @endif

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
    </section>
    <!-- Cart Section End -->
    <div class="modal fade theme-modal view-modal" id="komplain" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Buat Komplain</h2>
                    <div class="row g-sm-4 mt-5 g-2">
                        <div class="col-lg-12">
                            <div class="right-sidebar-modal">
                                <form action="{{ route('komplain.post') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="transaksi_id" id="kodeitem" value="">
                                    <div class="col-12 mb-4">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <textarea style="height: 191px" name="isi_komplain" class="form-control"></textarea>
                                            <label for="isi_komplain">Komplain</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input name="gambar_komplain" class="form-control" type="file" required>
                                            <label for="gambar_komplain">Gambar</label>
                                        </div>
                                    </div>
                                    <div class="modal-button">
                                        <button class="btn btn-md add-cart-button icon" type="submit">Kirim
                                            Komplain</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#komplain').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            $(this).find('#kodeitem').attr("value", kode);
        });
    </script>
@endsection
