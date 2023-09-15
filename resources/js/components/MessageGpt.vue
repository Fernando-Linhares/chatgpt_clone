<script setup>
    import { defineProps, onMounted, reactive } from 'vue';

    const props = defineProps({
        content: String
    });

    const data = reactive({
        message: '',
        cursor: {
            active: true
        }
    })

    onMounted(async () => {
        let splitedMessage = props.content.split('');

        data.cursor.active = true;

        for(let char of splitedMessage) {

            addCharCallback(()=>  data.cursor.active = !data.cursor.active, 20)

            await addCharCallback(()=> data.message += char, 45);

        }

        data.cursor.active = false;
    })

    function addCharCallback(callback, time){
        return new Promise((resolve, reject)=>{
            try
            {
                setTimeout(() => resolve(callback()), time);

            } catch (error)
            {
                reject(error);
            }
        });
    }

</script>
<template>
    {{ data.message }}
    <span v-show="data.cursor.active" class="cursor-gpt">
        |
    </span>
</template>

<style>
    .cursor-gpt
    {
        width: 7px;
        height: 20px;
        background: white;
        display: inline-block;
    }

</style>
