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

                            <div class="form-group">
                                <label for="author_phone">Контактний номер телефону особи яка додала об'єкт</label>
                                <input type="text" class="form-control form-control-sm" id="author_phone" v-model="structure.author_phone">
                            </div>

                            <div class="form-group">
                                <label for="author_email">Email особи яка додала об'єкт</label>
                                <input type="email" class="form-control form-control-sm" id="author_email" v-model="structure.author_email" placeholder="some@gmail.com">
                            </div>

                            <div class="form-group" v-if="structure.id > 0">
                                <label for="uuid">Реєстровий номер</label>
                                <input type="text" class="form-control form-control-sm" id="uuid" v-model="structure.uuid">
                            </div>

                            <div class="form-group">
                                <label for="address">Адреса</label>
                                <input type="text" class="form-control form-control-sm" id="address" v-model="structure.address">
                            </div>

                            <div class="form-group">
                                <label for="name">Назва</label>
                                <input type="text" class="form-control form-control-sm" id="name" v-model="structure.name">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputState">Категорія</label>
                                  <select id="inputState" class="form-control form-control-sm">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputState">Вид діяльності</label>
                                  <select id="inputState" class="form-control form-control-sm">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                  </select>
                                </div>
                            </div>

                            
                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                        </form>

                        <input id="latitude" type="text" class="form-control" v-model="structure.latitude">
                        <input id="longitude" type="text" class="form-control" v-model="structure.longitude">
                        <input id="zoom" type="text" class="form-control">

                        <google-map
                            name="structure-map"
                            :city="city"
                            :address="structure.address"
                            @markerDragged="updateMarkerPosition"
                        ></google-map>
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
        ],

        data() {
            return {
                structure:  JSON.parse(atob(this.data)),
            }
        },

        mounted() {
            console.log('Component mounted.');
        },

        methods: {
            updateMarkerPosition(position) {
                this.structure.latitude = position.lat();
                this.structure.longitude = position.lng();
            }
        }
    }
</script>
