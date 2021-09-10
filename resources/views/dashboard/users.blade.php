@extends('layouts.dashboard')

@section('title')
Gestion des Utilisateurs
@endsection

@section('styles')
@endsection

@section('bigT', "Gestion des Utilisateurs")

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="col-6 float-left m-0">
                    <h4 class="card-title">Gestion des Utilisateurs</h4>
                </div>
                <div class="col-4 float-right text-right">
                    @if (in_array('create-user', $permissions))
                    <a href="javascript:void(0)" class="btn btn-sm btn-blue" id="createUserBtn">
                        <i class="fas fa-plus"></i> </a>
                    @endif
                </div>
            </div>

            <div class="card-body">
                @if (in_array('list-user', $permissions) )
                <div class="">
                    <table id="usersTable" class="table table-bordered data-table showUser editUser deleteUser">
                        <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Nom et Prénom</th>
                                <th>Fonction</th>
                                <th>Statut</th>
                                <th>Date Ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                {{-- BEGIN MODAL Users --}}
                <div class="modal fade" id="userModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="userForm" name="userForm" enctype="multipart/form-data">
                                    <input type="hidden" name="userId" id="userId">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group mt-2">
                                        <label for="firstname" class="control-label">Nom de l'utilisateur</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                            placeholder="Saisir le nom de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="lastname" class="control-label">Prénom de l'utilisateur</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            placeholder="Saisir le prénom de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Saisir l'adresse mail" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="username" class="control-label">username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Saisir le login de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="password" class="control-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Saisir le mot de passe de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="dob" class="control-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            placeholder="Choisir date naissance de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="contact" class="control-label">Contact</label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                            placeholder="Saisir le contact de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="prospector_card_num" class="control-label">Num carte prospecteur</label>
                                        <input type="number" class="form-control" id="prospector_card_num" name="prospector_card_num"
                                            placeholder="Saisir le numéra de carte prospecteur" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="cni" class="control-label">Numéro CNI</label>
                                        <input type="numer" class="form-control" id="cni" name="cni"
                                            placeholder="Saisir le numéro de CNI" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="profession" class="control-label">Profession</label>
                                        <input type="text" class="form-control" id="profession" name="profession"
                                            placeholder="Saisir la profession de l'utilisateur" value="">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label class="control-label">Statut du compte utilisateur</label><br><br>
                                        <label class="control-label" for="user_activated">Compte activé</label>
                                        <input type="radio" name="status" value="ACTIVE" id="user_activated">
                                        <label class="control-label" for="user_deactivated">Compte désactivé</label>
                                        <input type="radio" name="status" value="INACTIVE" id="user_deactivated">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="role" class="control-label">Choisir le rôle de l'utilisateur</label>
                                        <select name="roleId" id="role" class="form-control"
                                            required>
                                            <option disabled selected value="">Choisir un rôle</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- User Image Section Begin  --}}
                                    {{-- TODO : inserer la fonctionnalité d'ajout de la photo de profil --}}
                                    <div class="form-group mt-2">
                                        <label for="userImg">Charger la photo de profil de l'utilisateur</label>
                                        <input type="file" name="userImg" accept=".png,.jpeg,.jpg" required="required"
                                            id="userImg"
                                            onchange="previewFile(this, '#previewUserImg', '#checkUserImgFormat');">
                                        <small class="form-text text-muted"><span id="constraints">Extensions
                                                autorisées:
                                                PNG,JPEG,JPG. Taille Max: 2Mo <br>
                                                <b>Dimensions récommandées: 1000px X 1000px minimum</b>
                                            </span></small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <img id="previewUserImg" alt="Aucun aperçu" width="250px" height="250px" />
                                        <span id="checkUserImgFormat"></span>
                                    </div>
                                    {{-- User Image Section End  --}}


                                    <div class="col-sm-offset-2 col-sm-10 mt-3">
                                        <button type="submit" class="btn btn-primary" id="saveUserBtn"
                                            value="create">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODAL User --}}

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
    let user_list = []
    let roles = JSON.parse(`<?= json_encode($roles) ?>`)
    inputList = ['firstname', 'lastname', 'email', 'username', 'contact', 'prospector_card_num', 
        'cni', 'profession', 'status', 'dob', 'role'
    ]

    function loadUsersDatatable() {

        loadRessourceDatatable('/users',
            (data) => {
                let response = JSON.parse(data);
                user_list = response;
                loadData('#usersTable', response,
                    [
                       {
                          data: 'image',
                          render: (data, type, row) => {
                             return `<a href="${data}"><img src="${data}" width="100px" height="100px"/></a>`
                          }
                       },
                       {
                            data: 'firstname'
                        },
                        {
                            data: 'fonction'
                        },
                        {
                            data: 'status',
                            render: (data, type, row) => {
                                return data == "ACTIVE" ? "COMPTE ACTIVÉ" : "COMPTE DESACTIVÉ"
                            }
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
               
                $('.showUser').click(e => {
                    e.preventDefault();
                    let userId = getResourceId(e.target)
                    if (!eventController(e.target, "show")) return
                    let user = user_list.find((user) => user.id == userId)

                    // show the image
                    $(`#previewUserImg`).prop('src', user.image)
                    $(`#userImg`).prop('disabled', true)

                    inputList.forEach(input => {
                        $(`#${input}`).val(user[input])
                        $(`#${input}`).prop('disabled', true)
                    });
                    $("input[name='status']").prop('disabled', true)

                    if (user.status === "ACTIVE")
                        $('#user_activated').prop('checked', true)
                    else
                        $('#user_deactivatede').prop('checked', true)

                    $('#password').prop('disabled', true)

                    let options = ''
                    roles.forEach(role => {
                        options += `<option value="${role.id}" ${role.id == user.role_id ? 'selected' : ''}>${role.name}</option>`
                    })
                    $('#role').html(options)
                    $('#role').prop('disabled', true)

                    $('#saveUserBtn').hide();
                    $('#modalHeading').html(user.firstname);
                    $('#userModal').modal('show');
                })
                
                $('.editUser').click(function (e) {
                    e.preventDefault();
                    userId = getResourceId(e.target)
                    if (!eventController(e.target, "edit")) return
                    let user = user_list.find((user) => user.id == userId);
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
                        url: `{{ route('users') }}` + '/' + userId,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#userTable').DataTable().destroy();
                            loadUsersDatatable();
                        },
                        error: function (data) {
                            alert(
                                `Une erreur s\'est produit lors de la suppression de l'utilisateur << ${user.firstname} >>`
                            )
                            $('#saveUserBtn').html('Enregistrer');
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
                        url: "{{ route('users') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: "POST",
                        success: function (data) {
                           location.reload()
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveUserBtn').html('Enregistrer');
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
        loadUsersDatatable()

        // Create user modal
        $('#createUserBtn').click(function () {

            $(`#previewUserImg`).prop('src', '')
            $(`#userImg`).prop('disabled', false)

            // Erase user information section for a new user 
            $("#userInfoSection").html('')

            inputList.forEach((inputId) => {
                $(`#${inputId}`).prop('disabled', false)
            })

            $('password').prop('disabled', false)

            $('#saveUserBtn').html("Enregistrer");
            $('#saveUserBtn').show();
            $('#userId').val("");
            $('#userForm').trigger("reset");
            $('#modalHeading').html("Création d'un nouveau utilisateur");
            $('#userModal').modal('show');
        });

    })

</script>
@endsection