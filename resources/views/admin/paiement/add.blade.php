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
                            <h3>Sélectionner une option de paiement</h3>
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
    {{ config('app.name') }} | @lang('Users Management') | @lang('Profil') | @lang('Overview')
@endsection

@section('Page Scripts')
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
                        { amount: { currency_code: "EUR", value: 500 } },
                    ],
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(async function (details) {
                    var data = new FormData();
                    // data.append("pack", selff.pack_id);
                    // data.append("user_id", selff.user._id);
                    // data.append("statut", "Payé");
                    // data.append("cmd", "1234cmdTEst");
                    // data.append("verify", "non");
                    // data.append("duree", date_added);
                    // data.append("lang", selff.$i18n.locale);
                    // const result = await selff.$store.dispatch(
                    //     "ecole/payerPack",
                    //     data
                    // );
                    // if (result) {
                    //     $('#modalpay').modal('hide');
                    //     $('#modalpay').removeClass('show');
                    //     await selff.$store.dispatch('auth/setAuthEcole', result.data);
                    //     if (selff.user.approved == 'on') {
                    //     window.location.href = "/dashboard/ecole/commande";
                    //     }
                    // }
                    });
                },
                onError: function (err) {
                    console.log(err);
                },
                })
                .render("#paypal-button-container");
            }
            initPayPalButton();
        });
    </script>
@endsection




