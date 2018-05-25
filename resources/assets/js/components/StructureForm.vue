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
                                <label for="address">Адреса<span class="require">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="address" v-model="structure.address" required autofocus>
                            </div>

                            <div class="form-group">
                                <label>Перетягніть маркер, щоб помітити потрібне місце на мапі</label>
                                <div style="height: 400px;">
                                <google-map
                                        name="structure-map"
                                        :city="city.name"
                                        :address="structure.address"
                                        :structure="structure"
                                        @markerDragged="updateMarkerPosition"
                                ></google-map>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="latitude">Latitude</label>
                                    <input id="latitude" class="form-control" v-model="structure.latitude">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input id="longitude" class="form-control" v-model="structure.longitude">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="category_id">Категорія<span class="require">*</span></label>
                                    <select id="category_id" class="form-control form-control-sm" v-model="structure.category_id">
                                        <option value="">Не обрано</option>
                                        <option v-for="(category, index) in categories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type_id">Вид діяльності<span class="require">*</span></label>
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
                                        <label for="business">Основна сфера</label>
                                        <input type="text" class="form-control form-control-sm" id="business" v-model="structure.business">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="owner">Власник</label>
                                    <input class="form-control form-control-sm" id="owner" v-model="structure.owner">
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="renter">Орендар</label>
                                        <input type="text" class="form-control form-control-sm" id="renter" v-model="structure.renter">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="renter">Директор</label>
                                        <input type="text" class="form-control form-control-sm" id="director" v-model="structure.director">
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
                                <input type="text" class="form-control form-control-sm" id="uuid" v-model="structure.uuid" readonly>
                            </div>
                        </form>

                        <div class="form-row">
                            <div class="form-group col-md-3" v-for="(photo, index) in structure.photos">
                                <img style="padding: 5px" width="200" height="125" :src="'/uploads/structures/' + photo.name">
                                <button 
                                    class="btn btn-danger btn-sm"
                                    style="position: absolute;left:169px;top:5px;"
                                    @click="removeFile(index)"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 8 8">
                                            <path style="fill:white" d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z"  />
                                        </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                                    <path d="M3 0v3h-3v2h3v3h2v-3h3v-2h-3v-3h-2z" style="fill:white" />
                                </svg>
                                Додати фото <input type="file" name="photos" @change="filesChange($event.target.files, 'photos');" style="display: none;">
                            </label>
                        </div>

                        <hr>

                        <div v-if="structure.category_id">
                            <div class="form-row" v-for="(field, index) in structure.additional_fields">
                                <div class="form-group col-md-12">
                                    <label>{{ fieldTitle(field.id) }}</label>
                                    <input class="form-control form-control-sm" v-model="field.value">
                                </div>
                            </div>
                        </div>

                        <input id="zoom" type="hidden" class="form-control">

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-5">
                                <button type="submit" class="btn btn-primary" @click="saveStructure">
                                    Зберегти
                                </button>

                                <a href="/admin/structures" style="margin-left: 10px">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2'

    export default {
        props: [
            'data',
            'cityJson',
            'categoriesJson',
            'typesJson',
            'districtsJson',
        ],

        data() {
            return {
                city:  JSON.parse(atob(this.cityJson)),
                structure:  JSON.parse(atob(this.data)),
                categories:  JSON.parse(atob(this.categoriesJson)),
                types:  JSON.parse(atob(this.typesJson)),
                districts:  JSON.parse(atob(this.districtsJson)),
                filteredTypes: [],
            }
        },

        mounted() {
            console.log('Component mounted.');

            if (this.structure.id) {
                this.filterTypes(this.structure.category_id, this.city.id);
            }
        },

        computed: {
            'selectedCategory' () {
                return this.findCategoryById(this.structure.category_id);
            }
        },

        watch: {
            'structure.category_id' (newVal, oldVal) {
                if (newVal === "") {
                    this.filteredTypes = [];
                } else {
                    this.filterTypes(newVal, this.city.id);
                }
                this.structure.additional_fields = this.selectedCategory.additional_fields;
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

            removeFile(index) {
                if (confirm('Ви впевненi що бажаєте видалити файл?')) {
                    axios.post(`/admin/structures/upload-remove`, {name: this.structure.photos[index].name});
                    this.structure.photos.splice(index, 1);
                }
            },

            saveStructure() {
                if (!this.structure.address) {
                    swal('Поле Адреса обо\'язкове', '', 'error').then(() => {
                        document.getElementById('address').focus();
                    });
                    return;
                }

                if (!this.structure.category_id) {
                    swal('Поле Категорія обо\'язкове', '', 'error').then(() => {
                        document.getElementById('category_id').focus();
                    });
                    return;
                }

                if (this.structure.id) {
                    axios.put('/admin/structures/' + this.structure.id, this.structure).then(response => {
                        window.location.href = "/admin/structures/" + this.structure.id + "/edit";
                    })
                    .catch(function (error) {
                        swal('Can\'t save structure data', '', 'error')
                    });
                } else {
                    axios.post('/admin/structures', this.structure).then(response => {
                        window.location.href = "/admin/structures";
                    }, this.onError);
                }
            },

            filterTypes(categoryId, cityId) {
                this.filteredTypes = this.types.filter((el) => {
                    return el.category_id === categoryId && el.city_id === cityId;
                }) ;
            },

            findCategoryById(categoryId) {
                return this.categories.find((el) => {
                    return el.id === categoryId;
                }) ;
            },

            fieldTitle(fieldId) {
                const field = this.selectedCategory.additional_fields.find((el) => {
                    return el.id === fieldId;
                });

                if (field) {
                    return field.name;
                }
            },

            onError(err) {
                swal('Some error happen', '', 'error')
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