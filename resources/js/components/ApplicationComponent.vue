<script setup>
import { onMounted, reactive } from 'vue';

import SideBar from './SideBar.vue';

const data = reactive({
    user: null
});

onMounted(async () => {
    const res = await axios.get(window.location.origin + '/session-user');

    data.user = res.data;
});

</script>
<template>
    <SideBar :user="data.user"/>
</template>
