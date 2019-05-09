import VueRouter from 'vue-router';


let routes=[
{
    path:'/',
    name: 'home',
	component:require('./components/articles/ViewArticlesComponent').default
},
{
    path:'/articles',
    name: 'articles',
	component:require('./components/articles/ViewArticlesComponent').default
},
{
    path:'/create-article',
    name: 'createArticle',
    component:require('./components/articles/CreateArticlesComponent').default,
    meta: {
        requiresAuth: true
    }
},
{
    path:'/login',
    name: 'login',
	component:require('./components/auth/LoginComponent').default
},
{
    path:'/register',
    name: 'register',
	component:require('./components/auth/RegisterComponent.vue').default
}
];

export default new VueRouter({
	routes,
	// linkActiveClass: 'active'
});