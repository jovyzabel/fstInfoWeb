document.addEventListener("DOMContentLoaded", function(){
    // Prevent closing from click inside dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function(element){
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    })
});

// const myurl = $('#notificationLink').attr('href');
// const notificationsBox = $(".notifications");
// $("#notificationLink").click(function(event)
// {        
//     event.preventDefault() ;
//     $("#notificationContainer").fadeToggle(300);
//     $("#notification_count").fadeOut("slow");
//     $.get( { url: myurl, method: "GET", dataType : "json",} )
//     .done(function (response) {
//         notificationsBox.html("");
//         $.each(response, function (index, response) {
//             let date = new Date(response.createdAt)
//             const options = { year: 'numeric', month: 'numeric', day: 'numeric' , hour: 'numeric', minute: 'numeric', second:'numeric'}

//             notificationsBox.append(
//             `<div class="d-flex mx-1">
//                 <a href="${response.route} " class="text-dark text-decoration-none hover-notification">
//                     <div class="rounded">
//                         ${response.description} <br >
//                         <small class="text-primary" >Le ${date.toLocaleDateString("fr-FR", options)} </small>
//                     </div>
//                 </a>
//             </div>
//                 <hr>
//                 `
//             )
//         })
//     })
//     return false;
// });