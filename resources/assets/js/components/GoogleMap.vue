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
        ],
        data() {
            return {
                mapName: this.name + "-map",
                marker: null,
                markers: [{
                    latitude: 48.466111,
                    longitude: 35.025278,
                }],
                maps: null,
                map: null,
                geocoder: null,
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

            // this.addMarkers(map);
            this.addDraggableMarker();
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
                this.markers.forEach((coord) => {
                    const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                    const marker = new google.maps.Marker({
                        position,
                        map
                    });
                });
            },

            addDraggableMarker() {
                let map = this.map;
                let that = this;
                this.markers.forEach((coord) => {
                    const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                    this.marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: 'Перетягніть маркер, щоб помітити потрібне місце на мапі',
                        draggable: true,
                    });

                    this.maps.event.addListener(this.marker, 'drag', function() {
                        that.$emit('markerDragged', that.marker.getPosition());
                    });
                });
            },
        }
    };
</script>

<style scoped>
    .google-map {
        width: 100%;
        height: 600px;
        margin: 0 auto;
        background: #ebebeb;
    }
</style>