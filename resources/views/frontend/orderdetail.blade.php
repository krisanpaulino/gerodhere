@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Detail Transaksi</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Detail Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-md-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Alamat Penerima</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>

                                                            <div class="label">
                                                                <label>Alamat Kirim</label>
                                                            </div>

                                                            <ul class="delivery-address-detail">
                                                                <li>
                                                                    <h4 class="fw-500">{{ $pelanggan->nama_pelanggan }}</h4>
                                                                </li>

                                                                <li>
                                                                    <p class="text-content"><span class="text-title">Alamat
                                                                            : </span>{{ $transaksi->alamat_transaki }},
                                                                        {{ $transaksi->alamat_region }},
                                                                </li>

                                                                <li>
                                                                    <h6 class="text-content"><span class="text-title">Kode
                                                                            Pos
                                                                            :</span> {{ $pelanggan->kode_pos }}</h6>
                                                                </li>

                                                                <li>
                                                                    <h6 class="text-content mb-0"><span
                                                                            class="text-title">Telp.
                                                                            :</span> {{ $pelanggan->kontak_pelanggan }}</h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Status Pengiriman</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>


                                                            <ul class="delivery-address-detail">
                                                                @if ($transaksi->pengiriman != null)
                                                                    <li>
                                                                        <span
                                                                            class="text-success fs-4">{{ $transaksi->pengiriman->status_pengiriman }}</span>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Pembayaran</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-9">

                                                    <div class="delivery-option">
                                                        <div class="delivery-category">
                                                            <div class="shipment-detail">
                                                                <div class="form-check custom-form-check hide-check-box">
                                                                    <div class="col-12">
                                                                        <div id="snap-container"></div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <p class="font-weigth-bold">Metode Pembayaran
                                                                            :
                                                                            {{ $pembayaran->metode->nama_metode }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-12">
                                                <b>Status Pembayaran :
                                                    {{ $transaksi->pembayaran->status_pembayaran }}</b>
                                            </div>

                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Rincian Pesanan</h3>
                            </div>

                            <ul class="summery-contain">
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($transaksi->detail as $item)
                                    <li>
                                        <img src="{{ asset('storage/' . $item->produk->gambar_produk) }}"
                                            class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>{{ $item->produk->nama_produk }} <span>X {{ $item->kuantitas }}</span></h4>
                                        <h4 class="price">
                                            Rp{{ number_format($item->produk->harga_produk * $item->kuantitas) }}</h4><br>

                                    </li>
                                    @if ($transaksi->status_transaksi == 'selesai' && $item->ulasan == null)
                                        <li class="mb-2">
                                            <div class="row">
                                                <a data-bs-toggle="modal" data-bs-target="#rate2"
                                                    class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold"
                                                    type="button" data-id="{{ $item->detailtransaksi_id }}">Berikan
                                                    Rating</a>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($item->ulasan != null)
                                        <li>
                                            <div class="row">
                                                <div class="star-rating animated-stars">
                                                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                                                    <?php if ($i <= $item->rating) : ?>
                                                    <label><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#f9ca48"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#f9ca48"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <?php else : ?>
                                                    <label for=""><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <?php endif ?>
                                                    <?php endfor ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-2 mt-0">
                                            <p class="fw-bold text-muted">Ulasan : </p>
                                            <p class=" ml-2 small text-muted fst-italic">{{ $item->ulasan }}</p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                            <ul class="summery-total">
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">Rp{{ number_format($transaksi->total_produk) }}</h4>
                                </li>

                                <li>
                                    <h4>Shipping</h4>
                                    <h4 class="price" id="ongkir">Rp{{ number_format($transaksi->total_ongkir) }}
                                    </h4>
                                </li>


                                {{-- <li>
                                    <h4>Coupon/Code</h4>
                                    <h4 class="price">$-23.10</h4>
                                </li> --}}

                                <li class="list-total">
                                    <h4>Total (IDR)</h4>
                                    <h4 class="price" id="grand_total">Rp{{ number_format($transaksi->grand_total) }}
                                    </h4>
                                </li>
                            </ul>
                        </div>

                        {{-- <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">Buat --}}
                        {{-- Pesanan</button> --}}
                    </div>
                    @if ($transaksi->komplain != null)
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>Komplain</h3>
                                    <p class="text-primary">** Komplain sudah diterima dan akan dibalas via
                                        email.</p>
                                </div>

                                <ul class="summery-contain">

                                    <li class="mb-2 mt-0">
                                        <p class="fw-bold text-muted">Isi Komplain : </p>
                                        <p class=" ml-2 small text-muted fst-italic">
                                            {{ $transaksi->komplain->isi_komplain }}</p>
                                    </li>
                                    <li class="mb-2 mt-0">
                                        <p class=" ml-2 small text-muted fst-italic">
                                            <img src="{{ asset('storage/' . $transaksi->komplain->gambar_komplain) }}"
                                                alt="Komplain" class="img-thumbnail">
                                        </p>
                                    </li>

                                </ul>

                            </div>

                            {{-- <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">Buat --}}
                            {{-- Pesanan</button> --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
    <div class="modal fade theme-modal view-modal" id="rate2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-12">
                            <div class="right-sidebar-modal">
                                <form action="{{ route('ulasan.post') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="detailtransaksi_id" id="kodeitem" value="">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <div class="rating-card p-4">
                                                <h5 class="mb-4">Rating</h5>
                                                <div class="star-rating animated-stars">
                                                    <input type="radio" id="star5" name="rating" value="5">
                                                    <label for="star5"><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                            class="svgstar" height="64px"
                                                            viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <input type="radio" id="star4" name="rating" value="4">
                                                    <label for="star4"><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                            height="64px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <input type="radio" id="star3" name="rating" value="3">
                                                    <label for="star3"><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                            height="64px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <input type="radio" id="star2" name="rating" value="2">
                                                    <label for="star2"><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                            height="64px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                    <input type="radio" id="star1" name="rating" value="1">
                                                    <label for="star1"><svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                            height="64px" viewBox="-12.8 -12.8 89.60 89.60"
                                                            enable-background="new 0 0 64 64" xml:space="preserve"
                                                            fill="#dddddd" stroke="#dddddd">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478 M31.998,0 c-0.775,0-1.48,0.448-1.811,1.15l-8.815,18.778L1.698,22.935c-0.741,0.113-1.356,0.632-1.595,1.343 c-0.238,0.71-0.059,1.494,0.465,2.031l14.294,14.657L11.484,61.67c-0.124,0.756,0.195,1.517,0.822,1.957 c0.344,0.243,0.747,0.366,1.151,0.366c0.332,0,0.666-0.084,0.968-0.25l17.572-9.719l17.572,9.719 c0.302,0.166,0.636,0.25,0.968,0.25c0.404,0,0.808-0.123,1.151-0.366c0.627-0.44,0.946-1.201,0.822-1.957l-3.378-20.704 l14.294-14.657c0.523-0.537,0.703-1.321,0.465-2.031c-0.238-0.711-0.854-1.229-1.595-1.343l-19.674-3.006L33.809,1.15 C33.479,0.448,32.773,0,31.998,0L31.998,0z">
                                                                    </path>
                                                                    <path fill="#ddddddddddd"
                                                                        d="M31.998,2.478c0.279,0,0.463,0.509,0.463,0.509l8.806,18.759l20.729,3.167l-14.999,15.38l3.541,21.701 l-18.54-10.254l-18.54,10.254l3.541-21.701L2,24.912l20.729-3.167l8.798-18.743C31.527,3.002,31.719,2.478,31.998,2.478">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg></label>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <textarea style="height: 191px" name="ulasan" class="form-control" id="ulasan"></textarea>
                                            <label for="ulasan">Ulasan</label>
                                        </div>
                                    </div>
                                    <div class="modal-button">
                                        <button class="btn btn-md add-cart-button icon" type="submit">Kirim Rating &
                                            Ulasan</button>
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
@section('jsplugins')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-zn-rP3sVpOj3qa5f"></script>
@endsection
@section('scripts')
    <script>
        window.snap.embed('{{ $transaksi->token }}', {
            embedId: 'snap-container'
        });
        document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
            star.addEventListener('click', function() {
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });
    </script>
@endsection
