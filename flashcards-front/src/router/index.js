import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/auth/Login.vue'
import RegisterView from '../views/auth/Register.vue'
import AuthTemplate from '../views/templates/AuthTemplate.vue'
import BaseTemplate from '../views/templates/BaseTemplate.vue'
import Dashboard from '../views/dashboard/Dashboard.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { 
            path: '',
            component: BaseTemplate, 
            children: [
                {
                    path: '',
                    name: 'home',
                    component: Dashboard
                },
                { 
                    path: '/decks/new',
                    name: 'create-deck',
                    component: () => import( '../views/decks/CreateDeck.vue' )
                },
            ]
        },
        
        {
            path: '',
            component: AuthTemplate,
            children: [
                {
                    path: '/login',
                    name: 'login',
                    component: LoginView
                },
                {
                    path: '/register',
                    name: 'register',
                    component: RegisterView
                }
            ]
        },

        
        
        
    ]
})

export default router
