<script setup>
import AjaxForm from '../../components/forms/AjaxForm.vue'
import TextField from '../../components/forms/TextField.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

function onRegister() {
    console.log("registered");
}

</script>

<template>

    <h1>Register new account</h1>

    <AjaxForm action="/api/login" @success="onRegister">
        <TextField type="email" name="email">Email:</TextField>
        <TextField type="password" name="password">Password:</TextField>
        <TextField type="password" name="confirmPassword">Confirm Password:</TextField>
    </AjaxForm>

</template>