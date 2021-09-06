/**
 * @description Gets a selected image and displays a preview of it after it 
 * has undergone validation. This method makes use of the validateFile method
 * @param {String} previewSectionId Id of the preview image section
 * @param {String} inputFileTagId Id of the input file tag
 * @param {String} helperSpanId Id of the helper span to display  messages 
 * if necessary (error or success messages)
 * @param {String} successMessage success message to be displayed
 * @param {String} errorMessage error message to be displayed
 * @notes The above ids should be sent with the # 
 * @date Written on 08 July 2020
 * @returns {Boolean} returns true if the file is valid and previewed and false otherwise
 * @author Mohamed Saphir Souaibou <mohamedsaphir@gmail.com>
 */
function previewImage(previewSectionId, inputFileTagId, helperSpanId, successMessage = "", errorMessage = "") {
    // response = 1;
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(previewSectionId).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(inputFileTagId).change(function () {
        if (validateFile(inputFileTagId)) {
            if (successMessage != "") {
                $(helperSpanId).text(successMessage);
                $(helperSpanId).css("color", "green");
                readURL(this);

            } else {
                $(helperSpanId).css("color", "green");
                readURL(this);
            }

        } else {
            if (errorMessage != "") {
                $(previewSectionId).attr('src', "");
                $(helperSpanId).text(errorMessage);
                $(helperSpanId).css("color", "red");

            } else {
                $(previewSectionId).attr('src', "");
                $(helperSpanId).css("color", "red");

            }

        }

    });

}

function previewPDF(inputFileTagId, canvasId) {
    //Trying pdf updload preview
    // Loaded via <script> tag, create shortcut to access PDF.js exports. 
    let pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
    //      $("#catBPFile_sc").on("change", function(e) {
    //  let file = e.target.files[0]
    let file = inputFileTagId.files[0]
    if (file.type == "application/pdf") {
        let fileReader = new FileReader();
        fileReader.onload = function () {
            let pdfData = new Uint8Array(this.result);
            // Using DocumentInitParameters object to load binary data.
            let loadingTask = pdfjsLib.getDocument({
                data: pdfData
            });
            loadingTask.promise.then(function (pdf) {
                console.log('PDF loaded');

                // Fetch the first page
                let pageNumber = 1;
                pdf.getPage(pageNumber).then(function (page) {
                    console.log('Page loaded');

                    let scale = 1.5;
                    let viewport = page.getViewport({
                        scale: scale
                    });
                    // Prepare canvas using PDF page dimensions
                    let canvas = $(canvasId)[0];
                    let context = canvas.getContext('2d');
                    viewport.width = 760;
                    //Applying margin left to center the document 
                    viewport.transform[4] = -50;
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    console.log(viewport);
                    // Render PDF page into canvas context
                    let renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    let renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {});
                });
            }, function (reason) {
                // PDF loading error
                console.error(reason);
            });
        };
        fileReader.readAsArrayBuffer(file);
    }
    //     });

}

function validateFileOnChange(inputFileTagId, helperSpanId, successMessage = "", errorMessage = "", requiredFileSize, fileType, canvasId) {
    //  $(inputFileTagId).change(function () {
    if (validateFile(inputFileTagId, requiredFileSize, fileType)) {
        if (successMessage != "") {
            $(helperSpanId).text(successMessage);
            $(helperSpanId).css("color", "green");
            $(canvasId).show();
            previewPDF(inputFileTagId, canvasId)

        } else {
            $(helperSpanId).css("color", "green");
            $(canvasId).show();
            previewPDF(inputFileTagId, canvasId)
        }

    } else {
        if (errorMessage != "") {
            //Clearing Canvas to enabling new pdfs to be displayed
            let canvas = $(canvasId)[0];
            const context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);
            $(canvasId).hide();
            $(helperSpanId).text(errorMessage);
            $(helperSpanId).css("color", "red");

        } else {
            //  $(previewSectionId).attr('src', "");
            //Clearing Canvas to enabling new pdfs to be displayed
            let canvas = $(canvasId)[0];
            const context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);
            $(canvasId).hide();
            $(helperSpanId).css("color", "red");

        }

    }

    //   });

}

