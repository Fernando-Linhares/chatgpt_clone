<script setup>
import { reactive, defineProps } from 'vue';

import ChatGptContainer from './ChatGptContainer.vue';

const data = reactive({
    chats: [],
    user: null
});

const props = defineProps({
    user: Object
});

data.user = props.user;

</script>
<template>

    <div class="btn-open-side-bar">
        <div class="close-side-bar">
            <i class="material-icons">
                crop_square
            </i>
        </div>
    </div>

    <div class="side-bar-container">
        <div class="tools-side-bar">
            <div class="add-chat">
                <i class="material-icons col-sm-2 col-md-2 col-lg-2">add</i>
                <span class="col-sm-9 col-md-9 col-lg-9">
                    New Chat
                </span>
            </div>
            <div class="close-side-bar">
                <i class="material-icons">
                    crop_square
                </i>
            </div>
        </div>
        <div class="chat-item" v-for="chat in data.chats" :key="chat.id">
            {{ chat.subscribe }}
        </div>

        <div class="footer-sidebar">
            <hr>
            <div class="chat-item">
                <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        {{ props?.user?.name }}
                    </div>
                    <div class="col-sm-2 col-lg-2 col-sm-2">
                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ChatGptContainer :user="props?.user"/>
</template>
<style>
    .footer-sidebar
    {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
    }

    .add-chat
    {
        padding-top: 0;
        margin-top: 0;
        padding: 12px;
        border: solid 1px #d2e9d638;
        border-radius: 5px;
        display: grid;
        margin-right: 4px;
        grid-template-columns: 40px 100px;
    }

    .add-chat:hover
    {
        background: #343541;
        transition: all 0.2s;
    }

    .side-bar-container
    {
        transition: all 0.3s;
        z-index: 100;
        position: absolute;
        left: 0;
        bottom: 0;
        top: 0;
        background: #202123;
        color: #D2E9D6;
        padding: 10px;
        font-size: 15px;
        width: 20%;
    }

    .side-bar-container:hover
    {
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .chat-item
    {
        border: solid 1px #202123;
        margin: 5px;
        padding: 10px;
        border-radius: 4px;
    }

    .chat-item:hover
    {
        background: #343541;
        border: solid 1px #343541;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #202123;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #202123;
    }

    .tools-side-bar
    {
        display: grid;
        grid-template-columns: 180px 45px;
    }

    .close-side-bar
    {
        border: solid 1px #343541;
        border-radius: 5px;
        padding: 9px;
    }

    .close-side-bar:hover
    {
        background: #343541;
    }

    .btn-open-side-bar
    {
        display: none;
    }
</style>
