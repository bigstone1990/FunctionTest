<script setup>
const props = defineProps({
  heading: String,
  options: Object,
});
</script>

<template>
  <span v-if="props.options.draggable" class="Block" title="Click to drag"
    :class="{ 'Block--typeShell': props.options.shell, ['Block--type' + props.options.type]: (props.options.type === 'Shell' || props.options.type === 'Hollow' || props.options.type === 'Stripes'),
      ['Block--item' + props.options.index]: props.options.index, 'Block--isDraggable': props.options.draggable
    }">
    <div class="BlockContent">
      <h3 v-if="props.heading.length > 1" class="Heading Heading--size2 text-no-select">{{ props.heading }}</h3>

      <template v-if="props.options.draggable">
        <div class="Pattern Pattern--typeHalftone"></div>
        <div class="Pattern Pattern--typePlaced"></div>
      </template>
    </div>
  </span>
  <span v-else class="Block"
    :class="{ 'Block--typeShell': props.options.shell, ['Block--type' + props.options.type]: (props.options.type === 'Shell' || props.options.type === 'Hollow' || props.options.type === 'Stripes'),
      ['Block--item' + props.options.index]: props.options.index, 'Block--isDraggable': props.options.draggable
    }">
    <div class="BlockContent">
      <h3 v-if="props.heading.length > 1" class="Heading Heading--size2 text-no-select">{{ props.heading }}</h3>

      <template v-if="props.options.draggable">
        <div class="Pattern Pattern--typeHalftone"></div>
        <div class="Pattern Pattern--typePlaced"></div>
      </template>
    </div>
  </span>
</template>