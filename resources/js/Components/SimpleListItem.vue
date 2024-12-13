<script setup>
const props = defineProps({
  item: Object,
});
</script>

<template>
  <li class="StackedListItem StackedListItem--isDraggable" :class="'StackedListItem--item' + props.item.id">
    <div class="StackedListContent">
      <h4 class="Heading Heading--size4 text-no-select">{{ props.item.content }}</h4>
      <div class="DragHandle"></div>
      <div class="Pattern Pattern--typeHalftone"></div>
      <div class="Pattern Pattern--typePlaced"></div>
    </div>
  </li>
</template>

<style>
.StackedListItem--isDraggable:hover .StackedListContent {
    color: #0042ff;
}

.Pattern {
    /* opacity: 0; */
    visibility: hidden;
    /* pointer-events: none; */
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    /* margin: auto; */
}

.Pattern--typeHalftone {
    background-image: radial-gradient(#007bff 24%, transparent 25%), radial-gradient(#007bff 24%, transparent 25%);
    background-position: 0 0, .6rem .6rem;
    background-size: 1.2rem 1.2rem;
    animation: halftone .48s steps(3) infinite both;
}

.StackedListItem--isDraggable.draggable-source--is-dragging .StackedListContent .Pattern--typeHalftone {
    /* opacity: 1; */
    visibility: visible;
    /* pointer-events: auto; */
    /* animation-play-state: running; */
}


@keyframes halftone {
  0% {
    background-position: 0 0, .6rem .6rem;
  }

  100% {
    background-position: .6rem .6rem, 1.2rem 1.2rem;
  }
}

.Pattern--typePlaced {
    background-color: #0042ff;
}

.StackedListItem--isDraggable.draggable-source--placed .StackedListContent .Pattern--typePlaced {
    /* opacity: 1; */
    visibility: visible;
    /* pointer-events: auto; */
    animation: placed .24s cubic-bezier(.64,0,.35,1) both;
}

@keyframes placed {
  100% {
      transform: scale(0);
  }
}

.StackedListItem--isDraggable {
  cursor: grab;
}

.draggable--is-dragging, .draggable--is-dragging * {
  cursor: grabbing;
}


.StackedListContent {
  position: relative;
  display: flex;
  align-items: center;
  padding: .4rem;
  border: 4px solid currentColor;
}

.StackedListItem--isDraggable.draggable-source--is-dragging .StackedListContent {
    color: #0042ff;
}

.DragHandle {
  position: relative;
  width: 1rem;
  height: 1rem;
  background-color: black;
}

.DragHandle::before,
.DragHandle::after {
  content: "";
  position: absolute;
  right: 0;
  left: 0;
  display: block;
  height: .2rem;
  background-color: white;
}

.DragHandle::before {
  top: .2rem;
}

.DragHandle::after {
  bottom: .2rem;
}

.StackedListItem--isDraggable.draggable-mirror .DragHandle {
  background-color: white;
}

.StackedListItem--isDraggable.draggable-mirror .DragHandle::before,
.StackedListItem--isDraggable.draggable-mirror .DragHandle::after {
  background-color: #007bff;
}

.StackedListItem--isDraggable.draggable-mirror .StackedListContent {
  height: 100%;
  color: white;
  background-color: #007bff; /* 仮: brand blue の色 */
  border-color: #007bff; /* 仮: brand blue の色 */
  /* transform: scale(1.025); */
}

.StackedListContent .Heading {
  flex: 1 1 auto;
}

.StackedListContent .DragHandle {
  flex: 0 0 1rem;
  margin-left: 2.4rem;
}
</style>