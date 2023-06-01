@extends('staff.pdfs.header')
@section('title')
    @lang('Payments')
@endsection
@section('content')
<body>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3><b>INVOICE</b> <span class="pull-right">#345766</span></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('staffFiles/assets/img/hospital2.png') }}" width="100" height="30" alt="logo" class="logo-default">
                                <p class="text-muted m-l-5">
                                    D 103, Sunray, <br> Opp. Town Hall, <br>
                                    Sardar Patel Road, <br> Ahmedabad - 380015
                                </p>
                            </address>
                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <p class="addr-font-h3">To,</p>
                                <p class="font-bold addr-font-h4">Jayesh Patel</p>
                                <p class="text-muted m-l-30">
                                    207, Prem Sagar Appt., <br> Near Income Tax Office, <br>
                                    Ashram Road, <br> Ahmedabad - 380057
                                </p>
                                <p class="m-t-30">
                                    <b>Invoice Date :</b> <i class="fa fa-calendar"></i> 14th
                                    July 2017
                                </p>
                                <p>
                                    <b>Due Date :</b> <i class="fa fa-calendar"></i> 24th July
                                    2017
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Item Name</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit Cost</th>
                                        <th class="text-right">Charges</th>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Visiting Charges</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">$100</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">$100</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Medicines</td>
                                        <td class="text-right">10</td>
                                        <td class="text-right">$15</td>
                                        <td class="text-right">$150</td>
                                        <td class="text-right">5</td>
                                        <td class="text-right">$1000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>X-ray Reports</td>
                                        <td class="text-right">4</td>
                                        <td class="text-right">$600</td>
                                        <td class="text-right">$70</td>
                                        <td class="text-right">5</td>
                                        <td class="text-right">$1200</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>MRI</td>
                                        <td class="text-right">2</td>
                                        <td class="text-right">$245</td>
                                        <td class="text-right">$125</td>
                                        <td class="text-right">10</td>
                                        <td class="text-right">$480</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Other Charges</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">-</td>
                                        <td class="text-right">$300</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p>Sub - Total amount: $2600</p>
                            <p>Discount : $100 </p>
                            <p>vat (10%) : $160 </p>
                            <hr>
                            <h3><b>Total :</b> $2760</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-right">
                            <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                            <button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button">
                                <span><i class="fa fa-print"></i> Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection