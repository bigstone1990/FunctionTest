<script setup>
import SimpleListItem from './SimpleListItem.vue';
import { onMounted } from 'vue';

const props = defineProps({
  id: String,
  list: Object,
});

onMounted(() => {
  console.log(props.id);
});
</script>

<template>
  <section :id="props.id" :class="props.id">
    <article class="StackedListWrapper StackedListWrapper--hasScrollIndicator">
      <header class="StackedListHeader">
        <h3 class="Heading Heading--size3 Heading--colorWhite">Simple list テスト</h3>
      </header>

      <ul class="StackedList StackedList--hasScroll">
        <SimpleListItem v-for="item in list" :item="item" :key="item.id" />
      </ul>
    </article>
  </section>
</template>

<style>
.SimpleList {
  margin-left: auto;
  margin-right: auto;
  max-width: 62.5%;
}

.StackedListHeader {
  padding: 1rem;
  background: black;
}

.Heading--colorWhite {
  color: white;
}

.StackedList--hasScroll {
  height: 10rem;
  overflow-y: scroll;
  border: 1px solid black;
}
</style>