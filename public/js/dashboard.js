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

/**
 * @description Validates a file from an input type file 
 * @param {String} inputFileTagId Id of the input file tag
 * @param {Double} requiredFileSize required file size with 4 decimal places . example 2.0000 means 2MB
 * @param {Integer} fileType 0 refers to images,1 PDF,2 word, 3 excel, 4 Power point
 * @notes The above ids should be sent without the #
 * @date Written on 08 July 2020
 * @returns {Boolean} returns true if the file is valid and false otherwise
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