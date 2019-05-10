<template>
    <div class="flex justify-end w-full max-w-md my-6 clearfix">
        <h2>Admin SignUp</h2>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input 
                    v-model="register.email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" 
                    id="username" 
                    type="text" 
                    placeholder="chloe@gmail.com">
            </div>
            
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input 
                    v-model="register.password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                    id="password" 
                    type="password" 
                    placeholder="***"
                    required>
            </div>
            
            <div class="flex items-center justify-between">
                <button @click="registerUser()" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                register: {
                    email: "",
                    password: ""
                },
                errors: [],
                success: "",
            }
        },

        methods: {
            registerUser() {
                axios.post('/api/register', this.register)
                    .then(res => this.success = res.data.message)
                    .catch(err => this.errors = err.response.data)
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
