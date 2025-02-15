<script setup lang="ts">
defineProps({
    character: Object,
});
</script>

<template>
    <div class="w-1/4">
        {{ character.name }}

        <div class="flex flex-col">
            <div class="flex flex-row justify-between gap-2">
                <div>Strength</div>
                <div>{{ character.strength }}</div>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <div>Constitution</div>
                <div>{{ character.constitution }}</div>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <div>Dexterity</div>
                <div>{{ character.dexterity }}</div>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <div>Damage</div>
                <div>{{ character.damage }}</div>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <div>Defence</div>
                <div>{{ character.defence }}</div>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <div>Health</div>
                <div>{{ character.health }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
