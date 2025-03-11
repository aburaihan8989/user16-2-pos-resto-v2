@extends('layouts.app')

@section('title', 'Surat Jalan Stock Keluar')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Surat Jalan Stock Keluar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('stock-out') }}">Stocks Keluar</a></div>
                    <div class="breadcrumb-item">Surat Jalan Stock Keluar</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Surat Jalan</h2>
                                    <div>Date : <?php echo date("d-m-Y"); ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Di Proses Oleh :</strong><br>
                                            Admin Pusat<br>
                                            {{ $user->name }}<br>
                                            {{ $user->phone }}<br>

                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Di Terima Oleh :</strong><br>
                                            Admin Cabang<br>
                                            {{ $kasir->name }}<br>
                                            {{ $kasir->phone }}<br>

                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- <address>
                                            <strong>Payment Method:</strong><br>
                                            <br>
                                            <br>
                                        </address> --}}
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Order Date :</strong><br>
                                            <?php echo date("d-m-Y"); ?><br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Order Pesanan</div>
                                <p class="section-lead">All items here process by admin pusat.</p>
                                <div class="table-responsive">
                                    <table class="table-striped table-hover table-md table">
                                        <tr>
                                            <th data-width="40">#</th>
                                            <th>Item</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $product->name}}</td>
                                            <td class="text-center">Rp. {{ number_format(($product->price), 0, ",", ".") }}</td>
                                            <td class="text-center">{{ $stock->quantity}} Pcs</td>
                                            <td class="text-right">Rp. {{ number_format(($stock->total_price), 0, ",", ".") }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        {{-- <div class="section-title">Payment Method</div>
                                        <p class="section-lead">The payment method that we provide is to make it easier for
                                            you to pay invoices.</p>
                                        <div class="images">
                                            <img src="{{ asset('img/payment/visa.png') }}"
                                                alt="visa">
                                            <img src="{{ asset('img/payment/jcb.png') }}"
                                                alt="jcb">
                                            <img src="{{ asset('img/payment/mastercard.png') }}"
                                                alt="mastercard">
                                            <img src="{{ asset('img/payment/paypal.png') }}"
                                                alt="paypal">
                                        </div> --}}
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total Pembayaran</div>
                                            <div class="invoice-detail-value">Rp. {{ number_format(($stock->total_price), 0, ",", ".") }}</div>
                                        </div>
                                        {{-- <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Shipping</div>
                                            <div class="invoice-detail-value">$15</div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">$685.99</div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            {{-- <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process
                                Payment</button>
                            <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button> --}}
                        </div>
                        <a href="{{ route('stock-out') }}" class="btn btn-primary btn-icon icon-left">Close</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
