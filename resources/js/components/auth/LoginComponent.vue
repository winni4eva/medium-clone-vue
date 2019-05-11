<template>
    <div class="flex justify-end w-full max-w-md my-6 clearfix">
        <div v-if="this.error" class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded absolute" role="alert">
            <span class="block sm:inline">{{this.error}}</span>
        </div>
        
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">  
            <h3>SignIn</h3>       
            <div class="mb-4 my-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input 
                    v-model="login.email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" 
                    id="email" 
                    type="email" 
                    placeholder="chloe@ggmail.com">
            </div>
            
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input 
                    v-model="login.password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                    id="password" 
                    type="password" 
                    placeholder="***">
            </div>
            
            <div class="flex items-center justify-between">
                <button @click="loginUser()" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import { setTimeout } from 'timers';
    export default {
        name: "Login",
        data(){
            return {
                login: {
                    email: "",
                    password: ""
                },
                error: ""
            }
        },

        methods: {
            loginUser() {
                axios.post('/api/login', this.login)
                    .then(res => {
                        localStorage.setItem("mvToken", res.data.token);
                        this.error = "";
                        this.$router.push('/create-article');
                        window.location.reload;
                    })
                    .catch(err => {
                        this.error = err.response.data.error;
                        setTimeout(() => {
                            this.error = "";
                        }, 3000);
                    });
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
