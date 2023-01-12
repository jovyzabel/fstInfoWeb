$(document).ready(function() {
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
    };

    $('ul.documents li').each((i, document) => {
        addTagFormDeleteLink(document)
    });

    $('.add_item_link').on("click", addFormToCollection);

    let formStepsNum = 0;

    $(".btn-prev, .btn-next").on("click", function() {
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
                $documentsRecap.append($("<tr>").text(el));
            });
            $("#recap").html(`<div class="mb-3 border-0 shadow-sm card">
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
                    {# <tr >
                        <td>Nationalité </td>
                        <td>{{ pre_registration.student.nationality }}</td>
                    </tr> #}
                    
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
    });

    function updateFormSteps() {
        $(".form-step").removeClass("form-step-active").eq(formStepsNum).addClass("form-step-active");
    }

    function updateProgressbar() {
        $(".progress-step").removeClass("progress-step-active").slice(0, formStepsNum + 1).addClass("progress-step-active");
        $("#progress").css({ width: (formStepsNum + 1) / $(".progress-step").length * 100 + "%" });
    }

    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = $("#file-ip-1-preview");
            $(preview).attr("src", src).show();
        }
    }
});