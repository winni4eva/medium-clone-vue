<template>
    <form class="w-full max-w-xs">
        
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
            <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Full Name
            </label>
            </div>
            <div class="md:w-2/3">
            <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-full-name" type="text" value="Jane Doe">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
            <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-username">
                Password
            </label>
            </div>
            <div class="md:w-2/3">
            <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-username" type="password" placeholder="******************">
            </div>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
            <button class="shadow bg-purple hover:bg-purple-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                Sign Up
            </button>
            </div>
        </div>
        
    </form>
</template>

<script>
    export default {
        // mounted() {
        //     console.log('Component mounted.')
        // }
    }
</script>