/**
 * @description Validates a file from an input type file 
 * @param {String} inputFileTagId Id of the input file tag
 * @param {Double} requiredFileSize required file size with 4 decimal places . example 2.0000 means 2MB
 * @param {Integer} fileType 0 refers to images,1 PDF,2 word, 3 excel, 4 Power point
 * @notes The above ids should be sent without the #
 * @date Written on 08 July 2020
 * @returns {Boolean} returns true if the file is valid and false otherwise
 * @author Mohamed Saphir Souaibou <mohamedsaphir@gmail.com>
 */
function validateFile(inputFileTagId, requiredFileSize = 2.0000, fileType = 0) {
    let imgFile = $(inputFileTagId).prop('files')[0];
    //Converts to MB with 4 decimal places
    let fileSize = ((imgFile.size / 1024) / 1024).toFixed(4);
    let requiredSize = requiredFileSize
    let fileExtension = [];
    fileExtension = imgFile.name.split(".")
    let allowedExtensions = (fileType == 0) ? ["PNG", "JPEG", "JPG"] : ["PDF"]
    if ((!allowedExtensions.includes(fileExtension.reverse()[0].toUpperCase())) || (fileSize > requiredSize)) {
        return false;
    } else {
        return true;
    }
}


/**
 * @description Gets data to be posted and creates a given resource on the server
 * side
 * @param {Array} id id of data to be deleted
 * @param {String} url Url to the desired route
 * @param {String} successMessage success message to be displayed
 * @param {String} errorMessage error message to be displayed
 * @param {Boolean} reload Determines if the current page should be reloaded or not
 * @param {String} redirectTo redirection link to the desired page
 * @notes The data to be submitted(formData) should have the format of key-value 
 * @date Written on 08 July 2020
 * @author Mohamed Saphir Souaibou <mohamedsaphir@gmail.com>
 */
function deleteWithFormData(id, url, successMessage, errorMessage, reload, redirectTo = "") {
    // let formData = new FormData();
    //Splitting Array into field and field value
    /*data.forEach(element => {
        let info = element.split("&")
        formData.append(info[0],info[1] )
    });*/
    //Submit data

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id": id
        },
        url: url
    }).done(function (response) {
        let JResponse = JSON.parse(response);
        if (JResponse.status == "success") {
            //$('#addUserModal').modal('hide')
            // $('#successUser').toast('show')
            alert(successMessage);
            reload == true ? location.reload() : window.location.href = redirectTo;

        } else {
            //  $('#failUser').toast('show')
            alert(errorMessage);
        }

    }).fail(function (error) {
        console.error(error);
    });


}

/**
 * @description Gets data to be posted and creates a given resource on the server
 * side
 * @param {Array} data  data to be queried
 * @param {String} url Url to the desired route
 * @param {String} fieldId Field Id of the search field
 * @param {String} fieldSpanId Span id of the field in question to display messages
 * @param {String} successMessage success message to be displayed
 * @param {String} errorMessage error message to be displayed
 * @return {Boolean} true or false if it is valid
 * @date Written on 16 July 2020
 * @author Mohamed Saphir Souaibou <mohamedsaphir@gmail.com>
 */
async function searchValidField(data, url, fieldId, fieldSpanId, successMessage, errorMessage) {
    let response = null;
    let xhr = await $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: url,
        data: data
    }).done(function (response) {
        //  value of field to be verified  does not  exist
        $(fieldSpanId).text(successMessage)
        $(fieldSpanId).css('color', 'green')
        $(fieldId).css('border', '1px solid lightgrey')

    }).fail(function (error) {
        //  value of field to be verified  already exist
        $(fieldSpanId).text(errorMessage)
        $(fieldSpanId).css('color', 'red')
        $(fieldSpanId).css('display', 'block')
        $(fieldId).css('border', '2px solid red')
    });
    xhr = JSON.parse(xhr)
    response = (xhr.isValid) ? true : false
    return response;
}

/**
 * @description Displays a given data table
 * @param {String} dataTableId Id  of the datable in the form "#Id"
 * @param {Array} data  data of the data table in json format 
 * @param {Array} columns columns the data table should have in the format:
 * columns =  [{
 * "data": "nom"
    },
    {
     "data": "action"
     },
    {
    "data": "created_at"
    },
   ]
 * @date Written on 21 July 2020
 * @author Mohamed Saphir Souaibou <mohamedsaphir@gmail.com>
 */
