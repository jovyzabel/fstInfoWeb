$(document).ready(function(){
    $('.dropdown-menu').click(function(e){
        e.stopPropagation();
    });

    const myurl = $('#coursesMenu').attr('href');
    $.ajax({
        url: myurl,
        method: "GET",
        dataType: "json"
    }).done(function (response) {
        let licenceSpecialities = findFormationCycle(response,'licence') ? findFormationCycle(response,'licence').specialities : null;
        let masterSpecialities = findFormationCycle(response,'master') ? findFormationCycle(response,'master').specialities : null;
        let doctoratSpecialities = findFormationCycle(response,'doctorat') ? findFormationCycle(response,'doctorat').specialities : null;

        appendSpecialities('#licenceItems', licenceSpecialities);
        appendSpecialities('#masterItems', masterSpecialities);
        appendSpecialities('#doctoratItems', doctoratSpecialities);
    });
});

function findFormationCycle(formaionCycles, label) {
    return formaionCycles.find(function(formationCycle) {
        return formationCycle.label.toLowerCase() === label.toLowerCase();
    });
}

function appendSpecialities(selector, specialities) {
    if(!specialities) return;
    let parentUrl = $(selector).prev().find('a').attr('href');

    specialities.forEach(function(speciality){
        $(selector).append(
            `<li>
                <a href="${parentUrl}/${speciality.slug}" class="text-decoration-none header-link">
                    ${speciality.label}
                </a>
            </li>`
        );
    });
}

$("#coursesMenu").mouseenter(function(event){        
    event.preventDefault();
    return false;
});