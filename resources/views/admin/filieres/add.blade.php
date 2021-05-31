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
                            <form method="POST" action="{{ route('filieres-add') }}">
                            <h3>Ajouter une filiere</h3>
                            <div class="row" style="margin: 2rem;">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranche_1">Intitule</label>
                                        <input type="text" name="intitule" id="intitule" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_paiement_tranche_1">Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-round btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
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
        <a href="{{route('filieres')}}">@lang('Filieres')</a>
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
    {{ config('app.name') }} | @lang('Ajouter Niveau')
@endsection

@section('Page Scripts')
    <script>
        $(document).ready(function() {
            
        });
    </script>
@endsection




