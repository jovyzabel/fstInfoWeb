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
            parentUrl  = $('#licenceItems').prev().children().eq(0).attr('href');
            console.log();
            $('#licenceItems').append(
                `<li>
                    <a href="${parentUrl+'/'+licenceSpecialities.slug}" class="text-decoration-none header-link">
                        ${licenceSpecialities.label}
                    </a>
                </li>`
            );
        })

        $.each(masterSpecialities, function(index,masterSpecialities){
            parentUrl  = $('#masterItems').prev().children().eq(0).attr('href');
            $('#masterItems').append(
                `<li>
                    <a href="${parentUrl+'/'+masterSpecialities.slug}" class="text-decoration-none header-link">
                        ${masterSpecialities.label}
                    </a>
                </li>`
            )
        })

        $.each(doctoratSpecialities, function(index,doctoratSpecialities){
            parentUrl  = $('#licenceItems').prev().children().eq(0).attr('href');
            $('#doctoratItems').append(
                `<li>
                    <a href="${parentUrl+'/'+doctoratSpecialities.slug}" class="text-decoration-none header-link">
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