@extends('admin.adminlayout')

@section('Content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto" id="kt_profile_aside" style="width:100%;">
                    <!--begin::Profile Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body">
                            <h3>Remplir le formulaire pour payer</h3>
                            <div class="row" style="margin: 2rem;">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranche_1">Tranche 1</label>
                                        <input type="text" name="tranche_1" id="tranche_1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_paiement_tranche_1">Date de paiement tranche 1</label>
                                        <input type="date" name="date_paiement_tranche_1" id="date_paiement_tranche_1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranche_2">Tranche 2</label>
                                        <input type="text" name="tranche_2" id="tranche_2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_paiement_tranche_2">Date de paiement tranche 2</label>
                                        <input type="date" name="date_paiement_tranche_2" id="date_paiement_tranche_2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="annee_academique">Année académique</label>
                                        <input type="text" name="annee_academique" id="annee_academique" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;justify-content: center;
                            align-items: center;">
                                <h4>Sélectionner une méthode de paiement</h4>
                            </div>
                            <div style="display: flex;justify-content: center;
                            align-items: center;margin-top:4rem;">
                                <div id="paypal-button-container" style="    display: flex;
                                justify-content: center;
                                align-items: center;
                                width: 60%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Aside-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection


@section('navigation')
<!--begin::Page Heading-->
<div class="d-flex align-items-baseline flex-wrap mr-5">
    <!--begin::Page Title-->
    <h5 class="text-dark font-weight-bold my-1 mr-5">
        <a href="{{route('profil',['id'=>auth()->user()->id])}}">@lang('Paiement')</a>
    </h5>
    <!--end::Page Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <div class="text-muted">@lang('Add')</div>
        </li>
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page Heading-->
@endsection

@section('title')
    {{ config('app.name') }} | @lang('Paiement')
@endsection

{{-- Stephane - Black Panther 14 h 40
Bank Account
Account Number:
FR7012345282745948124315212
Routing Number:
1234528274
Credit Card
Credit Card Number:
4020024389820257
Credit Card Type:
VISA
Expiration Date:
05/2026
PayPal
Balance:
5000.00 EUR --}}

@section('Page Scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
    <script>
        $(document).ready(function() {
            function initPayPalButton() {
            paypal
                .Buttons({
                style: {
                    shape: "rect",
                    color: "gold",
                    layout: "vertical",
                    label: "paypal",
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                    purchase_units: [
                        { amount: { currency_code: "EUR", value: 5 } },
                    ],
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(async function (details) {
                        var data = new FormData();
                        data.append("tranche_1", $('#tranche_1').val());
                        data.append("date_paiement_tranche_1", $('#date_paiement_tranche_1').val());
                        data.append("tranche_2", $('#tranche_2').val());
                        data.append("date_paiement_tranche_2", $('#date_paiement_tranche_2').val());
                        data.append("annee_academique", $('#annee_academique').val());
                        data.append("user_id", "{{ auth()->user()->id }}");
                        data.append("_token", $('input[name="_token"]').val());
                        $.ajax({
                            url: "{{ route('paiement.add') }}",
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: data,
                            success: function(data) {
                                swal(
                                    'Succès !',
                                    'Paiement exécuté avec succès !',
                                    'success'
                                );
                                window.location.href = "{{ route('paiement') }}";
                            },
                            error: function(error) {
                                swal(
                                    'Erreur !',
                                    'Une erreur est survenue, veuillez reessayer plutard !',
                                    'error'
                                );
                                console.log(error);
                            }
                        })
                    });
                },
                onError: function (err) {
                    swal(
                        'Erreur !',
                        'Une erreur est survenue, veuillez reessayer plutard !',
                        'error'
                    );
                    console.log(err);
                },
                })
                .render("#paypal-button-container");
            }
            initPayPalButton();
        });
    </script>
@endsection




