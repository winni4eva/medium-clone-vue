import VueRouter from 'vue-router';

let routes = [
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
        path:'/show-article/:articleId',
        name: 'showArticle',
        component:require('./components/articles/ShowArticleComponent').default
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

const router = new VueRouter({routes})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem('mvToken')) {
            next({
                path: '/articles',
                params: { nextUrl: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() 
    }
})

export default router