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
                            <form action="" class="payment_save">
                                <div class="row" style="margin: 2rem;">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Choisir la tranche</label>
                                            <select id="tranche_chooser" class="form-control">
                                                <option value="Tranche 1" {{ $paiement->tranche_1 == "Oui" ? "selected" : "" }}>Tranche 1</option>
                                                <option value="Tranche 2" {{ $paiement->tranche_2 == "Oui" ? "selected" : "" }}>Tranche 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="annee_academique">Année académique</label>
                                            <select name="annee_academique" id="annee_academique" class="form-control">
                                                <option value="2021 - 2022" {{ $paiement->annee_academique == "2021 - 2022" ? "selected" : "" }}>2021 - 2022</option>
                                                <option value="2020 - 2021" {{ $paiement->annee_academique == "2020 - 2021" ? "selected" : "" }}>2020 - 2021</option>
                                                <option value="2019 - 2020" {{ $paiement->annee_academique == "2019 - 2020" ? "selected" : "" }}>2019 - 2020</option>
                                                <option value="2018 - 2019" {{ $paiement->annee_academique == "2018 - 2019" ? "selected" : "" }}>2018 - 2019</option>
                                                <option value="2017 - 2018" {{ $paiement->annee_academique == "2017 - 2018" ? "selected" : "" }}>2017 - 2018</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            <div class="text-muted">@lang('Edit')</div>
        </li>
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page Heading-->
@endsection

@section('title')
    {{ config('app.name') }} | @lang('Paiement')
@endsection

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
                        var $form = $('.payment_save');
                        var formdata = (window.FormData) ? new FormData($form[0]) : null;
                        var data = (formdata !== null) ? formdata : $form.serialize();
                        if($("#tranche_chooser").find(":selected").val() == "Tranche 1"){
                            data.append("tranche_1", "Oui");
                            data.append("date_paiement_tranche_1", "{{ date('Y-m-d H:i:s') }}");
                            data.append("tranche_2", "");
                            data.append("date_paiement_tranche_2", "");
                        }else if($("#tranche_chooser").find(":selected").val() == "Tranche 2"){
                            data.append("tranche_2", "Oui");
                            data.append("date_paiement_tranche_2", "{{ date('Y-m-d H:i:s') }}");
                            data.append("tranche_1", "");
                            data.append("date_paiement_tranche_1", "");
                        }else{
                            data.append("tranche_2", "Oui");
                            data.append("date_paiement_tranche_2", "{{ date('Y-m-d H:i:s') }}");
                            data.append("tranche_1", "Oui");
                            data.append("date_paiement_tranche_1", "{{ date('Y-m-d H:i:s') }}");
                        }
                        $.ajax({
                            url: "{{ route('paiement.add') }}",
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: data,
                            success: function(data) {
                                swal(
                                    data.titre,
                                    data.message,
                                    data.type
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




