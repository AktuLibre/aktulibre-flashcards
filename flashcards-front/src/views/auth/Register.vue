<script setup>
import AjaxForm from '../../components/forms/AjaxForm.vue'
import TextField from '../../components/forms/TextField.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

function onRegister() {
    router.push({ name: 'home' })
}

</script>

<template>

    <h1>Register new account</h1>

    <AjaxForm action="/api/register" @success="onRegister" form-type="register">
        <TextField type="email" name="email">Email:</TextField>
        <TextField type="password" name="password">Password:</TextField>
        <TextField type="password" name="confirmPassword">Confirm Password:</TextField>
    </AjaxForm>

</template>