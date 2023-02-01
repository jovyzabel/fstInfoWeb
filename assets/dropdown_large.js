document.addEventListener("DOMContentLoaded", function(){
    // $('.dropdown-menu').click(function(e){
    //     e.stopPropagation();
    // });
    
    const myurl = $('#coursesMenu').attr('href');
    $.ajax({url: myurl, method: "GET", dataType: "json"}).done(function (response) {
        let licenceSpecialities = findFormationCycle(response,'licence') ? findFormationCycle(response,'licence').specialities : null;
        let masterSpecialities = findFormationCycle(response,'master') ? findFormationCycle(response,'master').specialities : null;
        let doctoratSpecialities = findFormationCycle(response,'doctorat') ? findFormationCycle(response,'doctorat').specialities : null;
    
        appendSpecialities('#licenceItems', licenceSpecialities);
        appendSpecialities('#masterItems', masterSpecialities);
        appendSpecialities('#doctoratItems', doctoratSpecialities);
    });


// make it as accordion for smaller screens
if (window.innerWidth < 992) {

  // close all inner dropdowns when parent is closed
  document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
    everydropdown.addEventListener('hidden.bs.dropdown', function () {
      // after dropdown is hidden, then find all submenus
        this.querySelectorAll('.submenu').forEach(function(everysubmenu){
          // hide every submenu as well
          everysubmenu.style.display = 'none';
        });
    })
  });

  document.querySelectorAll('.dropdown-menu a').forEach(function(element){
    element.addEventListener('click', function (e) {
        let nextEl = this.nextElementSibling;
        if(nextEl && nextEl.classList.contains('submenu')) {	
          // prevent opening link if link needs to open dropdown
          e.preventDefault();
          if(nextEl.style.display == 'block'){
            nextEl.style.display = 'none';
          } else {
            nextEl.style.display = 'block';
          }

        }
    });
  })
}
// end if innerWidth
}); 
// DOMContentLoaded  end

function findFormationCycle(formaionCycles, label) {
    return formaionCycles.find(function(formationCycle) {
        return formationCycle.label.toLowerCase() === label.toLowerCase();
    });
}

function appendSpecialities(selector, specialities) {
    if(!specialities){
        $(selector).remove()
        return;
    } 
    let parentUrl = $(selector).prev().attr('href');

    specialities.forEach(function(speciality){
        $(selector).append(
            `<li><a href="${parentUrl}/${speciality.slug}" class="dropdown-item" href="#">${speciality.label}</a></li>`
        );
    });
}

$("#coursesMenu").mouseenter(function(event){        
    event.preventDefault();
    return false;
});