<script setup>

    import { reactive } from 'vue';

    const data = reactive({
        sendButton: {
            active: false
        },
        input:{
            content:''
        },
        messages: []
    });

    const handleMessageByInput = event => {
        data.sendButton.active = event.target.value.length > 0;

        if(data.sendButton.active && event.keyCode == 13)
            sendMessage(event.target.value);
    };

    const handleMessageByButton = event => {
        sendMessage(data.input.content);
    };

    const sendMessage = async content => {
        data.messages.push({
            id: 1,
            by: user,
            content: content
        })
    };

</script>

<template>
    <div class="container-chat">
        <div v-if="data.messages.length > 0">
            <div class="header-chatgpt">
                Default (GPT-3.5)
            </div>

            <div v-for="message in data.messages" :key="message.id">
                <div>
                    {{ message }}
                </div>
            </div>
        </div>
        <div v-else>
            <div class="logo">ChatGPT</div>
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
</style>
