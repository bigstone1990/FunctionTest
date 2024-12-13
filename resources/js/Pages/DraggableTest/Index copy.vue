<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Sortable} from '@shopify/draggable';
import { onBeforeUnmount, onMounted, ref } from 'vue';

const isGrabbing = ref(false);

onMounted(() => {
  const draggable = new Sortable(document.querySelectorAll('ul'), {
    // draggable: 'li',
    // appendTo: '.container',
    // classes: {
    //   body: 'dragging-container--is-dragging'
    // },
    delay: {
      mouse: 0,
      drag: 0,
      touch: 300
    },
    classes: {
    'draggable:over': ['draggable--over', 'bg-red-200', 'bg-opacity-25'],
  },
  });
  // draggable.on('sortable:sorted', () => {
  //   console.log('sorted!');
  // })
  // .on('sortable:start', () => {
  //   isGrabbing.value = true;
  //   console.log('start!');
  // })
  // .on('sortable:sort', () => {
  //   console.log('sort!');
  // })
  // .on('sortable:sorted', () => {
  //   console.log('sorted!');
  // })
  // .on('sortable:stop', () => {
  //   isGrabbing.value = false;
  //   console.log('stop!');
  // });
});


onBeforeUnmount(() => {
  if (draggable) {
    draggable.destroy();
  }
});

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
                      <ul class="flex gap-4">
                        <li class="draggable-source">
                          <div class="list-content p-2">
                            <p>Line 1</p>
                          </div>
                        </li>
                        <li class="draggable-source">
                          <div class="list-content p-2">
                            <p>Line 2</p>
                          </div>
                        </li>
                        <li class="draggable-source">
                          <div class="list-content p-2">
                            <p>Line 3</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.draggable-source {
  cursor: grab;
}

.list-content {
  border: 1px solid black;
}

.draggable-source .list-content {
  color: black;
  background-color: yellow;
  border: 5px solid black;
}

.draggable-source .list-content:hover {
  color: blue;
  border-color: blue;
}

.draggable-source.draggable-mirror .list-content {
  color: white;
  background-color: blue;
  border-color: blue;
}

.draggable--is-dragging, .draggable--is-dragging * {
  cursor: grabbing;
}


</style>