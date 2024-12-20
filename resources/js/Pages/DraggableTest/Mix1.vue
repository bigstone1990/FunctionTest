<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout100VH.vue';
import { Head } from '@inertiajs/vue3';
import { Droppable, Sortable, Plugins } from '@shopify/draggable';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import MemberList from '@/Components/MemberList.vue';
import GroupList from '@/Components/GroupList.vue';

const props = defineProps({
  members: Object,
  groups: Object,
});

const dropContainers = ref(null);
const sortContainers = ref(null);
const droppable = ref(null);
const sortable = ref(null);

onMounted(() => {
  dropContainers.value = document.querySelectorAll('.DropZoneList');
  sortContainers.value = document.querySelectorAll('.MemberList');
  if (dropContainers.value.length === 0 && sortContainers.value.length === 0) {
    return false;
  }

  droppable.value = new Droppable(dropContainers.value, {
    draggable: '.Member--isDraggable',
    dropzone: '.DropZoneListItem--isDropzone',
    mirror: {
      constrainDimensions: true,
    },
    plugins: [Plugins.ResizeMirror],
  });

  sortable.value = new Sortable(sortContainers.value, {
    draggable: '.Member--isDraggable',
    mirror: {
      constrainDimensions: true,
    },
    delay: {
      mouse: 0,
      drag: 0,
      touch: 200
    },
    plugins: [Plugins.ResizeMirror, Plugins.SortAnimation],
    sortAnimation: {
      duration: 200,
      easingFunction: 'ease-in-out',
    },
  });
});

onBeforeUnmount(() => {
  if (droppable.value !== null) {
    droppable.destroy();
  }

  if (sortable.value !== null) {
    sortable.destroy();
  }
})
</script>

<template>
  <Head title="Mixテスト1" />

  <AuthenticatedLayout>
    <template #header>
      <h2
          class="text-xl font-semibold leading-tight text-gray-800"
      >
        Mixテスト1
      </h2>
    </template>

    <div class="py-4 PageContent">
      <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="PageContentLayout">
          <section id="MemberContainer" class="MemberContainer">
            <MemberList :members="props.members" :options="{index: 1}" />
          </section>
          <section id="GroupContainer" class="GroupContainer">
            <GroupList :groups="props.groups" :options="{index: 1}" />
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style lang="scss">
.draggable--is-dragging,
.draggable--is-dragging * {
  cursor: grabbing;
}

.PageContent {
  height: calc(100% - 64px - 73px);
  color: #ffffff;
}

.PageContentLayout {
  display: flex;
  flex-direction: column;
  gap: 2%;
  height: 100%;

  @media screen and (min-width: 1024px) {
    flex-direction: row;
  }
}

.MemberContainer,
.GroupContainer {
  overflow: hidden;
  background-color: #ffffff;
  box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.1);

  @media screen and (min-width: 640px) {
    border-radius: 0.5rem;
  }
}

.MemberContainer {
  flex: 1 1 28%;

}

.GroupContainer {
  flex: 1 1 70%;
}
</style>