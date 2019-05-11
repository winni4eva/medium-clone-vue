export const AuthMixin = {
    data(){
        return {
            response: {},
            token: "",
            responseErrors: [],
        }
    },
    mounted() {
        this.getToken();
    },
    methods: {
        getToken(){
            axios.get('api/getToken', { headers: {"Authorization" : `Bearer ${localStorage.getItem('mvToken')}`} })
                .then(response => {
                    this.response = response;
                    this.token = localStorage.getItem('mvToken');
                })
                .catch(err => {
                    if(err.response.status === 401) {
                        localStorage.removeItem('mvToken');
                    }
                    this.responseErrors = err.response;
                });
        }
    }
}