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
                                <label class="form-check-label" for="is_active">Проблемний об'єкт</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                        </form>

                        <input id="address" type="text" class="form-control" v-model="structure.address">
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
