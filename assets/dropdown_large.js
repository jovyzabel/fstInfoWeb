document.addEventListener("DOMContentLoaded", function(){
    // Prevent closing from click inside dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function(element){
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    })
    
    const myurl = $('#coursesMenu').attr('href');
    $.get( { url: myurl, method: "GET", dataType : "json",} )
    .done(function (response) {
        licenceSpecialities = findFormationCycle(response,'licence') ? findFormationCycle(response,'licence').specialities : null;
        masterSpecialities = findFormationCycle(response,'master') ? findFormationCycle(response,'master').specialities : null;
        doctoratSpecialities = findFormationCycle(response,'doctorat') ? findFormationCycle(response,'doctorat').specialities : null;

        $.each(licenceSpecialities, function(index,licenceSpecialities){
            $('#licenceItems').append(
                `<li>
                    <a href="${myurl+'/'+licenceSpecialities.slug}" class="text-decoration-none header-link">
                        ${licenceSpecialities.label}
                    </a>
                </li>`
            )
        })

        $.each(masterSpecialities, function(index,masterSpecialities){
            $('#masterItems').append(
                `<li>
                    <a href="${myurl+'/'+masterSpecialities.slug}" class="text-decoration-none header-link">
                        ${masterSpecialities.label}
                    </a>
                </li>`
            )
        })

        $.each(doctoratSpecialities, function(index,doctoratSpecialities){
            $('#doctoratItems').append(
                `<li>
                    <a href="${myurl+'/'+doctoratSpecialities.slug}" class="text-decoration-none header-link text-muted">
                        ${doctoratSpecialities.label}
                    </a>
                </li>`
            )
        })

    
    })
});

const findFormationCycle = function (formaionCycles, label) {
    const formationCycleReturned = formaionCycles.find(function(formationCycle, index){
        return formationCycle.label.toLowerCase() === label.toLowerCase()
    });
    return formationCycleReturned;
}

$("#coursesMenu").on('mouseenter',function(event){        
    event.preventDefault() ;
    
    return false;
});