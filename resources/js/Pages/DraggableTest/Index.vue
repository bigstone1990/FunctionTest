<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Sortable} from '@shopify/draggable';
import { onBeforeUnmount, onMounted, ref } from 'vue';
import SimpleList from '@/Components/SimpleList.vue';

const isGrabbing = ref(false);
let draggable = null;
onMounted(() => {
  draggable = new Sortable(document.querySelectorAll('ul'), {
    draggable: '.StackedListItem--isDraggable',
    // appendTo: '.container',
    // classes: {
    //   body: 'dragging-container--is-dragging'
    // },
    mirror: {
      constrainDimensions: true,
    },
    delay: {
      mouse: 0,
      drag: 0,
      touch: 300
    },
    classes: {
    // 'draggable:over': ['draggable--over', 'bg-red-200', 'bg-opacity-25'],
  },
  });
  draggable.on('sortable:sorted', () => {
    console.log('sorted!');
  })
  .on('sortable:start', () => {
    isGrabbing.value = true;
    console.log('start!');
  })
  .on('sortable:sort', () => {
    console.log('sort!');
  })
  .on('sortable:sorted', () => {
    console.log('sorted!');
  })
  .on('sortable:stop', () => {
    isGrabbing.value = false;
    console.log('stop!');
  });
});


onBeforeUnmount(() => {
  if (draggable) {
    draggable.destroy();
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
                      <ul class="flex gap-4">
                        <li class="ListItem ListItem--isDraggable">
                          <div class="list-content p-2">
                            <p>Line 1</p>
                          </div>
                        </li>
                        <li class="ListItem ListItem--isDraggable">
                          <div class="list-content p-2">
                            <p>Line 2</p>
                          </div>
                        </li>
                        <li class="ListItem ListItem--isDraggable">
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
/* .isDraggable {
  cursor: grab;
}

.isDragging {
  cursor: grabbing;
}

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
} */

.draggable--is-dragging, .draggable--is-dragging * {
  cursor: grabbing;
}
</style>