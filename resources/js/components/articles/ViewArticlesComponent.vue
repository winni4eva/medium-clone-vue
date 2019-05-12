<template>
    <div class="flex mb-4 flex-wrap my-6">
        
        <div v-if="this.error" class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 w-full rounded relative" role="alert">
            <span class="block sm:inline">{{this.error}}</span>
        </div>

        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 bg-white h-full">
            <h3>Latest Articles</h3>
            <div v-for="article in articles" v-bind:key="article.id" class="max-w-sm rounded overflow-hidden shadow-lg w-full mt-6">
                <img class="w-full" v-bind:src="article['images'][0]['image_path']" alt="article image" @error="setDefaultImage">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{article['title']}}</div>
                    <p class="text-grey-darker text-base">
                        {{article['description']}}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <span v-for="(tag, index) in article['tags']" v-bind:key="index" class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">
                        #{{tag}}
                    </span>
                </div>
            </div>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="editable"></div>
    </div>
</template>

<script>
export default {
    name: "ViewArticle",
    data() {
        return {
            articles: [],
            error: ""
        }
    },

    mounted() {
        this.fetchArticles();
    },

    methods: {
        fetchArticles() {
            axios.get('api/articles')
                .then(response => this.articles = response.data.articles.data)
                .catch(err => {
                    this.error = err.response.data.message;
                    setTimeout(() => {
                        this.error = "";
                    }, 3000);
                })
        },
        setDefaultImage(event) {
            event.target.src = 'article_images/article_default_image.jpg';
        }
    }
}
//
</script>
