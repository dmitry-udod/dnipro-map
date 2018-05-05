<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">

                        <input type="hidden" id="structure_id" />

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">ПІБ:<span class="require">*</span></label>
                                <input class="form-control" id="name" v-model="claim.name">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="phone">Контактний телефон:<span class="require">*</span></label>
                                    <input type="text" class="form-control" id="phone" v-model="claim.phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Адреса електронної пошти:<span class="require">*</span></label>
                                <input type="email" class="form-control" id="email" v-model="claim.email" placeholder="some@mail.com">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="category">Категорія проблеми:<span class="require">*</span></label>
                                    <select id="category" class="form-control" v-model="claim.category">
                                        <option v-for="(category, index) in categories" :value="index">{{ category }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Опис проблеми:<span class="require">*</span></label>
                            <textarea rows="4" type="text" class="form-control form-control-sm" id="description" v-model="claim.description"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-group col-md-3" v-for="(thumb, index) in claim.thumbs" style="float: left">
                                <img style="padding: 5px" width="100" height="75" :src="thumb">
                                <button class="btn btn-danger btn-sm" @click="removeFile(index)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 8 8">
                                <path style="fill:white" d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z"  />
                                </svg>
                                </button>
                            </div>

                            <div class="clearfix"></div>

                            <div v-if="claim.thumbs.length < 4">
                                <label for="photos">Додати фото (не більше 4-х):
                                    <br>
                                    <span class="upload-link">завантажити</span>
                                </label>
                                <input id="photos" type="file" name="photos" @change="filesChange($event.target.files, 'photos');" style="display: none;"  accept="image/jpg, image/jpeg, image/png, image/gif">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" @click="createClaim">Надіслати данні</button>
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
            'categoriesJson'
        ],

        data() {
            return {
                claim: this.newClaim(),
                categories:  JSON.parse(atob(this.categoriesJson)),
            }
        },

        mounted() {

        },

        methods: {
            newClaim() {
                return {
                    name: "",
                    phone: "",
                    email: "",
                    category: 10,
                    description: "",
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
                    that.claim.thumbs.push(e.target.result);
                };
                that.claim.photos.push(fileList[0]);
            },

            createClaim() {
                const formData = new FormData();
                let i = 0;

                formData.append('structure_id', document.getElementById('structure_id').value);
                formData.append('name', this.claim.name);
                formData.append('name', this.claim.name);
                formData.append('phone', this.claim.phone);
                formData.append('email', this.claim.email);
                formData.append('category', this.claim.category);
                formData.append('description', this.claim.description);

                Array
                    .from(Array(this.claim.photos.length).keys())
                    .map(x => {
                        i++;
                        formData.append('photos[]', this.claim.photos[x], this.claim.photos[x].name);
                    });

                axios.post('/claims/create', formData).then(response => {
                    this.claim = this.newClaim();
                    $('#claim-modal').modal('hide');
                    this.onSuccess(response.data.message);
                }, this.onError);
            },

            removeFile(index) {
                this.claim.photos.splice(index, 1);
                this.claim.thumbs.splice(index, 1);
            },
        }
    }
</script>

<style>
    .require {
        color: red;
        font-weight: bolder;
    }
</style>