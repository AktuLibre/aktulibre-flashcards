<script setup>
import AjaxForm from '../../components/forms/AjaxForm.vue'
import TextField from '../../components/forms/TextField.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

function onLogin( data ) {
    if ( data.token ) {
        localStorage.setItem( 'api_key', data.token )
    }

    router.push({ name: 'home' })
}

</script>

<template>

    <AjaxForm action="/api/login" @success="onLogin">
        <TextField type="email" name="email">Email or username</TextField>
        <TextField type="password" name="password">Password</TextField>
        <template v-slot:form-submit class="login-button">
            <input type='submit' class="submit-button" value="Login"/>
        </template>
    </AjaxForm>

    <!-- <small>Don't have an account? <router-link :to="{ name: 'register' }">Register</router-link></small> -->

</template>