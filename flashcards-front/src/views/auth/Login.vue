<script setup>
import AjaxForm from '../../components/forms/AjaxForm.vue'
import TextField from '../../components/forms/TextField.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

function onLogin() {
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
    </AjaxForm>

    <button @click="gotoRegister">Register</button>

</template>