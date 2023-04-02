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

function gotoRegister() {
    router.push({ name: 'register' })
}

</script>

<template>

    <AjaxForm action="/api/login" @success="onLogin" form-type="login">
        <TextField type="email" name="email">Email:</TextField>
        <TextField type="password" name="password">Password:</TextField>
        <template v-slot:form-submit class="login-button">
            <input type='submit' class="submit-button" value="Login"/>
        </template>
    </AjaxForm>

    <button @click="gotoRegister">Register</button>

</template>