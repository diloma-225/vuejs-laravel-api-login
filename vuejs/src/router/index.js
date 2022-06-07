import {createRouter, createWebHistory} from 'vue-router'
import loginComponent from '@/components/auth/login-component.vue'
import registerComponent from '@/components/auth/register-component.vue';
import profileComponent from '@/components/profile-component.vue'
import editComponent from '@/components/edit-component.vue'
import updateComponent from '@/components/update-password.vue'
import NotFoundComponent from '@/components/notFound-component.vue'


import axios from 'axios'

const routes=createRouter({
    history: createWebHistory(),
    routes: [
        {
            path:'/',
            component: loginComponent,
            name:'auth.login'
        },
        {
            path:'/inscription',
            component: registerComponent,
            name:'auth.register',
            props:true,
        },
        {
            path:'/profile',
            component: profileComponent,
            name:'auth.profile',
            props:true,
            meta: {requiresAuth: true},
        },
        {
            path:'/user/edit',
            component: editComponent,
            name:'user.edit',
            props:true,
            meta: {requiresAuth: true},
        },
        {
            path:'/user/update-password',
            component: updateComponent,
            name:'user.updatePassword',
            props:true,
            meta: {requiresAuth: true},
        },
        { path: '/:pathMatch(.*)*', component: NotFoundComponent }
    ]
})

routes.beforeEach( async (to, from, next)=>{
    if (to.meta.requiresAuth) {
        await axios.get('http://127.0.0.1:8000/api/authentication', {
                    headers:{
                        'Authorization':`Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(()=>{
                    next();
                })
                .catch(()=>{
                    localStorage.removeItem('token')
                    return next({name:'auth.login'})
                })
    }else{
        next();
    }
});
export default routes;