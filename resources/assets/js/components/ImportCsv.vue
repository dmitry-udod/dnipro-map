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

        <xls-csv-parser required="false" :columns="columns" @on-validate="onValidate" :help="help"></xls-csv-parser>


        <br><br>
        <div class="results" v-if="results">
            <h3>Results:</h3>
            <pre>{{ JSON.stringify(results, null, 2) }}</pre>
        </div>
    </div>
</template>

<script>
    import { XlsCsvParser } from 'vue-xls-csv-parser';
    export default {
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
                    { name: 'executor', value: 'executor', isOptional:true },
                    { name: 'period', value: 'period', isOptional:true  },
                    { name: 'Гарантія', value: 'warranty', isOptional:true  },
                    { name: 'cost', value: 'cost', isOptional:true  },
                    { name: 'Owner', value: 'owner', isOptional:true  },
                    { name: 'Owner2', value: 'owner2', isOptional:true  },
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