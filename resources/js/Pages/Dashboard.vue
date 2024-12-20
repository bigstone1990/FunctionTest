<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <ul class="list-disc">
                            <li>
                                <Link :href="route('draggabletest.index')" class="underline text-blue-400">Draggableテスト</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.index2')" class="underline text-blue-400">Draggableテスト2</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.dropzone1')" class="underline text-blue-400">DropZoneテスト1</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.multi1')" class="underline text-blue-400">Multiテスト1</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.multi2')" class="underline text-blue-400">Multiテスト2</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.sortablejs1')" class="underline text-blue-400">Sortablejsテスト1</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.mix1')" class="underline text-blue-400">Mixテスト1</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.draggable1')" class="underline text-blue-400">Draggableテスト1</Link>
                            </li>
                            <li>
                                <Link :href="route('draggabletest.sortable1')" class="underline text-blue-400">Sortableテスト1</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
