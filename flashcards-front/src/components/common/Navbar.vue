<script setup>
import { useUserStore } from '../../stores/user';

const { user } = useUserStore()

</script>

<template>
    
<nav class="main-navbar border-b">
    <!-- <div class="container flex py-4">
        <div class="navbar-logo flex-grow">
            Flashcards
        </div>

        <div class="">
            {{ user.name }}
        </div>
    </div> -->
    <div class="container-nav flex py-4">
        <!-- <div class="navbar-logo flex-grow"> -->
            <button @click="createNewDeck" class="button">New Deck</button>
            <div class="">
                {{ user.name }}
            </div>
        <!-- </div> -->
    </div>
</nav>

</template>
<style>
.button{
    width: 100%;
    background-color: var( --color-primary ) !important;
    border-radius: 1000px;
    display: inline-block;
    padding: 8px 18px;
    color: white;
    user-select: none;
    font-weight: 500;
    margin-right: 25px;
}
.main-navbar{
    display: flex;
    /* position: relative; */
}
.container-nav{
    display: flex;
    align-items: center;
    margin-left: auto;
    margin-right: 100px;
}
</style>