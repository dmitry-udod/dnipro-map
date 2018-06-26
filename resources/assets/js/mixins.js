import swal from 'sweetalert2';

export default {
    data () {
        return {
            loading: false,
            response: { data: {}},
        }
    },

    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    },

    methods: {
        onError(err) {
            if (err.response.data && err.response.data.error) {
                this.loading = false;
                if(err.response.data.error === 'Unauthenticated.') {
                    document.location.href = '/';
                }
                swal(err.response.data.error, '', 'error').then(() => {
                    if(this.afterError) {
                        this.afterError();
                    }
                });
            } else {
                swal('Some error happened', '', 'error').then(() => {
                    if(this.afterError) {
                        this.afterError();
                    }
                });
            }
        },

        onSuccess(msg, route) {
            swal(msg, '', 'success').then(() => {
                if (route) {
                    document.location.href = route;
                }
            });
        },

    }
}