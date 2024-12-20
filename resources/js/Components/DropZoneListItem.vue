<script setup>
const props = defineProps({
  options: Object,
});
</script>

<template>
  <li class="DropZoneListItem DropZoneListItem--isDropzone">
    <span class="DropZoneBlock" :class="{ ['DropZoneBlock--block' + props.options.index]: props.options.index }">
      <div class="DropZoneBlockContent">
        <h5 class="DropZoneBlockHeading">ドロップ可能{{ props.options.index }}</h5>
  
        <div class="Pattern Pattern--typeHalftone"></div>
        <div class="Pattern Pattern--typePlaced"></div>
      </div>
    </span>
  </li>
</template>

<style lang="scss">
.DropZoneListItem {
  width: calc(calc(100% - 2rem) / 3);

  @media screen and (min-width: 1024px) {
    width: 100%;
  }
}

.DropZoneBlockContent {
  background-color: gray;
}

.DropZoneBlockHeading {
  color: currentColor;
}

</style>