$(function() {

  var activeTooltip = '';
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-full-width",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "10000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }


  // Klicka på "Boka speltid" öppnar modalen
  $('.cta-button, .close-btn').click(function(e){
      e.preventDefault();
    $('.reservation-modal').slideToggle({
      specialEasing: 'ease-in',
      duration: 400,
    });
    $('html, body').animate({
      scrollTop: $(".reservation-modal").offset().top - 10
    }, 400);
  });

  // Öppnar tooltip
  $('.tiptool').click(function(){
    $('.test-tip').each(function () {
      if( activeTooltip != '' && !activeTooltip.is($(this)) ){
        $(this).animateCss('bounceOut');
      }
    })
    activeTooltip = $('[data-tooltip-id="' + $(this).data('id') + '"]');
    activeTooltip.animateCss('bounceIn');
  });
  // Stänger tooltip
  $('.close-tip').on('click', function(){
    activeTooltip.animateCss('bounceOut');
    activeTooltip = '';
  });


  $('[data-send-ajax]').click(function (e) {
    var clickedElement = $(this);
    var futureReservationsDiv = clickedElement.parent().parent().parent('.bokade-tider');

    $.ajax({
       url: "/reservation/softDelete/" + clickedElement.data('reservation-id'),
       success:function(deletedReservation) {
        console.log(deletedReservation);
        clickedElement.parent().hide();
        clickedElement.parent().parent('.bokad-tid').animateCss('zoomOutRight');
        setTimeout(function () {
          clickedElement.parent().parent('.bokad-tid').remove();
          console.log('antal: ' + futureReservationsDiv.children('.bokad-tid').length);
          if(futureReservationsDiv.children('.bokad-tid').length == 0){
            $('#empty-state-future-reservations').slideToggle();
          }
        }, 800);

        toastr.warning(
             deletedReservation.startFullDate
             +'-'+
             deletedReservation.stopTime
             + " <strong>Bokad av</strong>:" + deletedReservation.name
             +"<br><a href='reservation/restore/"+ deletedReservation.id + "'>Klicka här för att ångra</a>", "Bokning raderad");
         }
     });

  })

  $(document).on("mouseup.clickOFF touchend.clickOFF", function (e) {
      if (activeTooltip !== '' && !activeTooltip.is(e.target) // if the target of the click isn't the activeTooltip...
          && activeTooltip.has(e.target).length === 0) // ... nor a descendant of the activeTooltip
      {
          activeTooltip.animateCss('bounceOut');
          activeTooltip = '';
      }
  });

});

$.fn.extend({
    animateCss: function (animationName) {
      var wasVisible = true;
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        if(!$(this).is(':visible') ){
          wasVisible = false;
          $(this).show();
        }

        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
          $(this).removeClass('animated ' + animationName);
          if(wasVisible){
            $(this).hide();
          }
        });
    }
});
