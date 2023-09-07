import validate from "jquery-validation";
require('jquery-validation/dist/additional-methods')
$(document).ready(function() {

    const regionNames = new Intl.DisplayNames(['fr'], {type: 'region'});
    
    $('#preRegistrationForm').validate({
        errorElement: 'span',
        errorClass: 'text-danger',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').addClass("has-error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass("has-error");
        },
        rules: {
            'pre_registration[student][firstName]': "required",
            'pre_registration[student][name]': "required",
            'pre_registration[student][birthDay]': {
                required: true,
                date: true,
            },
            'pre_registration[student][birthPlace]': "required",
            'pre_registration[student][civility]': "required",
            'pre_registration[student][nationality]': "required",
            'pre_registration[student][address][street_number]':{
                required:false,
                digits:true,
            },

            'pre_registration[student][telephone]': {
                required:true,
                maxlength:13,
                digits:true
            },

            'pre_registration[student][email]':{
                required:true,
                email:true,
                minlength:6,
            },
            'pre_registration[speciality]':{
                required:true,
            }
        },
        // Specify validation error messages
        messages: {
            'pre_registration[student][firstName]': 		"Le prénom est obligatoire",
            'pre_registration[student][name]': 		"Le nom est obligatoire",
            'pre_registration[student][email]': {
                required: 	"L'adresse email est obligatoire",
                email: 		"Veuillez entrer un adresse email valide",
            },
            'pre_registration[student][telephone':{
                required: 	"Le numéro de téléphone est obligatoire",
                maxlength: 	"Le numéro de téléphone ne doit pas contenir plus de 13 caracteres",
                digits: 	"Seuls les chiffres sont autorisés pour ce champs"
            },
            'pre_registration[speciality]':{
                required: 	"La spécialité est obligatoire",
            },
        }
			
    })
    const addTagFormDeleteLink = (item) => {
        const removeFormButton = $('<button class="btn btn-warnig">').text('Supprimer');
        $(item).append(removeFormButton);

        removeFormButton.on('click', (e) => {
            e.preventDefault();
            // remove the li for the tag form
            $(item).remove();
        });
    }

    const addFormToCollection = (e) => {
        const collectionHolder = $('.' + $(e.currentTarget).data('collectionHolderClass'));

        const item = $('<li>').html(collectionHolder.data('prototype').replace(/__name__/g, collectionHolder.data('index')));
        collectionHolder.append(item);
        addTagFormDeleteLink(item);

        collectionHolder.data('index', collectionHolder.data('index') + 1);
        /**Ajout des validateurs pour le label et le cichier du document */
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'La taille du ficchier doit être inferieur à 2MB');

        $.validator.addClassRules({
            document_label: {
                required: true,
                minlength: 6
            },
            document_file: {
                required: true,
                extension: "pdf",
                filesize: 2097152
            }
            });
    };

    $('ul.documents li').each((i, document) => {
        addTagFormDeleteLink(document)
    });

    $('.add_item_link').on("click", addFormToCollection);

    let formStepsNum = 0;

    $(".btn-prev, .btn-next").on("click", function() {
        if ($(this).hasClass("btn-next")) {
            if ($('#preRegistrationForm').valid()) {
                formStepsNum += 1;
                updateFormSteps();
                updateProgressbar();
            }
        }
        if ($(this).hasClass("btn-prev")) {
            formStepsNum += -1;
            updateFormSteps();
            updateProgressbar();
        }

        if ($(this).attr("id") === "lastNext") {
            let formData = new FormData($("#preRegistrationForm")[0]);
            let documentsList = [];
            $("ul.documents li input[type='text']").each(function() {
                documentsList.push($(this).val());
            });
            let $documentsRecap = $("#documentsRecap");
            $documentsRecap.empty();
            documentsList.forEach(function(el) {
                $documentsRecap.append($("<tr>").html(`<td >${el}</td>`));
            });

            console.log(...formData)

            $("#recap").html(`<div class="my-3">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">Informations personnelles</h5>
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr >
                                    <td >Nom(s) et Prénom(s)</td>
                                    <td >${formData.get('pre_registration[student][name]')} ${formData.get('pre_registration[student][firstName]')}</td>
                                </tr>
                                <tr >
                                    <td>Nom d'épouse </td>
                                    <td>${formData.get('pre_registration[student][marriedName]')}</td>
                                </tr>
                                <tr >
                                    <td>Date et lieu de naissance </td>
                                    <td>le ${formData.get('pre_registration[student][birthDay]')} ${formData.get('pre_registration[student][birthPlace]')}</td>
                                </tr>
                                <tr >
                                    <td>Civilité </td>
                                    <td>${formData.get('pre_registration[student][civility]')}</td>
                                </tr>

                                <tr >
                                    <td>Nationalité </td>
                                    <td>${regionNames.of(formData.get('pre_registration[student][nationality]'))}</td>
                                </tr>
                                <tr >
                                    <td>Type de pièce </td>
                                    <td>${formData.get('pre_registration[student][identificationDocument][typeOfDocument]')}</td>
                                </tr>
                                <tr >
                                    <td>Numéro </td>
                                    <td>${formData.get('pre_registration[student][identificationDocument][identificationNumber]')}</td>
                                </tr>
                                <tr >
                                    <td>Date d'émission </td>
                                    <td>${formData.get('pre_registration[student][identificationDocument][dateOfIssue]')}</td>
                                </tr>
                                <tr >
                                    <td>Lieu d'émission </td>
                                    <td>${formData.get('pre_registration[student][identificationDocument][placeOfIssue]')}</td>
                                </tr>
                                
                            </table>
                        </div>

                        <div class="col-md-6">

                            <table class="table table-hover">
                                <tr >
                                    <td colspan="2">Personne ressource qu'on peut contacter</td>
                                </tr>
                                <tr >
                                    <td>Nom et prénom </td>
                                    <td>${formData.get('pre_registration[student][contactPerson][name]')}</td>
                                </tr>
                                <tr >
                                    <td>Adresse</td>
                                    <td>le ${formData.get('pre_registration[student][contactPerson][address]')} ${formData.get('pre_registration[student][birthPlace]')}</td>
                                </tr>
                                <tr >
                                    <td>Tel</td>
                                    <td>${formData.get('pre_registration[student][contactPerson][telephone]')}</td>
                                </tr>
                                <tr >
                                    <td>Profession</td>
                                    <td>${formData.get('pre_registration[student][contactPerson][job]')}</td>
                                </tr>
                                <tr >
                                    <td>Lien</td>
                                    <td>${formData.get('pre_registration[student][contactPerson][relationLink]')}</td>
                                </tr>
                                
                            </table>

                            <hr>

                            <table class="table table-hover">
                                <tr >
                                    <td>Dernier établissement</td>
                                    <td>${formData.get('pre_registration[student][lastSchool]')}</td>
                                </tr>
                                <tr >
                                    <td>Dernier diplôme</td>
                                    <td>le ${formData.get('pre_registration[student][lastDiploma]')} </td>
                                </tr>
                                
                                
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <div class="mb-3 border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">modalités de contact</h5>
                    <table class="table table-hover">
                        <tr >
                            <td >Adresse </td>
                            <td >
                                ${formData.get('pre_registration[student][address][name]')} 
                                ${formData.get('pre_registration[student][address][city]')},
                                ${regionNames.of(formData.get('pre_registration[student][address][country]'))}

                            </td>
                        </tr>
                        <tr >
                            <td>Téléphone </td>
                            <td>${formData.get('pre_registration[student][telephone]')}</td>
                        </tr>
                        <tr >
                            <td>Email</td>
                            <td>${formData.get('pre_registration[student][email]')}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mb-3 border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">Licence : ${formData.get('pre_registration[lastCurriculum][title]')}</h5>

                    <table class="table table-bordered border-dark">                        
                        <thead>
                            <tr>
                                <th></th>
                                <td>Année de validation</td>
                                <td>Session ordinaire ou rattrapage</td>
                                <td>Moyenne (/20)</td>
                                <td>Etablissement ou Ecole (Ville/Pays)</td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <th>S1</th>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterOneValidationYear]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterOneValidationSession]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterOneAverage]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][school]')}</td>
                            </tr>
                            <tr>
                                <th>S2</th>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterTwoValidationYear]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterTwoValidationSession]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][semesterTwoAverage]')}</td>
                                <td>${formData.get('pre_registration[lastCurriculum][school]')}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="card-title">Baccalauréat</h5>

                    <table class="table table-bordered border-dark">                        
                        <thead>
                            <tr>
                                <td>Série</td>
                                <td>Intitulé</td>
                                <td>Année d'obtention</td>
                                <td>Lycée (Ville/pays)</td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>${formData.get('pre_registration[baccalaureatDiploma][serie]')}</td>
                                <td>${formData.get('pre_registration[baccalaureatDiploma][titled]')}</td>
                                <td>${formData.get('pre_registration[baccalaureatDiploma][year]')}</td>
                                <td>${formData.get('pre_registration[baccalaureatDiploma][placeOfAcquisition]')}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            

            <div class="mb-3 border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">Chox de formation</h5>
                    <table class="table table-hover">
                        <tr class="">
                            <td>Cycle de formation</td>
                            <td></td>
                        </tr> 
                        <tr class="">
                            <td>Spécialité</td>
                            <td></td>
                        </tr>          
                    </table>
                </div>
            </div>
            
            `);
        }
    });

    if ($(this).hasClass("lastNext")) {
        console.log("c'est un next");
    }

    function updateFormSteps() {
        $(".form-step").removeClass("form-step-active").eq(formStepsNum).addClass("form-step-active");
    }

    function updateProgressbar() {
        $(".progress-step").removeClass("progress-step-active").slice(0, formStepsNum + 1).addClass("progress-step-active");
        $("#progress").css({ width: (formStepsNum + 1) / $(".progress-step").length * 100 + "%" });
    }

    function toggleEnterpriseField() {
            if ($('#pre_registration_student_status').val() === 'Etudiant') {
                $('#pre_registration_student_job').val('')
                $('#pre_registration_student_job').prop('disabled', true); // Désactiver le champ "enterprise"
            } else {
                $('#pre_registration_student_job').prop('disabled', false); // Activer le champ "enterprise"
            }
        }

        // Écouteur d'événement pour détecter les changements dans le champ "status"
        $('#pre_registration_student_status').on('change', toggleEnterpriseField);

        // Assurez-vous de vérifier l'état initial du champ lors du chargement de la page
        toggleEnterpriseField();

});

//<td rowspan="6" ><img class="img-fluid" src="${URL.createObjectURL(formData.get('pre_registration[student][pictureFile][file]'))}" width="170px"></td>
