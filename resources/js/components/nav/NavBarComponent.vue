<template>
    <nav class="flex items-center justify-between flex-wrap bg-grey-lighter p-6 shadow-lg">
                
        <div class="flex items-center flex-no-shrink text-grey-darkest mr-6">
            <router-link to="/articles" class="no-underline text-blue">
                <span class="font-semibold text-xl tracking-tight">MediumValley</span>
            </router-link>
        </div>
        
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>

        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
            </div>
            <div>
                <router-link to="/login" v-if="!this.token">
                    <a class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white bg-grey hover:border-transparent hover:text-grey-darkest hover:bg-white mt-4 lg:mt-0">
                        Signin
                    </a>
                </router-link>
                <router-link to="/create-article" v-if="this.token">
                    <a class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white bg-grey hover:border-transparent hover:text-grey-darkest hover:bg-white mt-4 lg:mt-0">
                        Add Article
                    </a>
                </router-link>
                <a 
                    v-if="this.token" @click="logout()" 
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white bg-grey hover:border-transparent hover:text-grey-darkest hover:bg-white mt-4 lg:mt-0">
                    Logout
                </a>
                <!-- <router-link to="/register">
                    <a class="block mt-4 lg:inline-block lg:mt-0 text-grey-darkest hover:text-white mr-4">
                        Signup
                    </a>
                </router-link> -->
            </div>
        </div>
    </nav>
</template>

<script>
    import { serverBus } from '../../app';

    export default {
        name: "NavBar",
        data(){
            return {
                token: "",
                error: ""
            }
        },
        methods: {
            logout() {
                axios.get('api/logout', { headers: {"Authorization" : `Bearer ${localStorage.getItem('mvToken')}`} })
                    .then((response) => {
                        localStorage.setItem("mvToken", "");
                        serverBus.$emit('tokenChanged', "");
                        this.$router.push('/articles');
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
            this.token = this.getToken();
            serverBus.$on('tokenChanged', (newTokenValue) => {
                this.token = newTokenValue;
            });
        },
    }
</script>
