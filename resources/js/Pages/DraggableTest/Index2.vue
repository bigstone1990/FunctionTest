<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Sortable} from '@shopify/draggable';
import { onBeforeUnmount, onMounted } from 'vue';
import SimpleList from '@/Components/SimpleList2.vue';

let sortable = null;
let containerSelector = null;
let containers = null;

onMounted(() => {
  containerSelector = '#SimpleList .List';
  containers = document.querySelectorAll(containerSelector);
  
  if (containers.length === 0) {
    return false;
  }

  sortable = new Sortable(containers, {
    draggable: '.ListItem--isDraggable',
    mirror: {
      appendTo: containerSelector,
      constrainDimensions: true,
    },
    delay: {
      mouse: 0,
      drag: 0,
      touch: 300
    },
  });
});


onBeforeUnmount(() => {
  if (sortable) {
    sortable.destroy();
  }
});

const list = {
  1: {
    id: 1,
    content: 'テスト１',
  },
  2: {
    id: 2,
    content: 'テスト２',
  },
  3: {
    id: 3,
    content: 'テスト３',
  },
  4: {
    id: 4,
    content: 'テスト４',
  },
  5: {
    id: 5,
    content: 'テスト５',
  },
  6: {
    id: 6,
    content: 'テスト６',
  },
};

</script>

<template>
    <Head title="Draggableテスト" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Draggableテスト
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                      <SimpleList id="SimpleList" :list="list" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>

</style>