<template>
    <div class="flex mb-4 flex-wrap my-6">
        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 bg-grey h-full">
            <div v-for="article in articles" v-bind:key="article.id" class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                    <p class="text-grey-darker text-base">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div>
                <div class="px-6 py-4">
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                </div>
            </div>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            articles: [{test: []}]
        }
    },

    mounted() {
        this.fetchArticles();
    },

    methods: {
        fetchArticles:() => {
            axios.get('api/articles')
                .then((response) => {
                    // this.articles = response.data;
                });
        }
    }
}
</script>