function showDataTable(dataTableId, data, columns) {
    //Data Table
    $(dataTableId).DataTable({
        /* serverSide: true,
         processing: true,*/
        data: data,
        "columns": columns,
        /* ajax: {

             url: '/admin/registres',
             type: 'GET',
         },*/
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',

        ],
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable: "Aucune donnée disponible dans le tableau",
            paginate: {
                first: "Premier",
                previous: "Pr&eacute;c&eacute;dent",
                next: "Suivant",
                last: "Dernier"
            },
            aria: {
                sortAscending: ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }

    });

    //End Data Table
}




/**
 * 
 * Additional Methods regarding data tables
 */

/**
 * @description Funtion to load data in the datatable section
 * @author landryjohnmeli
 */
function loadData(tableId, data, columns, callback = null) {
    $(tableId).DataTable({
        data,
        pageLength: 1000,
        columns,
        dom: getDTSetting().dom,
        buttons: getDTSetting().buttons,
        language: getDTSetting().language,
        initComplete: (settings, json) => {
            if (callback) callback()
        }
    })
}

/**
 * @description Another code to preview Image
 * @version 1.1
 * @author Landry john Méli <landryjohnmeli@gmail.com>
 */
function previewFile(
    input,
    previewSectionId,
    helperSpanId,
    successMessage = "Fichier valide",
    errorMessage = "Fichier invalide"
) {
    let file = $(input).get(0).files[0];

    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            $(`${previewSectionId}`).attr("src", reader.result);
        };
        reader.readAsDataURL(file);
    }

    if (validateFile(input)) {
        if (successMessage != "") {
            $(helperSpanId).text(successMessage);
            $(helperSpanId).css("color", "green");
            // readURL(input);
        } else {
            $(helperSpanId).css("color", "green");
            // readURL(input);
        }
    } else {
        if (errorMessage != "") {
            $(previewSectionId).attr("src", "");
            $(helperSpanId).text(errorMessage);
            $(helperSpanId).css("color", "red");
        } else {
            $(previewSectionId).attr("src", "");
            $(helperSpanId).css("color", "red");
        }
    }
}

/**
 * @description Function to get Datatable configuration
 * @author landryjohnmeli
 */
function getDTSetting() {
    return {
        dom: "Bfrtip",
        "pageLength": 50,
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable: "Aucune donnée disponible dans le tableau",
            paginate: {
                first: "Premier",
                previous: "Pr&eacute;c&eacute;dent",
                next: "Suivant",
                last: "Dernier"
            },
            aria: {
                sortAscending: ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    };
}

/**
 * @description Function to load ressource datatable
 * @author landryjohnmeli
 */
function loadRessourceDatatable(
    getEndRessourceEndpoint,
    successCallback,
    errorCallback
) {
    $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            url: getEndRessourceEndpoint
        })
        .done(function (data) {
            successCallback(data);
        })
        .fail(function (data) {
            errorCallback(data);
        });
}

/**
 * @description : This function is to get the id of the current resource when action button is clicked 
 * it takes in parameter the clicked node (e.target) 
 * @argument : Node node
 * @author : Landry John MELI, landryjohnmeli@gmail.com 
 */
function getResourceId(node) {
    let resourceId = node.getAttribute('data-id')
    // si resourceId == NULL <=> le click est sur l'icone svg ou path alors 
    if (!resourceId) {
        parentNode = node.parentNode.parentNode
        resourceId = parentNode.getAttribute("data-id")
    }
    return resourceId
}

/**
 * @description : Check if the clicked element is mapped to the right event before showing the modal
 * @argument : Node node, String eventMapper
 * @author : Landry John MELI, landryjohnmeli@gmail.com
 */
function eventController(node, eventMapper) {
    let mapper = node.getAttribute('data-mapper') == eventMapper
    // si resourceId == NULL <=> le click est sur l'icone svg ou path alors 
    if (!mapper) {
        parentNode = node.parentNode.parentNode
        mapper = parentNode.getAttribute("data-mapper") == eventMapper
    }
    return mapper
}

/**
 * 
 * @param {*} file 
 * @param {*} requiredFileSize 
 * @param {*} fileType 
 */
