<template>
    <div>
        <button type="button" class="btn btn-primary" @click="addField">
            Додати поле
        </button>
        <hr>
        <div class="form-row" v-for="(field, index) in additionalFields">
            <div class="form-group col-md-6">
                <label>Назва</label>
                <input :name="'additional_fields['+index+'][name]'" class="form-control"  v-model="field.name">
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>ID</label>
                    <input :name="'additional_fields['+index+'][id]'" type="text" class="form-control" v-model="field.id">
                    <input :name="'additional_fields['+index+'][value]'" type="hidden" class="form-control" v-model="field.value">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'fieldsJson',
        ],

        data() {
            return {
                additionalFields: JSON.parse(atob(this.fieldsJson)),
            }
        },

        methods: {
            addField() {
                this.additionalFields.push(this.newField());
            },

            newField() {
                return {
                    'name': '',
                    'id': '',
                    'value': ''
                }
            }
        }
    }
</script>