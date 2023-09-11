<script setup>

</script>

<template>
    <div class="container-chat">

        <div class="logo">ChatGPT</div>

        <div class="text">
            <input id="text-input" type="text" class="form-control">
        </div>
    </div>
</template>

<style>
    .text
    {
        width: 55%;
        z-index: 100;
        position: absolute;
        bottom: 50px;
        left: 400px;
    }

    #text-input
    {
        border: none;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.171);
        background: #40414f;
        border-radius: 10px;
        height: 60px;
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