function validateFileByBuffer(file, requiredFileSize = 2.0000, fileType = 0) {
    let imgFile = file;
    //Converts to MB with 4 decimal places
    let fileSize = ((imgFile.size / 1024) / 1024).toFixed(4);
    let requiredSize = requiredFileSize
    let fileExtension = [];
    fileExtension = imgFile.name.split(".")
    let allowedExtensions = (fileType == 0) ? ["PNG", "JPEG", "JPG"] : ["PDF"]
    if ((!allowedExtensions.includes(fileExtension[1].toUpperCase())) || (fileSize > requiredSize)) {
        return false;
    } else {
        return true;
    }
}


/**
 * Verifies if the password inputted matches the regular expression
 * @param {String} passwordField id of the password  input
 * @param {String} passwordSpan id of the  password span to display error messages
 * @returns {Boolean} false in case it does not match
 * @author Mohamed Saphir <mohamedsaphir@gmail.com>
 */
function passwordVerify(passwordField, passwordSpan){
    let regex = new RegExp(
        "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})"
    );
    if (!regex.test($(passwordField).val())) {
        $(passwordSpan).text(
            "Le mot de passe n'est pas conforme.Mot de passe doit contenir minimum 6 caractères et aumoins: 1 Majuscule, 1 Minuscule, 1 caractère spécial(@,!,&,etc) et 1 chiffre )"
        )
        $(passwordSpan).css('color', 'red')
        $(passwordSpan).css('display', 'block')
        return false;
    }
    return true
}
/**
 * Verifies if the confirm password  inputted matches the password field
 * @param {String} passwordConfirmField id of the password confirm input
 * @param {String} passwordField  id of the password  input
 * @param {String} passwordConfirmSpan  id of the confirm password span to display error messages
 * @returns {Boolean} false in case it does not match
 * @author Mohamed Saphir <mohamedsaphir@gmail.com>
 */
    function confirmPassword(passwordConfirmField,passwordField, passwordConfirmSpan){
    
        if ($(passwordConfirmField).val() != $(passwordField).val()) {
            $(passwordConfirmSpan).text(
                "Mot de passe de confirmation ne correspond pas au mot de passe"
            )
            $(passwordConfirmSpan).css('color', 'red')
            $(passwordConfirmSpan).css('display', 'block')
            return false;
        }
    return true


}

/**
 * Checks username before submitting for creation/update  to ensure uniqueness
 * @param {String} usernameField id of the username input
 * @param {String} endpoint End point where the username is going to be checked
 * @param {String} usernameSpan   id of the username span to display error messages
 * @param {String} checkVariable Variable that decrements if constraint is not respected
 * @returns {Integer} 
 * @author Mohamed Saphir <mohamedsaphir@gmail.com>
 */
 function checkUsernameB4Submission(usernameField,endpoint,usernameSpan,checkVariable){
    data = {
        verifyField: "username",
        username: $(usernameField).val()
    }
    let count = checkVariable
   
    if ($(usernameField).val() != "") {
        //let count = checkVariable
        let res = null
        res =  searchValidField(data, endpoint, usernameField,
            usernameSpan, "Login disponible", "Ce login existe déjà");
        
        return (res == true) ? count : count--;
    } else {
        return count--
    }
}

/**
 * Checks email before submitting for creation/update  to ensure uniqueness
 * @param {String} email value of the email
 * @param {String} emailField id of the email input
 * @param {String} endpoint End point where the email is going to be checked
 * @param {String} emailSpan id of the email span to display error messages
 * @param {String} checkVariable Variable that decrements if constraint is not respected
 * @returns {*} Boolean (false) in case the value does not match regex and an integer otherwise
 * @author Mohamed Saphir <mohamedsaphir@gmail.com>
 */
 function checkEmailB4Submission(email,emailField,endpoint,emailSpan,checkVariable){
    let res = null 
    let count = checkVariable

    // Regular expression to check the validity of the email entered
      let testEmail = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(email);
      if (testEmail) {
          data = {
              verifyField: "email",
              email: email
          }
          
          // if the email is correct
          $(emailSpan).css('display', 'block')

          res = searchValidField(data, endpoint, emailField, emailSpan,
              "Email disponible",
              "Cette adresse mail existe déjà"); 

          count = res ? count : count-1;
          
          return count
      } else {
          $(emailSpan).text("Veuillez saisir une bonne adresse mail")
          $(emailSpan).css('color', 'red')
          $(emailSpan).css('display', 'block')
          return false;
      }
}

