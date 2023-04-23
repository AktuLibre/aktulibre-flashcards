<script setup>
import { computed } from 'vue';
// import { useUserSettingStore } from "../../stores/user-settings";
import Button from '../ui/Button.vue';

const logo = "/LOGO.png"

</script>
<template>
    <div class="sidebar">
        <router-link :to="{name: 'home'}">
            <div class="sidebar-logo">
                <img :src="logo">
            </div>
        </router-link>
        <div class="px-8">
            <div class="links">
                <router-link :to="{name: 'home'}">
                    <div class='sidebar-link'>Home</div>
                </router-link>
                <router-link :to="{name: 'home'}">
                    <div class='sidebar-link'>Profile</div>
                </router-link>
                <router-link :to="{name: 'home'}">
                    <div class='sidebar-link'>Forum</div>
                </router-link>
            </div>
            <!-- <h1>Nikita</h1> -->
            <!-- <Button :to="{name: 'create-deck'}">New deck</Button> -->
        </div>
    </div>
</template>

<style scoped>
.sidebar {
    background-color: var( --color-white );
    height: 100%;
}
.sidebar-logo {
    @apply p-8;
    min-height: 80px;
    text-align: center;
}
.links {
    margin-bottom: 40px;
}
.sidebar-link {
    font-weight: 500;
    font-size: 18px;
    margin: 15px 0;
}
</style>