<script setup>

    import { reactive, defineProps } from 'vue';
    import MessageGpt from './MessageGpt.vue';

    const props = defineProps({
        user: Object
    });

    const data = reactive({
        sendButton: {
            active: false
        },
        input:{
            content:''
        },
        messages: [],
        user: null
    });

    data.user = props.user;

    const handleMessageByInput = event => {
        data.sendButton.active = event.target.value.length > 0;

        if(data.sendButton.active && event.keyCode == 13)
            sendMessage(event.target.value);
    };

    const handleMessageByButton = event => sendMessage(data.input.content);

    const sendMessage = async content => {

        data.messages.push({
            id: 1,
            by: 'user',
            content: content
        });

        console.log(data.user)

        let response = await axios.post(
            window.location.origin + '/api/messages',
            {
                content: content,
                user_id: props?.user?.id,
                assistent: false
            },
            {
                headers: {  Authorization: 'Bearer ' + props?.user?.token }
            }
        );

        data.messages.push({
            id: 1,
            by: 'gpt',
            content: response.data.content
        });

        data.input  = '';
    };

    const mouseIn = event => event.target.classList.add('card-helper-hover');

    const mouseOut = event => event.target.classList.remove('card-helper-hover');
</script>

<template>
    <div class="container-chat">
        <div v-if="data.messages.length > 0">
            <div class="header-chatgpt">
                <span>
                    Default (GPT-3.5)
                </span>
                <div class="header-chatgpt-share">
                    <i class="material-icons">
                        present_to_all
                    </i>
                </div>
            </div>
            <div class="container-chat">
                <div v-for="message in data.messages" :key="message.id">
                    <div v-if="message.by == 'user' " class="message-by-user">
                        {{ message.content }}
                    </div>
                    <div v-else class="message-by-gpt">
                        <div class="message-text-gpt">
                            <MessageGpt :content="message.content"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="logo">ChatGPT</div>
            <div class="helpers">
                <div class="card-helper" @mouseenter="mouseIn" @mouseleave="mouseOut">
                    <div class="title">Create a personal webpage for me</div>
                    <div class="content">After asking me three questions</div>
                </div>
                <div class="card-helper"   @mouseenter="mouseIn" @mouseleave="mouseOut">
                    <div class="title">Make a content strategy </div>
                    <div class="content">For a newslatter featuring free local weekend events</div>
                </div>
                <div class="card-helper"   @mouseenter="mouseIn" @mouseleave="mouseOut">
                    <div class="title">Sugest fun activities</div>
                    <div class="content">to do indoors with high-energy dog</div>
                </div>
                <div class="card-helper"   @mouseenter="mouseIn" @mouseleave="mouseOut">
                    <div class="title">Write a course overview</div>
                    <div class="content">Psychology behind decision-making</div>
                </div>
            </div>
        </div>

        <div class="text">
            <input v-model="data.input.content" placeholder="Send a Message" id="text-input" type="text" @keyup="handleMessageByInput">
            <button class="btn btn-send-enable" v-if="data.sendButton.active" @click="handleMessageByButton">
                <i class="material-icons">
                    send
                </i>
            </button>
            <button class="btn btn-send-disabled" v-else>
                <i class="material-icons">
                    send
                </i>
            </button>
        </div>
    </div>
</template>

<style>

    .btn-send-disabled
    {
        color: #565869;
        flex: 0;
        margin-right: 0;
    }

    .btn-send-enable
    {
        background: #19c37d;
        color: #ffffff;
        flex: 0;
        margin-right: 0;
    }

    .text
    {
        display: flex;
        width: 55%;
        z-index: 100;
        position: absolute;
        bottom: 50px;
        left: 400px;
        border-radius: 10px;
        background: #40414f;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.171);
        padding: 6px;
    }

    #text-input:focus{
       outline: none;
    }

    #text-input
    {
        margin-left: 10px;
        background: #40414f;
        flex: 11;
        border: none;
        height: 40px;
        color: white;
        font-size: 15px;
    }

    .container-chat
    {
        position: absolute;
        right: 0;
        left: 10px;
        margin: 0;
        bottom: 0;
        top: 0;
        background: #343541;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .logo
    {
        position: absolute;
        left: 700px;
        top: 90px;
        font-weight: bold;
        font-size: 35px;
        color: #565869;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .header-chatgpt
    {
        color: white;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 10%;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.315);
        z-index: 40;
        background: #343541;
    }

    .header-chatgpt > span
    {
        position: absolute;
        left: 700px;
        top: 27px;
    }

    .header-chatgpt-share
    {
        position: absolute;
        top: 27px;
        right: 30px;
        color:#565869;
    }

    .helpers
    {
        color: #ffffff;
        position: absolute;
        z-index: 40;
        left: 400px;
        bottom: 125px;
        width: 800px;
        display: grid;
        grid-template-columns: 370px 370px;
    }

    .card-helper
    {
        margin: 20px;
        border: solid 1px #565869;
        margin: 5px;
        padding: 5px;
        border-radius: 10px;
        width: 360px;
        height: 70px;
    }

    .card-helper-hover
    {
        background: #797a873b;
    }

    .card-helper > .title
    {
        color: #b2c5d2;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .card-helper > .content
    {
        font-size: 8;
        color: #797a87;
        width: 100%;
    }

    .message-by-gpt
    {
        position: relative;
        z-index: 30;
        top: 100px;
        left: 0;
        right: 0;
        padding: 20px;
        background: #444654;
    }

    .message-text-gpt
    {
        z-index: 30;
        position: relative;
        left: 380px;
        color: wheat;
    }

    .message-by-user
    {
        position: relative;
        z-index: 30;
        top: 100px;
        left: 380px;
        color: wheat;
        padding: 20px;
    }

</style>
