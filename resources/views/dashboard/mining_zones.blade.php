@extends('layouts.dashboard')

@section('title')
Gestion des zone minières
@endsection

@section('styles')
@endsection

@section('bigT', "Gestion des Zones minières")

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="col-6 float-left m-0">
                    <h4 class="card-title">Gestion des Zones minières</h4>
                </div>
                <div class="col-4 float-right text-right">
                    @if (in_array('create-mining_zone', $permissions))
                    <a href="javascript:void(0)" class="btn btn-sm btn-blue" id="createMiningZoneBtn">
                        <i class="fas fa-plus"></i> </a>
                    @endif
                </div>
            </div>

            <div class="card-body">
                @if (in_array('list-mining_zone', $permissions) )
                <div class="">
                    <table id="miningZoneTable" class="table table-bordered data-table showMiningZone editMiningZone deleteMiningZone">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Propriétaire</th>
                                <th>geo_coord_utm</th>
                                <th>geo_coord_dms</th>
                                <th>region</th>
                                <th>Date Ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                {{-- BEGIN MODAL MiningZone --}}
                <div class="modal fade" id="miningZoneModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="userForm" name="miningZoneForm" enctype="multipart/form-data">
                                    <input type="hidden" name="miningZoneId" id="miningZoneId">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group mt-2">
                                        <label for="name" class="control-label">Nom de la zone minière</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Saisir le nom de la zone minière" value="" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="user" class="control-label">Responsable de la zone</label>
                                        <select name="user_id" id="user" class="form-control"
                                            required>
                                            <option disabled selected value="">Choisir un response de la zone</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="geo_coord_utm_e" class="control-label">Geo coordonnées UTM E</label>
                                        <input type="number" class="form-control" id="geo_coord_utm_e" name="geo_coord_utm_e"
                                            placeholder="" value="" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="geo_coord_utm_n" class="control-label">Geo coordonnées UTM N</label>
                                        <input type="number" class="form-control" id="geo_coord_utm_n" name="geo_coord_utm_n"
                                            placeholder="" value="" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="geo_coord_dms_long" class="control-label">Geo coordonnées DMS Long</label>
                                        <input type="number" class="form-control" id="geo_coord_dms_long" name="geo_coord_dms_long"
                                            placeholder="" value="" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="geo_coord_dms_lat" class="control-label">Geo coordonnées DMS Lat</label>
                                        <input type="number" class="form-control" id="geo_coord_dms_lat" name="geo_coord_dms_lat"
                                            placeholder="" value="" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="subdivision" class="control-label">Choisir la subdivision</label>
                                        <input type="text" class="form-control" id="subdivision" name="subdivision"
                                            placeholder="Saisir la subdivision de la zone" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="division" class="control-label">Choisir la division</label>
                                        <input type="text" class="form-control" id="division" name="division"
                                            placeholder="Saisir la division de la zone" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="region" class="control-label">Region</label>
                                        <select name="region" id="region" class="form-control"
                                            required>
                                            <option disabled selected value="">Choisir la region de la zone</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region }}">{{ $region }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- MiningZone Image Section Begin  --}}
                                    {{-- TODO : inserer la fonctionnalité d'ajout de la photo de profil --}}
                                    <div class="form-group mt-2">
                                        <label for="miningZoneImg">Charger l'image de la zone</label>
                                        <input type="file" name="miningZoneImg" accept=".png,.jpeg,.jpg" required="required"
                                            id="miningZoneImg"
                                            onchange="previewFile(this, '#previewMiningZoneImg', '#checkewMiningZoneImgFormat');">
                                        <small class="form-text text-muted"><span id="constraints">Extensions
                                                autorisées:
                                                PNG,JPEG,JPG. Taille Max: 2Mo <br>
                                                <b>Dimensions récommandées: 1000px X 1000px minimum</b>
                                            </span></small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <img id="previewewMiningZoneImg" alt="Aucun aperçu" width="250px" height="250px" />
                                        <span id="checkMiningZoneImgFormat"></span>
                                    </div>
                                    {{-- MiningZone Image Section End  --}}


                                    <div class="col-sm-offset-2 col-sm-10 mt-3">
                                        <button type="submit" class="btn btn-primary" id="saveMiningZoneBtn"
                                            value="create">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODAL MiningZone --}}

                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- TODO : set that one --}}
{{-- <script src="{{ asset('js/admin.js')}}"></script> --}}
<script>
    let datatableSettings = getDTSetting()
    let mining_zone_list = []
    let users = JSON.parse(`<?= json_encode($users) ?>`)
    inputList = ['name', 'user', 'region', 'geo_coord_utm_e', 'geo_coord_utm_n', 'geo_coord_dms_long', 
                'geo_coord_dms_lat', 'subdivision', 'division']

    function loadMiningZoneDatatable() {

        loadRessourceDatatable('/mining_zones',
            (data) => {
                let response = JSON.parse(data);
                mining_zone_list = response;
                loadData('#miningZoneTable', response,
                    [
                        {
                            data: 'name'
                        },
                        {
                            data: 'user_firstname'
                        },
                        {
                            data: 'geo_coord_utm'
                        },
                        {
                            data: 'geo_coord_dms'
                        },
                        {
                            data: 'region'
                        },
                        {
                            data: 'created_at',
                            render: function (data, type, row) {
                                return data.split('').splice(0, 10).join('')
                            }
                        },
                        {
                            data: 'action'
                        }
                    ],
                )
               
                $('.showMiningZone').click(e => {
                    e.preventDefault();
                    let miningZoneId = getResourceId(e.target)
                    if (!eventController(e.target, "show")) return
                    let mining_zone = mining_zone_list.find((mining_zone) => mining_zone.id == miningZoneId)

                    // show the image
                    $(`#previewMininZoneImg`).prop('src', mining_zone.image)
                    $(`#miningZoneImg`).prop('disabled', true)

                    inputList.forEach(input => {
                        $(`#${input}`).val(mining_zone[input])
                        $(`#${input}`).prop('disabled', true)
                    });

                    let options = ''
                    users.forEach(user => {
                        options += `<option value="${user.id}" ${user.id == mining_zone.user_id ? 'selected' : ''}>${user.firstname} ${user.lastname}</option>`
                    })
                    $('#user').html(options)
                    $('#user').prop('disabled', true)

                    $('#saveMiningZoneBtn').hide();
                    $('#modalHeading').html(mining_zone.name);
                    $('#miningZoneModal').modal('show');
                })
                
                $('.editUser').click(function (e) {
                    e.preventDefault();
                    userId = getResourceId(e.target)
                    if (!eventController(e.target, "edit")) return
                    let user = user_list.find((mining_zone) => user.id == userId);
                    inputList.forEach(input => {
                        $(`#${input}`).val(user[input])
                        $(`#${input}`).prop('disabled', false)
                    })

                    $('password').prop('disabled', false)

                    if (user.status === "ACTIVE")
                        $('#user_activated').prop('checked', true)
                    else
                        $('#user_deactivatede').prop('checked', true)

                    $(`#previewUserImg`).prop('src', user.image)
                    $(`#userImg`).removeAttr('disabled')
                    $(`#userImg`).removeAttr('required')
                    $("#checkUserImgFormat").html('')

                    $('#userId').val(userId);
                    $('#modalHeading').html('Modification de l\'utilisateur ' + user.firstname);
                    $('#saveUserBtn').show();
                    $('#saveUserBtn').html('Enregistrer');
                    $('#userModal').modal('show');
                })

                $('.deleteUser').click(e => {
                    e.preventDefault();
                    userId = getResourceId(e.target)
                    if (!eventController(e.target, "delete")) return
                    let user = user_list.find((user) => user.id == userId)
                    let resp = confirm(
                        `Voulez vous vraiment supprimer l'utilisateur << ${user.name} >> ?`)
                    if (!resp) return;
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ route('mining_zones.store') }}` + '/' + userId,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#miningZoneTable').DataTable().destroy();
                            loadMiningZoneDatatable();
                        },
                        error: function (data) {
                            alert(
                                `Une erreur s\'est produite lors de la suppression de la zone << ${mining_zone.name} >>`
                            )
                            $('#saveMiningZoneBtn').html('Enregistrer');
                        }
                    });
                })

                // Validation of the user form
                $('#userForm').submit(function (e) {
                    e.preventDefault();
                    $("#saveUserBtn").html('Enregistrement en cours...');
                    let formData = new FormData();
                    formData.append("_token", "{{ csrf_token() }}")
                    formData.append('userId', $('#userId').val());
                    formData.append('status', $("input[name='status']").val())
                    formData.append('userImg', $("#userImg")[0].files[0])

                    for (let k = 0; k < inputList.length; k++) {
                        formData.append(inputList[k], $(`#${inputList[k]}`).val())
                    }

                    $.ajax({
                        data: formData,
                        url: "{{ route('mining_zones.store') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: "POST",
                        success: function (data) {
                           location.reload()
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveMiningZoneBtn').html('Enregistrer');
                        }
                    });
                });

            },
            (data) => {
                alert("Echec connexion. Veuillez vérifier votre connexion internet")
            }
        )
    }

    $(document).ready(function () {
        loadMiningZoneDatatable()

        // Create miningZone modal
        $('#createMiningZoneBtn').click(function () {

            $(`#previewMiningZoneImg`).prop('src', '')
            $(`#miningZoneImg`).prop('disabled', false)

            inputList.forEach((inputId) => {
                $(`#${inputId}`).prop('disabled', false)
            })

            $('#saveMiningZoneBtn').html("Enregistrer");
            $('#saveMiningZoneBtn').show();
            $('#miningZoneId').val("");
            $('#miningZoneForm').trigger("reset");
            $('#modalHeading').html("Création d'une nouvelle zone");
            $('#miningZoneModal').modal('show');
        });

    })

</script>
@endsection