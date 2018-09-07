<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">ПІБ дитини:<span class="require">*</span></label>
                                <input class="form-control" id="name" v-model="record.name">
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="age">Вік дитини:<span class="require">*</span></label>
                                    <input class="form-control" id="age" v-model="record.age">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="parent_name">ПІБ дорослого:<span class="require">*</span></label>
                                    <input class="form-control" id="parent_name" v-model="record.parent_name">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="parent_phone">Контактний номер телефону батьків:<span class="require">*</span></label>
                                    <input class="form-control" id="parent_phone" type="tel" v-model="record.parent_phone">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="date">Бажана дата запису на атракціон:<span class="require">*</span></label>
                                    <input class="form-control" id="date" type="date" v-model="record.date">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="notes">Примітка:</label>
                                    <input class="form-control" id="notes" v-model="record.notes">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" @click="create">Надіслати данні</button>
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

        props: [],

        data() {
            return {
                record: {},
                geoLocationStatus: '',
            }
        },

        mounted() {

        },

        methods: {
            create() {
                this.record.structure_id =  document.getElementById('structure_id').value;
                axios.post('/previous-record/create', this.record).then(response => {
                    this.record = {};
                        $('#previous-record-modal').modal('hide');
                    this.onSuccess(response.data.message);
                }, this.onError);
            },
        }
    }
</script>