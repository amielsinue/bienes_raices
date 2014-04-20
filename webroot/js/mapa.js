if( typeof(Bienes_Raices) == 'undefined'){
    var Bienes_Raices = {};
}
Bienes_Raices.Mapa = function(Coordenadas,Adapter){
    this.coordenadas = Coordenadas;  
    this.adapter = Adapter;
    this.init();
};

Bienes_Raices.Mapa.prototype = {
    constructor : Bienes_Raices.Mapa,
    init:function(){
        var that = this;
        if(this.coordenadas.latitud != 0 && this.coordenadas.longitud !=0){
            this.adapter.setDefaultMarker(this.coordenadas.latitud,this.coordenadas.longitud);
        }
        this.adapter.addListener('marking',function(lat,long){
            that.coordenadas.set(lat,long);
        });
    }    
}
/**
 * 
 * @param {string} CoordenadasInputId
 * @returns {Bienes_Raices.Mapa.Coordenadas}
 */
Bienes_Raices.Mapa.Coordenadas = function(CoordenadasInputId){
    this.element_id = CoordenadasInputId;
    this.el = null;
    this.latitud = 0;
    this.longitud = 0;
    this.init();
}
Bienes_Raices.Mapa.Coordenadas.prototype = {
    constructor  : Bienes_Raices.Mapa.Coordenadas,
    init:function(){
        this.el = document.getElementById(this.element_id);        
        if(this.el)
            this.map(this.el.value);
    },
    map:function(sCoordenadas){
        var aCoordenadas = sCoordenadas.split(',');
        if(typeof(aCoordenadas[1]) != 'undefined'){
            this.latitud = aCoordenadas[0];
            this.longitud = aCoordenadas[1];
        }
    },
    set:function(latitud,longitud){
        this.latitud = latitud;
        this.longitud = longitud;
        if(this.el)
            this.el.value = latitud+','+longitud;
    }
    
}
/**
 * 
 * @param {string} MapaContenedorId
 * @returns {Bienes_Raices.Mapa.GooleAdapter}
 */
Bienes_Raices.Mapa.GooleAdapter = function(MapaContenedorId,readOnly){
    this.zoom = 12;
    this.mapTypeId = google.maps.MapTypeId.HYBRID;
    this.element_id = MapaContenedorId;
    this.browserSupportFlag = new Boolean();
    this.el = null;
    this.engine;
    this.markers = [];
    this.markersIds= [];
    this.defaultLocalization;
    this.listeners = [];
    this.readOnly = readOnly | false;
    this.init();
}
Bienes_Raices.Mapa.GooleAdapter.prototype = {
    constructor : Bienes_Raices.Mapa.GooleAdapter,
    init: function(){
        this.el = document.getElementById(this.element_id);
        this.defaultLocalization = new google.maps.LatLng(31.7018776,-106.4039421);
        if(this.el)
            this.draw();
    },
    draw : function(){
        this.engine = new google.maps.Map(this.el, {
            zoom: this.zoom,
            mapTypeId : this.mapTypeId
        });
        this.localizeMe();  
        if(!this.readOnly)
            this.initEvents();
        //this.el.innerHTML = '<b>Drawing with google</b>';
    },    
    initEvents:function(){
        var that = this;
        google.maps.event.addListener(that.engine, 'click', function(event) {
            that.addMarker(event.latLng);
        });
    },
    addListener:function(event,callback){
        this.listeners[event] = callback;
    },
    localizeMe:function(){
        var that = this;
        try{            
            if(navigator.geolocation) { // Try W3C Geolocation method (Preferred)
                that.browserSupportFlag = true;
                navigator.geolocation.getCurrentPosition(function(position) {                  
                    var initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                    that.engine.setCenter(initialLocation);
                    that.setMarker('center',initialLocation,'Aqui estoy','http://google-maps-icons.googlecode.com/files/home.png','','Aqui estoy', true);
                }, function() {
                    throw Error('No localizable');
                });

            } else if (google.gears) { // Try Google Gears Geolocation
                this.browserSupportFlag = true;
                var geo = google.gears.factory.create('beta.geolocation');
                geo.getCurrentPosition(function(position) {
                    var initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
                    that.engine.setCenter(initialLocation);
                    that.setMarker(that.engine,'center',initialLocation,'Aqui estoy','http://google-maps-icons.googlecode.com/files/home.png','','Aqui estoy', true);
                }, function() {
                    throw Error('No localizable');
                });
            } else {
                // Browser doesn't support Geolocation
                this.browserSupportFlag = false;
                throw Error('No localizable');
            }
        }catch(e){
            this.engine.setCenter(this.defaultLocalization);
            this.engine.setZoom(12);
        }
    },
    setMarker:function(id, position, title, icon, shadow, content, showInfoWindow){        
        var that = this;
        var index = that.markers.length;
        if(index > 0){
            return;
        }
        that.markersIds[that.markersIds.length] = id;
        that.markers[index] = new google.maps.Marker({
                position: position,
                map: that.engine,
                icon: icon,
                shadow: shadow,
                title:title
            });
        if(content != '' && showInfoWindow){
            var infowindow = new google.maps.InfoWindow({
                content: content
            });
            google.maps.event.addListener(that.markers[index], 'click', function() {
                infowindow.open(that.engine,that.markers[index]);
            });
        }
    },
    setDefaultMarker:function(latitude,longitude){        
        this.addMarker(new google.maps.LatLng(latitude,longitude));
        this.engine.setCenter(new google.maps.LatLng(latitude,longitude));
        this.engine.setZoom(15);
    },
    addMarker:function (location) {          
          this.deleteMarkers();
          var marker = new google.maps.Marker({
            position: location,
            map: this.engine
          });
          //$('#InmuebleMapa').val(marker.position.k+','+marker.position.A);
          if(typeof(this.listeners['marking']) != 'undefined'){
              var callback = this.listeners['marking'];
              callback(marker.position.k,marker.position.A);
          }
          this.markers.push(marker);
    },
    // Sets the map on all markers in the array.
    setAllMap:function (map) {
          for (var i = 0; i < this.markers.length; i++) {
            this.markers[i].setMap(map);
          }
        },
        // Removes the markers from the map, but keeps them in the array.
    clearMarkers:function() {
          this.setAllMap(null);
    },
    // Deletes all markers in the array by removing references to them.
    deleteMarkers:function () {
          this.clearMarkers();
          this.markers = [];
    }
    
}