<template>
    <div class="google-map" :id="mapName"></div>
</template>

<script>
    export default {
        name: 'google-map',
        props: [
            'name',
            'address',
            'city',
            'structure',
            'markersJson',
            'categoriesJson',
        ],
        data() {
            return {
                mapName: this.name + "-map",
                marker: null,
                markers: [],
                googleMarkers: [],
                maps: null,
                map: null,
                geocoder: null,
                resultLocation: null,
                infoWindow: null,
                categories: null,
            }
        },

        mounted() {
            const element = document.getElementById(this.mapName);
            const options = {
                zoom: 14,
                center: new google.maps.LatLng(48.466111,35.025278),
            };

            this.map = new google.maps.Map(element, options);
            this.maps = google.maps;
            this.geocoder = new google.maps.Geocoder();

            // Default Search read area
            this.resultLocation = new google.maps.Circle({
                strokeColor: '#f00',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: '#f00',
                fillOpacity: 0.35,
                radius: 60
            });

            // Default Info window for markers
            this.infowindow = new google.maps.InfoWindow({content: ""});

            if (this.markersJson) {
                this.markers = JSON.parse(atob(this.markersJson));
                this.categories = JSON.parse(atob(this.categoriesJson));
                this.addMarkers();
            } else {
                this.addDraggableMarker();
            }
        },

        watch: {
            address(newVal, oldVal) {
                if (newVal !== oldVal && newVal !== '') {
                    let that = this;
                    newVal = 'Україна, '+ this.city +', ' + newVal;
                    this.geocoder.geocode({'address': newVal}, function(results, status) {
                        if (status == that.maps.GeocoderStatus.OK) {
                            that.map.setCenter(results[0].geometry.location);
                            that.marker.setPosition(results[0].geometry.location);
                            that.$emit('markerDragged', that.marker.getPosition());
                        } else {
                            console.log(results);
                        }
                    });
                }
            }
        },

        methods: {
            addMarkers() {
                const map = this.map;
                this.markers.forEach((m) => {
                    const position = new google.maps.LatLng(m.latitude, m.longitude);
                    const icon = this.generateMarkerIcon(m);
                    const marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        icon: icon,
                        title: m.address,
                    });

                    this.attachInfoWindow(m, marker);

                    this.googleMarkers.push(marker);
                });

                const gridSize = 50;
                const mcOptions = {gridSize: gridSize, maxZoom: 15, imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'};
                const markerClusterer = new MarkerClusterer(map, this.googleMarkers, mcOptions);

                this.autoCenter();
                this.enableAutocomplete();
            },

            attachInfoWindow(data, marker) {
                const that = this;
                const category = this.categoryName(data.category_id);
                const type = this.categoryName(data.category_id);
                let content = "<div style='min-width: 200px; min-height: 100px;'><ul style='list-style:none;padding:0;margin:0'>";
                content += `<li>Адреса: <b>${data.address}</b></li>`;
                content += `<li>Категорiя: ${category}</li>`;
                if (type) {
                    content += `<li>Вид діяльності: ${category}</li>`;
                }
                content += "</ul></div>";

                marker.addListener('click', () => {
                    that.infowindow.setContent(content);
                    that.infowindow.open(that.map, marker);
                });
            },

            generateMarkerIcon(m) {
                // m.color.replace(/#/, '');
                // ToDo: Add color support
                const pinImage = new google.maps.MarkerImage("//chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|" + 'fff',
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0,0),
                    new google.maps.Point(10, 34));
                // const pinShadow = new google.maps.MarkerImage("//chart.apis.google.com/chart?chst=d_map_pin_shadow",
                //     new google.maps.Size(40, 37),
                //     new google.maps.Point(0, 0),
                //     new google.maps.Point(12, 35));

                return pinImage;
            },

            addDraggableMarker() {
                let map = this.map;
                let that = this;

                let position = this.map.getCenter();
                if (this.structure.latitude && this.structure.longitude) {
                    position = new google.maps.LatLng(this.structure.latitude, this.structure.longitude);
                }

                this.marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: 'Перетягніть маркер, щоб помітити потрібне місце на мапі',
                    draggable: true,
                });

                map.setCenter(that.marker.getPosition());

                that.$emit('markerDragged', that.marker.getPosition());

                this.maps.event.addListener(this.marker, 'drag', function () {
                    that.$emit('markerDragged', that.marker.getPosition());
                });
            },

            autoCenter() {
                const bounds = new google.maps.LatLngBounds();
                if (this.googleMarkers.length > 0) {
                    this.googleMarkers.forEach((m) => {
                        bounds.extend(m.getPosition());
                    });
                    this.map.fitBounds(bounds);
                }
            },

             enableAutocomplete() {
                const queryInput = document.getElementById('search-input');
                const autocomplete = new google.maps.places.Autocomplete(queryInput);
                autocomplete.bindTo('bounds', this.map);
                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    $('#search-input').val(place.name);
                    this.search();
                });
            },

            search() {
                this.resultLocation.setMap(null);
                const that = this;
                let address = document.getElementById('search-input').value.trim();
                if (address !== '') {
                    address =  'Україна, '+ this.city + ', ' + address;
                    this.geocoder.geocode({'address': address}, (results, status) => {
                        if (status === google.maps.GeocoderStatus.OK) {
                            that.map.setCenter(results[0].geometry.location);
                            that.map.fitBounds(results[0].geometry.viewport);
                            that.resultLocation.setCenter(results[0].geometry.location);
                            that.resultLocation.setMap(that.map);
                        }
                    });
                }
            },

            categoryName(categoryId) {
                let name = '';
                this.categories.forEach((c) => {
                    if (c.id === categoryId) {
                        name = c.name;
                        return;
                    }
                });

                return name;
            },
        }
    };
</script>

<style scoped>
    .google-map {
        height: 100%;
        width: 100%;
        margin: 0;
    }

    .google-map {
        position: relative;
    }
</style>