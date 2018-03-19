function beginSearch () {
  $('#preSearch').hide()
  $('#searchArea').removeClass('hidden')
  // if (navigator.geolocation) { //navigator.
  if (geoPosition.init()) {
    geoPosition.getCurrentPosition(success, errorHandler, {
      timeout: 5000
    })
  } else {
    error('Disculpe, el navegador no pudo encontrar su Localizacion')
  }
}

function success (position) {
  $('#actionBar').removeClass('hidden')
  $('#autolocateAlert').addClass('hidden')
  var s = document.querySelector('#status')
  // var buttons = document.querySelector('#locate_actions');
  if (s.className == 'success') {
    // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back
    return
  }
  s.innerHTML = 'Busqueda Finalizada: ESTAS AQUI'
  s.className = 'success'
  var mapcanvas = document.createElement('div')
  mapcanvas.id = 'mapcanvas'
  mapcanvas.style.height = '400px'
  mapcanvas.style.width = '400px'
  mapcanvas.style.border = '1px solid black'
  document.querySelector('article').appendChild(mapcanvas)
  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
  var myOptions = {
    zoom: 16,
    center: latlng,
    mapTypeControl: false,
    navigationControlOptions: {
      style: google.maps.NavigationControlStyle.SMALL
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById('mapcanvas'), myOptions);
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: 'Estas aqui.! (al menos con ' + position.coords.accuracy + 'metros de error)'
  })
  $('#locate_actionbar').removeClass('hidden')
  document.getElementById('lugar-lat').value = position.coords.latitude
  document.getElementById('lugar-lng').value = position.coords.longitude
}

function errorHandler (err) {
  var s = document.querySelector('#status')
  s.innerHTML = typeof msg == 'string' ? msg : "failed"
  s.className = 'fail'
  // if (err.code == 1) {} // user said no!
  document.location.href = '/lugar/index?errorLocate'
}

/*
 * Proyecto Hecho Por Yoimar Urbina
 */
