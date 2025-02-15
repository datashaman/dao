<script setup lang="ts">
import CharacterCard from '@/Components/CharacterCard.vue';
import ContestCard from '@/Components/ContestCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    characters: Array,
    contests: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto mb-4 max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold leading-tight">Characters</h3>

                        <div
                            v-for="character in characters"
                            :key="character.id"
                        >
                            <CharacterCard :character="character" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold leading-tight">Contests</h3>

                        <div v-for="contest in contests" :key="contest.id">
                            <ContestCard :contest="contest" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
