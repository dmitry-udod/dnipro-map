<template>
    <div class="app">
        <h3>Iмпорт данных з CSV файлу</h3>
        <br>

        <div class="form-group">
            <label for="cities">Мiсто</label>
            <select id="cities" class="form-control" v-model="request.city_id">
                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categories">Категорiя</label>
            <select id="categories" class="form-control" v-model="request.category_id" @change="appendAdditionalColumns">
                <option v-for="с in filteredCategories" :value="с.id">{{ с.name }}</option>
            </select>
        </div>

        <br>

        <xls-csv-parser :columns="columns" @on-validate="onValidate" :help="help"></xls-csv-parser>

        <div class="text-center">
            <button v-if="results" @click="saveData" class="btn btn-success align-content-center">Створити об'экти</button>
        </div>

        <br><br>
        <div class="results" v-if="results">
            <h3>Results:</h3>
            <pre>{{ JSON.stringify(results, null, 2) }}</pre>
        </div>
    </div>
</template>

<script>
    import { XlsCsvParser } from 'vue-xls-csv-parser';
    import mixin from './../mixins';

    export default {
        mixins: [mixin],

        name: 'ImportStructures',

        components: {
            XlsCsvParser,
        },

        props: [
            'citiesJson',
            'categoriesJson',
        ],

        methods: {
            onValidate(results) {
                this.results = results;
                this.request.data = results;
            },

            findCategoryById(categoryId) {
                return this.categories.find((el) => {
                    return el.id === categoryId;
                }) ;
            },

            appendAdditionalColumns() {
                if (this.selectedCategory.additional_fields) {
                    let columnsFromCategory = [];
                    this.selectedCategory.additional_fields.forEach((el) => {
                        columnsFromCategory.push({name: el.name, value: "custom_" + el.id, isOptional: true});
                    });
                    this.columns = this.requiredColumns.concat(this.nonRequiredColumns.concat(columnsFromCategory));
                }
            },

            saveData() {
                axios.post('/admin/import/save-data', this.request).then(response => {
                    this.onSuccess(response.data.message);
                }, this.onError);
            }
        },

        computed: {
            'selectedCategory' () {
                return this.findCategoryById(this.request.category_id);
            }
        },

        mounted() {
            // this.request = {};
            this.cities = JSON.parse(atob(this.citiesJson));
            this.categories = JSON.parse(atob(this.categoriesJson));
            this.columns = this.requiredColumns.concat(this.nonRequiredColumns);
        },

        data() {
            return {
                categories: null,
                filteredCategories: [],
                cities: null,
                request: {
                    city_id: null,
                    category_id: null,
                },
                requiredColumns: [
                    { name: 'Адреса', value: 'address'},
                    { name: 'Координати', value: 'coordinates' }
                ],
                nonRequiredColumns: [
                    { name: 'Власник', value: 'owner', isOptional:true },
                    { name: 'Вид дiяльностi', value: 'type', isOptional:true },
                    { name: 'Графiк роботи', value: 'working_hours', isOptional:true },
                    { name: 'Директор', value: 'director', isOptional:true },
                    { name: 'Маэ договiр', value: 'has_contract', isOptional:true },
                    { name: 'Назва', value: 'name', isOptional:true },
                    { name: 'Нотатки', value: 'notes', isOptional:true },
                    { name: 'Площа', value: 'area', isOptional:true },
                    { name: 'Орендар', value: 'renter', isOptional:true },
                    { name: 'Сайт', value: 'url', isOptional:true },
                    { name: 'Телефон', value: 'phone', isOptional:true },
                    { name: 'E-mail', value: 'email', isOptional:true },
                ],
                columns: [],
                results: null,
                help: 'Обов\'язковi поля Адреса та Координати',
            };
        },

        watch: {
            'request.city_id' (newVal, oldVal) {
                if (newVal === "") {
                    this.filteredCategories = [];
                } else {
                    this.filteredCategories = this.categories.filter((el) => {
                        return el.city_id === newVal;
                    }) ;
                }
            },
        },


    };
</script>