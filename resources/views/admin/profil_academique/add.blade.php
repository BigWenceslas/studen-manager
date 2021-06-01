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
                            <h3>Ajouter un profil académique</h3>
                            <form action="" class="profil_save">
                                <div class="row" style="margin: 2rem;">
                                    @csrf
                                    <input type="hidden" name="id_profil" value="no">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Code UE</label>
                                            <input type="text" name="code_ue" id="code_ue" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Intitule UE</label>
                                            <input type="text" name="intitule_ue" id="intitule_ue" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Code EC</label>
                                            <input type="text" name="code_ec" id="code_ec" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Intitutle EC</label>
                                            <input type="text" name="intitule_ec" id="intitule_ec" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Code Etape</label>
                                            <input type="text" name="code_etape" id="code_etape" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Intitule Etape</label>
                                            <input type="text" name="intitule_etape" id="intitule_etape" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Note CC</label>
                                            <input type="text" name="note_cc" id="note_cc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Note Examen</label>
                                            <input type="text" name="note_ex" id="note_ex" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Moyenne</label>
                                            <input type="text" name="moyenne" id="moyenne" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Session</label>
                                            <input type="text" name="session" id="session" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Décision</label>
                                            <input type="text" name="decision" id="decision" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tranche_chooser">Etudiant</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                @foreach ($users as $user)
                                                    @if ($user->roles()->pluck('name')[0] == "etudiant")
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="display: flex;justify-content:center;">
                                        <button class="submit_form btn btn-primary">
                                            Enregistrer
                                        </button>
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
        <a href="{{route('profil',['id'=>auth()->user()->id])}}">Profil académique</a>
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
    {{ config('app.name') }} | Profil académique
@endsection

@section('Page Scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
    <script>
        $(document).ready(function() {
            $(".submit_form").on("click", function(e){
                e.preventDefault();
                var actual_text = $(this).text();
                $(this).html("En cours...");
                var data = new FormData();
                var $form = $('.profil_save');
                var formdata = (window.FormData) ? new FormData($form[0]) : null;
                var data = (formdata !== null) ? formdata : $form.serialize();
                $.ajax({
                    url: "{{ route('profil-academique.add') }}",
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
                        $(".submit_form").html(actual_text);
                        window.location.href = "{{ route('profil-academique') }}";
                    },
                    error: function(error) {
                        swal(
                            'Erreur !',
                            'Une erreur est survenue, veuillez reessayer plutard !',
                            'error'
                        );
                        $(".submit_form").html(actual_text);
                        console.log(error);
                    }
                })
            })
        });
    </script>
@endsection




