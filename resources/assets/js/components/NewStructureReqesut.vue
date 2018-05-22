<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">ПІБ:<span class="require">*</span></label>
                                <input class="form-control" id="name" v-model="structure.name">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="phone">Адреса електронної пошти:<span class="require">*</span></label>
                                    <input type="text" class="form-control" id="phone" v-model="structure.email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Адреса:<span class="require">*</span></label>
                            <input type="hidden" v-model="newStructure.latitude"/>
                            <input type="hidden" v-model="newStructure.longitude"/>
                            <textarea rows="3" class="form-control form-control-sm" id="address" v-model="newStructure.address"></textarea>
                            <button @click="geoFindMe" id="find-me" class="btn btn-success float-md-right">Визначити моє мiсце знаходження</button>
                            <p v-if="geoLocationStatus" style="color: red">{{ geoLocationStatus }}</p>
                        </div>

                        <div class="form-group">
                            <label for="description">Коментарі:<span class="require">*</span></label>
                            <textarea rows="4" class="form-control form-control-sm" id="description" v-model="structure.description"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-3" v-for="(thumb, index) in structure.thumbs" style="float: left">
                                <img style="padding: 5px" width="100" height="75" :src="thumb">
                                <button class="btn btn-danger btn-sm" @click="removeFile(index)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 8 8">
                                        <path style="fill:white" d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z"  />
                                    </svg>
                                </button>
                            </div>

                            <div class="clearfix"></div>

                            <div v-if="structure.thumbs.length < 4">
                                <label for="photos">Додати фото (не більше 4-х):
                                    <br>
                                    <span class="upload-link">завантажити</span>
                                </label>
                                <input id="photos" type="file" name="photos" @change="filesChange($event.target.files, 'photos');" style="display: none;"  accept="image/jpg, image/jpeg, image/png, image/gif">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" @click="createStructureRequest">Надіслати данні</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import mixin from './../mixins';

    export default {
        mixins: [mixin],

        props: [
            'newStructure'
        ],

        data() {
            return {
                structure: this.emptyStructure(),
                geoLocationStatus: '',
            }
        },

        mounted() {

        },

        methods: {
            emptyStructure() {
                return {
                    name: "",
                    address: "",
                    email: "",
                    description: "",
                    latitude: "",
                    longitude: "",
                    photos: [],
                    thumbs: [],
                };
            },

            filesChange(fileList) {
                const that = this;
                const reader = new FileReader();
                // read the image file as a data URL.
                reader.readAsDataURL(fileList[0]);
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    that.structure.thumbs.push(e.target.result);
                };
                that.structure.photos.push(fileList[0]);
            },

            createStructureRequest() {
                const formData = new FormData();
                let i = 0;

                formData.append('structure_id', document.getElementById('structure_id').value);
                formData.append('name', this.structure.name);
                formData.append('phone', this.structure.phone);
                formData.append('email', this.structure.email);
                formData.append('category', this.structure.category);
                formData.append('description', this.structure.description);

                Array
                    .from(Array(this.structure.photos.length).keys())
                    .map(x => {
                        i++;
                        formData.append('photos[]', this.structure.photos[x], this.structure.photos[x].name);
                    });

                axios.post('/claims/create', formData).then(response => {
                    this.structure = this.newClaim();
                    $('#new-structure-modal').modal('hide');
                    this.onSuccess(response.data.message);
                }, this.onError);
            },

            removeFile(index) {
                this.structure.photos.splice(index, 1);
                this.structure.thumbs.splice(index, 1);
            },

            geoFindMe() {
                if (!navigator.geolocation){
                    this.geoLocationStatus = "Геолокацiя не пiдтримуєтся вашим браузером";
                    return;
                }

                this.geoLocationStatus = "Визначення…";

                const that = this;
                navigator.geolocation.getCurrentPosition((position) => {
                    console.log(position);
                    that.geoLocationStatus = "";
                    output.innerHTML = '';
                    that.newStructure.latitude  = position.coords.latitude;
                    that.newStructure.longitude = position.coords.longitude;
                }, () => {
                    that.geoLocationStatus = "Неможливо отримати данi";
                });
            }
        }
    }
</script>

<style>
    .require {
        color: red;
        font-weight: bolder;
    }

    #find-me {
        margin-top: 5px;
        margin-bottom: 10px;
    }
</style>