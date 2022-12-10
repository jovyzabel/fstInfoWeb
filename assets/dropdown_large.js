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
        licenceSpecialities = response[0]['specialities'];
        masterSpecialities = response[1]['specialities'];
        doctoratSpecialities = response[2]['specialities'];

        console.log(myurl)
    
        $.each(licenceSpecialities, function(index,licenceSpecialities){
            $('#licenceItems').append(
                `<li><a href="${myurl+'/'+licenceSpecialities.slug}" class="text-decoration-none header-link">${licenceSpecialities.label}</a></li>`
            )
        })

        $.each(masterSpecialities, function(index,masterSpecialities){
            $('#masterItems').append(
                `<li><a href="${myurl+'/'+masterSpecialities.slug}" class="text-decoration-none header-link">${masterSpecialities.label}</a></li>`
            )
        })

        $.each(doctoratSpecialities, function(index,doctoratSpecialities){
            $('#doctoratItems').append(
                `<li><a href="${myurl+'/'+doctoratSpecialities.slug}" class="text-decoration-none header-link">${doctoratSpecialities.label}</a></li>`
            )
        })

    
    })
});

$("#coursesMenu").on('mouseenter',function(event){        
    event.preventDefault() ;
    
    return false;
});