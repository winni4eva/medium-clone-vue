<template>
    <div class="flex mb-4 flex-wrap my-6">
        <div v-if="this.successMessage" class="bg-green-lightest border border-green-dark text-blue-dark px-4 py-3 w-full rounded relative" role="alert">
            <span class="block sm:inline">{{this.successMessage}}</span>
        </div>

        <div v-if="this.error" class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 w-full rounded relative" role="alert">
            <span class="block sm:inline">{{this.error}}</span>
        </div>

        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 bg-white h-full">
            <div class="max-w-sm rounded overflow-hidden shadow-lg w-full mt-6" v-if="this.article">
                <img class="w-full" :src="this.article['images'][0]['image_path']" alt="article image" @error="setDefaultImage">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{this.article['title']}}</div>
                    <p class="text-grey-darker text-base">
                        {{this.article['description']}}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <span v-for="(tag, index) in this.article['tags']" v-bind:key="index" class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">
                        #{{tag}}
                    </span>
                </div>
                <div v-if="this.token">
                    <button @click="updateArticle()" class="bg-white hover:bg-grey-lightest text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow my-2 ml-2">
                        Update Article
                    </button>
                    <button @click="deleteArticle()" class="bg-white hover:bg-grey-lightest text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow my-2">
                        Delete Article
                    </button>
                </div>
            </div>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="editable"></div>
    </div>
</template>

<script>
import { serverBus } from '../../app';

export default {
    name: "ViewArticle",
    data() {
        return {
            article: "",
            error: "",
            successMessage: "",
            token: "",
        }
    },
    mounted() {
        this.token = this.getToken();
        serverBus.$on('tokenChanged', (newTokenValue) => {
            this.token = newTokenValue;
        });
        this.fetchArticle(this.$route.params.articleId);
    },

    methods: {
        fetchArticle(articleId) {
            axios.get(`api/articles/${articleId}`)
                .then(response => this.article = response.data.article)
                .catch(err => {
                    this.error = err.response.data.message;
                    setTimeout(() => {
                        this.error = "";
                    }, 3000);
                });
        },
        setDefaultImage(event) {
            event.target.src = 'article_images/article_default_image.jpg';
        },
        deleteArticle() {
            const answer = confirm("Do you want to delete this article?");
            if (answer) {
                axios.delete(`api/articles/${this.article.id}`)
                .then(response => {
                    this.successMessage = response.data.success;
                    setTimeout(() => {
                        this.successMessage = "";
                        this.$router.push('/articles');
                    }, 3000);
                })
                .catch(err => {
                    this.error = err.response.data.message;
                    setTimeout(() => {this.error = ""}, 3000);
                });
            }
        },
        updateArticle() {
            const answer = confirm("Do you want to edit this article?");

            if (answer) {
                this.$router.push(`/create-article/${this.article.id}`);
            }
        }
    }
}
//
</script>
