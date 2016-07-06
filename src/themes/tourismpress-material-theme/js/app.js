$(document).ready(function() {

  var newDate = Date.now().valueOf();
  //console.log('newDate: ' + newDate);
  $('#test').data('timestamp', newDate);

  var intervalID = window.setInterval(myCallback, 2000);

  function myCallback() {
    $('.events-listing li').each(function(index) {
      //console.log(index + ": " + $( this ).data('timestamp') );
      var event_timestamp = $(this).data('timestamp') + 14400000;
      var current_time = Date.now().valueOf() ;
      //console.log("Current Time:" + current_time + " Event Time: " + event_timestamp);
      if(current_time > event_timestamp){
        $(this).removeClass('show');
        //$('.events-listing li:nth-child(2)').append($('#upnext'));
      }
    });
  }

  //$('.events-listing li:nth-child(1)').append($('#upnext'));

  $('#carousel-events').carousel({
    interval: 10000,
    pause: ''
  });


});

//Twitter
window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));

