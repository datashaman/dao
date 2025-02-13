<script setup lang="ts">
defineProps({
    contest: Object,
})
</script>

<template>
    <div class="card">
        {{ contest.name }}
    </div>
</template>

<style scoped>

</style>
