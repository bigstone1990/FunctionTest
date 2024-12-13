<script setup>
const props = defineProps({
  item: Object,
});
</script>

<template>
  <li class="ListItem ListItem--isDraggable" :class="'ListItem--item' + props.item.id">
    <div class="ListContent">
      <h4 class="Heading Heading--size4 text-no-select">{{ props.item.content }}</h4>
      <div class="DragHandle"></div>
      <div class="Pattern Pattern--typeHalftone"></div>
      <div class="Pattern Pattern--typePlaced"></div>
    </div>
  </li>
</template>

<style>

</style>