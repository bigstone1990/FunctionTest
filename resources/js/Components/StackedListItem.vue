<script setup>
const props = defineProps({
  heading: String,
  options: Object,
});
</script>

<template>
  <li class="StackedListItem" :class="{ 'StackedListItem--isDraggable': props.options.draggable, ['StackedListItem--item' + props.options.index]: props.options.index }" :tabindex="{ '1': props.options.draggable }">
    <div class="StackedListContent">
      <h4 class="Heading Heading--size4 text-no-select">{{ props.heading }}</h4>
      <div :class="[props.options.draggable ? 'DragHandle' : 'NopeHandle']"></div>

      <template v-if="props.options.draggable">
        <div class="Pattern Pattern--typeHalftone"></div>
        <div class="Pattern Pattern--typePlaced"></div>
      </template>
    </div>
  </li>
</template>