<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Редагувати Об'ект</div>

                    <div class="card-body">
                        <form>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" v-model="structure.is_active">
                                <label class="form-check-label" for="is_active">Відображати на сайті</label>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="has_problem" v-model="structure.has_problem">
                                <label class="form-check-label" for="has_problem">Проблемний об'єкт</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_free" v-model="structure.is_free">
                                <label class="form-check-label" for="is_free">Вільна локація</label>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="address">Адреса</label>
                                <input type="text" class="form-control form-control-sm" id="address" v-model="structure.address" required autofocus>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="category_id">Категорія</label>
                                    <select id="category_id" class="form-control form-control-sm" v-model="structure.category_id">
                                        <option value="">Не обрано</option>
                                        <option v-for="(category, index) in categories" :value="index">{{ category }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type_id">Вид діяльності</label>
                                    <select id="type_id" class="form-control form-control-sm" v-model="structure.type_id">
                                        <option value="">Не обрано</option>
                                        <option v-for="type in filteredTypes" :value="type.id">{{ type.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Назва</label>
                                <input type="text" class="form-control form-control-sm" id="name" v-model="structure.name">
                            </div>

                            <div class="form-group">
                                <label for="district_id">Район</label>
                                <select id="district_id" class="form-control form-control-sm" v-model="structure.district_id">
                                    <option value="">Не обрано</option>
                                    <option v-for="el in districts" :value="el.id">{{ el.name }}</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="author_email">Email особи яка додала об'єкт</label>
                                    <input type="email" class="form-control form-control-sm" id="author_email" v-model="structure.author_email" placeholder="some@gmail.com">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="author_phone">Контактний номер телефону особи яка додала об'єкт</label>
                                        <input type="text" class="form-control form-control-sm" id="author_phone" v-model="structure.author_phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="area">Площа об'єкта</label>
                                    <input class="form-control form-control-sm" id="area" v-model="structure.area">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="business">Основна сфера торгівлі</label>
                                        <input type="text" class="form-control form-control-sm" id="business" v-model="structure.business">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="owner">Власник</label>
                                    <input class="form-control form-control-sm" id="owner" v-model="structure.owner">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="renter">Орендар</label>
                                        <input type="text" class="form-control form-control-sm" id="renter" v-model="structure.renter">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Телефон</label>
                                    <input class="form-control form-control-sm" id="phone" v-model="structure.phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="url">Посилання (URL)</label>
                                        <input type="text" class="form-control form-control-sm" id="url" v-model="structure.url" placeholder="https://helsi.me">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Нотатки</label>
                                <textarea type="text" class="form-control form-control-sm" id="notes" v-model="structure.notes"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="working_hours">Графiк роботи</label>
                                <textarea type="text" class="form-control form-control-sm" id="working_hours" v-model="structure.working_hours"></textarea>
                            </div>

                            <div class="form-group" v-if="structure.id > 0">
                                <label for="uuid">Реєстровий номер</label>
                                <input type="text" class="form-control form-control-sm" id="uuid" v-model="structure.uuid">
                            </div>

                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                        </form>

                        <div class="form-group">
                            <img style="padding: 5px" width="200" height="125" :src="'/uploads/structures/' + photo.name" v-for="photo in structure.photos">
                        </div>
                        
                        <div class="form-group">
                            <label class="btn btn-primary">
                                Додати фото <input type="file" name="photos" @change="filesChange($event.target.files, 'photos');" style="display: none;">
                            </label>
                        </div>

                        <google-map
                            name="structure-map"
                            :city="city"
                            :address="structure.address"
                            @markerDragged="updateMarkerPosition"
                        ></google-map>

                        <input id="latitude" type="hidden" class="form-control" v-model="structure.latitude">
                        <input id="longitude" type="hidden" class="form-control" v-model="structure.longitude">
                        <input id="zoom" type="hidden" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'data',
            'city',
            'categoriesJson',
            'typesJson',
            'districtsJson',
        ],

        data() {
            return {
                structure:  JSON.parse(atob(this.data)),
                categories:  JSON.parse(atob(this.categoriesJson)),
                types:  JSON.parse(atob(this.typesJson)),
                districts:  JSON.parse(atob(this.districtsJson)),
                filteredTypes: [],
            }
        },

        mounted() {
            console.log('Component mounted.');
        },

        watch: {
            'structure.category_id' (newVal, oldVal) {
                if (newVal === "") {
                    this.filteredTypes = [];
                } else {
                    this.filteredTypes = this.types.filter((el) => {
                        return el.category_id == newVal;
                    }) ;
                }
            }
        },
        methods: {
            updateMarkerPosition(position) {
                this.structure.latitude = position.lat();
                this.structure.longitude = position.lng();
            },

            filesChange(fileList, field) {
                const formData = new FormData();
                let i = 0;

                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        i++;
                        formData.append('files' + i, fileList[x], fileList[x].name);
                    });

                this.save(formData, field);
            },

            save(formData, field) {
                let that = this;
                this.upload(formData)
                    .then(x => {
                        that.structure.photos.push(x.data[0]);
                    }, this.onError);
            },

            upload(formData) {
                const url = `/admin/structures/upload`;
                return axios.post(url, formData)
                    .then(x => x.data);
            },
        }
    }
</script>
