<script setup>
import SimpleListItem from './SimpleListItem2.vue';
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
    <article class="ListWrapper ListWrapper--hasScrollIndicator">
      <header class="ListHeader">
        <h3 class="Heading Heading--size3 Heading--colorWhite">Simple list テスト</h3>
      </header>

      <ul class="List List--hasScroll">
        <SimpleListItem v-for="item in list" :item="item" :key="item.id" />
      </ul>
    </article>
  </section>
</template>

<style>
.draggable--is-dragging, .draggable--is-dragging * {
  cursor: grabbing;
}

.SimpleList {
  margin-left: auto;
  margin-right: auto;
  max-width: 62.5%;
}

.ListWrapper {
  background-image: repeating-linear-gradient(-45deg, white 0%, white 40%, currentColor 40%, currentColor 50%, white 50%);
  background-size: 0.8rem 0.8rem;
  position: relative;
  color: #212529;
  box-shadow: inset 0 0 0 .6rem currentColor
}

.ListWrapper--hasScrollIndicator::after {
  content: "";
  position: absolute;
  display: block;
  background-color: currentColor;
  transition: color .12s cubic-bezier(.64,0,.35,1), opacity .24s cubic-bezier(.64,0,.35,1);
  right: 0;
  bottom: 0;
  left: 0;
  height: .6rem;
}

.ListWrapper--hasScrollIndicator:hover:after {
  opacity: 0.1;
}

.ListHeader,
.ListContent {
  height: 7.2rem;
}

.ListHeader {
  padding: 2.2rem;
  background-color: currentColor;
  transition: color .12s cubic-bezier(.64,0,.35,1);
}

.Heading {
  letter-spacing: -.01em;
  line-height: 1.2;
  color: currentColor;
}

.Heading--size3 {
  font-size: 2.4rem;
  font-weight: 700;
}

.Heading--colorWhite {
  color: #fff;
}

.List {
  position: relative;
  margin-top: -.6rem;
}

.List::before {
  opacity: 0;
  visibility: hidden;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  letter-spacing: -.01em;
  line-height: 1.2;
  color: currentColor;
  font-size: 2rem;
  font-weight: 700;
  pointer-events: none;
  user-select: none;
  content: "drop items here";
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  width: 80%;
  height: 80%;
  background-color: #fff;
  transition: opacity .24s cubic-bezier(.64,0,.35,1), visibility .24s cubic-bezier(.64,0,.35,1);
}

.List:empty::before {
  visibility: visible;
  opacity: 1;
}

.List--hasScroll {
  height: 50.2rem;
  overflow-y: scroll;
}

.ListItem--isDraggable {
  cursor: grab;
}

.ListItem--isDraggable .ListContent {
  background-color: white;
}

.ListItem--isDraggable:focus {
  outline: none;
}

.ListItem--isDraggable:focus .ListContent,
.ListItem--isDraggable:hover .ListContent {
  color: #007bff;
}

.ListItem--isDraggable:focus + .ListItem .Content::before,
.ListItem--isDraggable:hover + .ListItem .ListContent::before {
  background-color: #007bff;
  opacity: 1;
}

.ListItem--isDraggable.draggable-source--is-dragging .ListContent {
  color: #007bff;
}

.ListItem--isDraggable.draggable-source--is-dragging .ListContent .Pattern--typeHalftone {
  visibility: visible;
  opacity: 1;
  animation-play-state: running;
}

.ListItem--isDraggable.draggable-source--is-dragging + .ListItem .ListContent::before
.ListItem--isDraggable.draggable-source--is-dragging + .draggable--original + .ListItem .ListContent::before {
  /* background-color: #007bff; */
  opacity: 1;
}

.ListItem--isDraggable.draggable-source--placed .ListContent .Pattern--typePlaced {
  visibility: visible;
  opacity: 1;
  animation: placed .24s cubic-bezier(.64,0,.35,1) both;
} 

@keyframes placed {
  100% {
    transform: scale(0);
  }
}

.ListItem--isDraggable.draggable-mirror {
  z-index: 7;
  transition: width .24s cubic-bezier(.32,1.46,.54,1.28), height .24s cubic-bezier(.32,1.46,.54,1.28);
}

.ListItem--isDraggable.draggable-mirror .ListContent {
  height: 100%;
  color: white;
  background-color: #007bff;
  border-color: #007bff;
  transform: scale(1.025);
}

.ListItem--isDraggable.draggable-mirror .ListContent::before,
.ListItem--isDraggable.draggable-mirror .ListContent::after {
  display: none;
}


.ListItem--isDraggable.draggable-mirror .DragHandle {
  background-color: white;
}

.ListItem--isDraggable.draggable-mirror .DragHandle::before,
.ListItem--isDraggable.draggable-mirror .DragHandle::after {
  background-color: #007bff;
}

.DragHandle {
  position: relative;
  width: 2rem;
  height: 2rem;
  background-color: currentColor;
  transition: background-color .12s cubic-bezier(.64,0,.35,1);
}

.DragHandle::before,
.DragHandle::after {
    content: '';
    position: absolute;
    right: 0;
    left: 0;
    display: block;
    height: 0.4rem;
    background-color: white;
    transition: background-color .12s cubic-bezier(.64,0,.35,1);
}

.DragHandle::before {
  top: 0.4rem;
}

.DragHandle::after {
  bottom: 0.4rem;
}

.ListContent {
  position: relative;
  display: flex;
  align-items: center;
  padding: 1.6rem;
  color: currentColor;
  background-color: #fafbfc;
  border: .6rem solid currentColor;
  transition: color .12s cubic-bezier(.64,0,.35,1), background-color .12s cubic-bezier(.64,0,.35,1), transform .24s cubic-bezier(.32,1.46,.54,1.28);
}

.ListContent .Heading {
  flex: 1 1 auto;
}

.ListContent .DragHandle {
  flex: 0 0 2rem;
  margin-left: 2.4rem;
}

.ListContent::before {
  content: "";
  position: absolute;
  top: -.6rem;
  right: -.6rem;
  left: -.6rem;
  display: block;
  height: .6rem;
  background-color: currentColor;
  opacity: 0;
  transition: color .12s cubic-bezier(.64,0,.35,1), opacity .12s cubic-bezier(.64,0,.35,1);
}

.Pattern {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
}

.Pattern--typeHalftone {
  background-image: radial-gradient(currentColor 24%, transparent 25%), radial-gradient(currentColor 24%, transparent 25%);
  background-position: 0 0, calc(1.2rem / 2) (calc(1.2rem) / 2);
  background-size: 1.2rem 1.2rem;
  animation: halftone .48s steps(3) infinite both paused;
}

@keyframes halftone {
  from {
    background-position: 0 0, 0.6rem 0.6rem;
  }

  to {
    background-position: 0.6rem 0.6rem, 1.2rem 1.2rem;
  }
}

.Pattern--typePlaced {
  background-color: #0042ff;
}
</style>