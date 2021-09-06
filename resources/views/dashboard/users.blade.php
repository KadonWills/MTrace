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
                    @if (in_array('creer-actualite', $permissions))
                    <a href="javascript:void(0)" class="btn btn-sm btn-blue" id="createNewsBtn">
                        <i class="fas fa-plus"></i> </a>
                    @endif
                </div>
            </div>

            <div class="card-body">
                @if (in_array('liste-actualite', $permissions) )
                <div class="">
                    <table id="newsTable" class="table table-bordered data-table showNews editNews deleteNews">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Date Ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                {{-- BEGIN MODAL News --}}
                <div class="modal fade" id="newsModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="newsForm" name="newsForm" enctype="multipart/form-data">
                                    <input type="hidden" name="newsId" id="newsId">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group mt-2">
                                        <label for="title" class="control-label">Titre</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Saisir le titre de l'actualité" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="title_en" class="control-label">Titre (anglais)</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en"
                                            placeholder="Saisir le titre de l'actualité en anglais" value="">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="title_es" class="control-label">Titre (espagnol)</label>
                                        <input type="text" class="form-control" id="title_es" name="title_es"
                                            placeholder="Saisir le titre de l'actualité en espagnol" value="">
                                    </div>

                                    <div id="userInfoSection"></div>

                                    <div class="form-group mt-3">
                                        {{-- ACTIVE => l'actualité est active et donc visible par les visiteurs du site
                                        et INACVITE => l'actualité n'est pas visible par les visiteurs --}}
                                        <label class="control-label">Statut de l'actualité</label><br><br>
                                        <label class="control-label" for="news_visible">Actualité visible</label>
                                        <input type="radio" name="status" value="ACTIVE" id="news_visible">
                                        <label class="control-label" for="news_notvisible">Actualité non visible</label>
                                        <input type="radio" name="status" value="INACTIVE" id="news_notvisible">
                                    </div>

                                    {{-- News Image Section Begin  --}}
                                    <div class="form-group mt-2">
                                        <label for="newsImg">Charger une image pour l'actualité</label>
                                        <input type="file" name="newsImg" accept=".png,.jpeg,.jpg" required="required"
                                            id="newsImg"
                                            onchange="previewFile(this, '#previewNewsImg', '#checkNewsImgFormat');">
                                        <small class="form-text text-muted"><span id="constraints">Extensions
                                                autorisées:
                                                PNG,JPEG,JPG. Taille Max: 2Mo <br>
                                                <b>Dimensions récommandées: 1000px X 1000px minimum</b>
                                            </span></small>
                                    </div>
                                    <div class="form-group mb-2">
                                        <img id="previewNewsImg" alt="Aucun aperçu" width="250px" height="250px" />
                                        <span id="checkNewsImgFormat"></span>
                                    </div>
                                    {{-- News Image Section End  --}}

                                    <div class="form-group mt-3">
                                        <label for="description" class="control-label">Contenu de l'actualité</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="description_en" class="control-label">Contenu de l'actualité
                                            (anglais)</label>
                                        <textarea name="description_en" id="description_en" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="description_es" class="control-label">Contenu de l'actualité
                                            (espagnol)</label>
                                        <textarea name="description_es" id="description_es" class="form-control"></textarea>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10 mt-3">
                                        <button type="submit" class="btn btn-primary" id="saveNewsBtn"
                                            value="create">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODAL News --}}

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
    news_list = []
    inputList = ['title', 'title_en', 'title_es', 'description', 'description_en', 'description_es']

    function loadNewsDatatable() {

        loadRessourceDatatable('/admin/news',
            (data) => {
                let response = JSON.parse(data);
                news_list = response;
                loadData('#newsTable', response,
                    [
                       {
                          data: 'image',
                          render: (data, type, row) => {
                             return `<a href="${data}"><img src="${data}" width="100px" height="100px"/></a>`
                          }
                       },
                       {
                            data: 'title'
                        },
                        {
                            data: 'status',
                            render: (data, type, row) => {
                                return data == "ACTIVE" ? "VISIBLE" : "NON VISIBLE"
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
               
                $('.showNews').click(e => {
                    e.preventDefault();
                    let newsId = getResourceId(e.target)
                    if (!eventController(e.target, "show")) return
                    let news = news_list.find((news) => news.id == newsId)

                    // show the image
                    $(`#previewNewsImg`).prop('src', news.image)
                    $(`#newsImg`).prop('disabled', true)

                    //Show user information if the annonce provide from the frontend side
                    if (news.user_id) {
                        user = news.user;
                        userHTMLInfo = `
                           <div class="form-group mt-2">
                               <label for="username">Nom de l'utilisateur</label>
                               <input type="text" class="form-control" id="username" value="${user.firstname} ${user.lastname}" disabled/>
                           </div>
                       `
                        // Set HTML of the user information section
                        $("#userInfoSection").html(userHTMLInfo)
                    }

                    inputList.forEach(input => {
                        $(`#${input}`).val(news[input])
                        $(`#${input}`).prop('disabled', true)
                    });
                    $("input[name='status']").prop('disabled', true)

                    if (news.status === "ACTIVE")
                        $('#news_visible').prop('checked', true)
                    else
                        $('#news_notvisible').prop('checked', true)

                    $('#saveNewsBtn').hide();
                    $('#modalHeading').html(news.title);
                    $('#newsModal').modal('show');
                })
                
                $('.editNews').click(function (e) {
                    e.preventDefault();
                    newsId = getResourceId(e.target)
                    if (!eventController(e.target, "edit")) return
                    let news = news_list.find((news) => news.id == newsId);
                    inputList.forEach(input => {
                        $(`#${input}`).val(news[input])
                        $(`#${input}`).prop('disabled', false)
                    })

                    if (news.status === "ACTIVE")
                        $('#news_visible').prop('checked', true)
                    else
                        $('#news_notvisible').prop('checked', true)

                    //Show user information if the news provide from the frontend side
                    if (news.user_id) {
                        user = news.user;
                        userHTMLInfo = `
                           <div class="form-group mt-2">
                               <label for="username">Nom de l'utilisateur</label>
                               <input type="text" class="form-control" id="username" value="${user.firstname} ${user.lastname}" disabled/>
                           </div>
                       `
                        // Set HTML of the user information section
                        $("#userInfoSection").html(userHTMLInfo)
                    }

                    $(`#previewNewsImg`).prop('src', news.image)
                    $(`#newsImg`).removeAttr('disabled')
                    $(`#newsImg`).removeAttr('required')
                    $("#checkNewsImgFormat").html('')

                    $('#newsId').val(newsId);
                    $('#modalHeading').html('Modification de l\'actualité ' + news.title);
                    $('#saveNewsBtn').show();
                    $('#saveNewsBtn').html('Enregistrer');
                    $('#newsModal').modal('show');
                })

                $('.deleteNews').click(e => {
                    e.preventDefault();
                    newsId = getResourceId(e.target)
                    if (!eventController(e.target, "delete")) return
                    let news = news_list.find((news) => news.id == newsId)
                    let resp = confirm(
                        `Voulez vous vraiment supprimer l'actualité << ${news.title} >> ?`)
                    if (!resp) return;
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ route('home') }}` + '/' + newsId,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#newsTable').DataTable().destroy();
                            loadNewsDatatable();
                        },
                        error: function (data) {
                            alert(
                                `Une erreur s\'est produit lors de la suppression de l'actualité << ${news.title} >>`
                            )
                            $('#saveNewsBtn').html('Enregistrer');
                        }
                    });
                })

                // Validation of the news form
                $('#newsForm').submit(function (e) {
                    e.preventDefault();
                    $("#saveNewsBtn").html('Enregistrement en cours...');
                    let formData = new FormData();
                    formData.append("_token", "{{ csrf_token() }}")
                    formData.append('newsId', $('#newsId').val());
                    formData.append('status', $("input[name='status']").val())
                    formData.append('newsImg', $("#newsImg")[0].files[0])

                    for (let k = 0; k < inputList.length; k++) {
                        formData.append(inputList[k], $(`#${inputList[k]}`).val())
                    }

                    $.ajax({
                        data: formData,
                        url: "{{ route('home') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: "POST",
                        success: function (data) {
                           location.reload()
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveNewsBtn').html('Enregistrer');
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
        loadNewsDatatable()

        // Create news modal
        $('#createNewsBtn').click(function () {

            $(`#previewNewsImg`).prop('src', '')
            $(`#newsImg`).prop('disabled', false)

            // Erase user information section for a new news 
            $("#userInfoSection").html('')

            inputList.forEach((inputId) => {
                $(`#${inputId}`).prop('disabled', false)
            })

            $('#saveNewsBtn').html("Enregistrer");
            $('#saveNewsBtn').show();
            $('#newsId').val("");
            $('#newsForm').trigger("reset");
            $('#modalHeading').html("Création d'une nouvelle actualité");
            $('#newsModal').modal('show');
        });

    })

</script>
@endsection