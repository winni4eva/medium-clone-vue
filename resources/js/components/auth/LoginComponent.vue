<template>
    <div class="flex justify-end w-full my-6 clearfix">
        
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-auto my-24">  
            <h3>SignIn</h3>     
            <span class="block sm:inline text-red-dark my-2" v-if="this.error && this.error.message">
                {{this.error && this.error.message}}
            </span>
            <div class="mb-4 my-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input 
                    v-model="login.email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" 
                    id="email" 
                    type="email" 
                    placeholder="chloe@gmail.com">
                <p 
                    class="text-red-dark text-xs italic" 
                    v-if="this.error && this.error.errors && this.error.errors.email && Array.isArray(this.error.errors.email)">
                    {{this.error.errors.email[0]}}
                </p>
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
                <p 
                    class="text-red-dark text-xs italic" 
                    v-if="this.error && this.error.errors && this.error.errors.password && Array.isArray(this.error.errors.password)">
                    {{this.error.errors.password[0]}}
                </p>
            </div>
            
            <div class="flex items-center justify-between">
                <button 
                    @click="loginUser()" 
                    class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                    type="button">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import { setTimeout } from 'timers';
    import { serverBus } from '../../app';

    export default {
        name: "Login",
        data(){
            return {
                login: {
                    email: "",
                    password: ""
                },
                error: "",
            }
        },

        methods: {
            loginUser() {
                axios.post('/api/login', this.login)
                    .then(res => {
                        localStorage.setItem("mvToken", res.data.token);
                        this.error = "";
                        serverBus.$emit('tokenChanged', res.data.token);
                        this.$router.push('/create-article');
                    })
                    .catch(err => {
                        this.error = err.response.data;
                        
                        setTimeout(() => {
                            this.error = "";
                        }, 3000);
                    });
            }
        },
    }
</script>
