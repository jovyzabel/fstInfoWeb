import validate from "jquery-validation";
require('jquery-validation/dist/additional-methods')
$(document).ready(function() {
    
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
        }, 'La taille du ficchier doit être inferieur à {0}');

        $.validator.addClassRules({
            document_label: {
                required: true,
                minlength: 6
            },
            document_file: {
                required: true,
                extension: "pdf",
                filesize: 2000
            }
            });
    };

    $('ul.documents li').each((i, document) => {
        addTagFormDeleteLink(document)
    });

    $('.add_item_link').on("click", addFormToCollection);

    let formStepsNum = 0;

    $(".btn-prev, .btn-next").on("click", function() {
        if ($('#preRegistrationForm').valid()) {
            
            formStepsNum += $(this).hasClass("btn-next") ? 1 : -1;
            updateFormSteps();
            updateProgressbar();

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
            $("#recap").html(`<div class="my-3">
            <div class="card-body">
                <h5 class="card-title">Informations personnelles</h5>
                <table class="table table-hover">
                    <tr >
                        <td >Nom(s) </td>
                        <td >${formData.get('pre_registration[student][name]')}</td>
                    </tr>
                    <tr >
                        <td>Prénom(s) </td>
                        <td>${formData.get('pre_registration[student][firstName]')}</td>
                    </tr>
                    <tr >
                        <td>Civilité </td>
                        <td>${formData.get('pre_registration[student][civility]')}</td>
                    </tr>
                    <tr >
                        <td>Date de naissance </td>
                        <td>${formData.get('pre_registration[student][birthDay]')}</td>
                    </tr>
                    <tr >
                        <td>Lieu de naissance </td>
                        <td>${formData.get('pre_registration[student][birthPlace]')}</td>
                    </tr>
                    <tr >
                        <td>Nationalité </td>
                        <td>{{ pre_registration.student.nationality }}</td>
                    </tr>
                    
                </table>
            </div>
        </div>

        <div class="mb-3 border-0 shadow-sm card">
            <div class="card-body">
                <h5 class="card-title">Adresse et modalités contact</h5>
                <table class="table table-hover">
                    <tr >
                        <td >Adresse </td>
                        <td >
                            ${formData.get('pre_registration[student][address][street_number]')} 
                            ${formData.get('pre_registration[student][address][street_name]')},
                            ${formData.get('pre_registration[student][address][quater_name]')},
                            ${formData.get('pre_registration[student][address][city]')},
                            ${formData.get('pre_registration[student][address][country]')}

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
        </div>`);
        }
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

});
