<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Droppable} from '@shopify/draggable';
import DropZoneBlock1 from '@/Components/DropZoneBlock1.vue';
import { onMounted } from 'vue';

let containers = null;
let droppable = null;
let droppableOrigin = null;

onMounted(() => {
  containers = document.querySelectorAll('#UniqueDropzone .BlockLayout');
  if (containers.length === 0) {
    return false;
  }

  droppable = new Droppable(containers, {
    draggable: '.Block--isDraggable',
    dropzone: '.BlockWrapper--isDropzone',
    mirror: {
      constrainDimensions: true,
    },
  });

  droppable.on('drag:start', (evt) => {
    droppableOrigin = evt.originalSource.parentNode.dataset.dropzone;
  });

  droppable.on('droppable:dropped', (evt) => {
    if (droppableOrigin !== evt.dropzone.dataset.dropzone) {
      evt.cancel();
    }
  });
});
</script>

<template>
    <Head title="DropZoneテスト1" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                DropZoneテスト1
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                      <section id="UniqueDropzone" class="UniqueDropzone">
                        <article class="BlockLayout BlockLayout--typeFlex">
                          <div class="BlockWrapper BlockWrapper--isDropzone draggable-dropzone--occupied" data-dropzone="1">
                            <DropZoneBlock1 :heading="'one'" :options="{type: 'Hollow'}" />
                            <DropZoneBlock1 :heading="'one'" :options="{index: 1, draggable: true}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone draggable-dropzone--occupied" data-dropzone="2">
                            <DropZoneBlock1 :heading="'two'" :options="{type: 'Hollow'}" />
                            <DropZoneBlock1 :heading="'two'" :options="{index: 2, draggable: true}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone draggable-dropzone--occupied" data-dropzone="4">
                            <DropZoneBlock1 :heading="'four'" :options="{type: 'Hollow'}" />
                            <DropZoneBlock1 :heading="'four'" :options="{index: 4, draggable: true}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone draggable-dropzone--occupied" data-dropzone="8">
                            <DropZoneBlock1 :heading="'eight'" :options="{type: 'Hollow'}" />
                            <DropZoneBlock1 :heading="'eight'" :options="{index: 8, draggable: true}" />
                          </div>
                        </article>

                        <article class="BlockLayout BlockLayout--typeGrid">
                          <div class="BlockWrapper BlockWrapper--isDropzone" data-dropzone="1">
                            <DropZoneBlock1 :heading="''" :options="{type: 'Stripes'}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone" data-dropzone="2">
                            <DropZoneBlock1 :heading="''" :options="{type: 'Stripes'}" />
                          </div>
                          <div class="BlockWrapper">
                            <DropZoneBlock1 :heading="'three'" :options="{index: 3, type: 'Shell'}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone" data-dropzone="4">
                            <DropZoneBlock1 :heading="''" :options="{type: 'Stripes'}" />
                          </div>
                          <div class="BlockWrapper">
                            <DropZoneBlock1 :heading="'five'" :options="{index: 5, type: 'Shell'}" />
                          </div>
                          <div class="BlockWrapper">
                            <DropZoneBlock1 :heading="'six'" :options="{index: 6, type: 'Shell'}" />
                          </div>
                          <div class="BlockWrapper">
                            <DropZoneBlock1 :heading="'seven'" :options="{index: 7, type: 'Shell'}" />
                          </div>
                          <div class="BlockWrapper BlockWrapper--isDropzone" data-dropzone="8">
                            <DropZoneBlock1 :heading="''" :options="{type: 'Stripes'}" />
                          </div>
                        </article>
                      </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.BlockLayout--typeFlex {
    display: flex;
    flex-wrap: wrap;
}

.BlockLayout--typeFlex, .BlockLayout--typeFloat {
    margin-top: -.6rem;
    margin-left: -.6rem;
}

.BlockLayout--typeGrid {
    display: grid;
    gap: .6rem;
}

.UniqueDropzone .BlockLayout--typeGrid {
  grid-template-rows: repeat(6, 1fr);
  grid-template-columns: repeat(4, 1fr);
  grid-template-areas:
      "a a b b"
      "a a d d"
      "c c d d"
      "e e f f"
      "e e g g"
      "h h h h";
  margin-top: .6rem;
  border: .6rem solid #212529;
  background-color: #212529;
}

.BlockWrapper {
  position: relative;
}

.BlockLayout--typeFlex > .BlockWrapper, .BlockLayout--typeFloat > .BlockWrapper {
  margin-top: .6rem;
  margin-left: .6rem;
}

.BlockLayout--typeFlex > .Block, .BlockLayout--typeFloat > .Block {
  padding-top: .6rem;
  padding-bottom: .6rem;
}

.UniqueDropzone .BlockLayout--typeFlex .BlockWrapper {
  flex-basis: calc(25% - 0.8rem);
}

.Block {
  position: relative;
  display: block;
}

.BlockWrapper .Block {
  height: 100%;
}

.BlockLayout--typeFlex .Block {
  flex: 1 1 100%;
}

.BlockWrapper.draggable-dropzone--occupied .Block--typeHollow, .BlockWrapper.draggable-dropzone--occupied .Block--typeStripes {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
}

.BlockContent {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
  position: relative;
  min-height: 8.6rem;
  height: 100%;
  color: #fff;
  background-color: #212529;
  border: .6rem solid #212529;
}

.Block--typeHollow .BlockContent {
  color: #c3cfd8;
  background-color: #fff;
  border-color: currentColor;
}

.Heading {
  color: currentColor;
}

.Heading, .Subheading {
  letter-spacing: -.01em;
  line-height: 1.2;
}

.Heading--size2 {
  font-size: 3.2rem;
  font-weight: 700;
}

.BlockContent .Heading {
  margin-top: -.1em;
}

.text-no-select {
  pointer-events: none;
  user-select: none;
}

.Block--isDraggable {
  cursor: grab
}

.Block--isDraggable .BlockContent {
  color: #212529;
  background-color: #fff;
  border-color: currentColor;
  transition: color .12s cubic-bezier(.64,0,.35,1), background-color .12s cubic-bezier(.64,0,.35,1), transform .24s cubic-bezier(.32,1.46,.54,1.28);
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
  background-position: 0 0, .6rem .6rem;
  background-size: 1.2rem 1.2rem;
  animation: halftone .48s steps(3) infinite both paused;
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

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper--isDropzone::before {
  content: "";
  position: absolute;
  top: -.6rem;
  right: -.6rem;
  bottom: -.6rem;
  left: -.6rem;
  display: block;
  pointer-events: none;
  background-color: #0042ff;
  opacity: 0;
  transition: opacity .12s cubic-bezier(.64,0,.35,1);
}

.UniqueDropzone .BlockLayout--typeGrid .BlockContent {
  border: 0;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper--isDropzone.draggable-dropzone--occupied:hover:before {
  opacity: 1;
}

.BlockLayout--typeFloat::after {
  content: '';
  display: table;
  clear: both;
}

.BlockLayout--typeFloat .Block {
  float: left;
  width: 100%;
}

.BlockLayout--typePositioned {
  position: relative;
}

.Block--typeShell .BlockContent {
    color: #212529;
    background-color: white;
    border-color: currentColor;
}

.Block--typeStripes .BlockContent {
  background-image: repeating-linear-gradient(-45deg, white, white 40%, currentColor 0, currentColor 50%, white 0);
  background-size: .8rem .8rem;
  color: #212529;
  border-color: currentColor;
  transition: color .12s cubic-bezier(.64,0,.35,1);
}

.Block--isDraggable:focus .BlockContent,
.Block--isDraggable:hover .BlockContent {
  color: #0042ff;
}

.Block--isDraggable.draggable-source--is-dragging .BlockContent {
  color: #0042ff;
}

.Block--isDraggable.draggable-source--is-dragging .BlockContent .Pattern--typeHalftone {
  opacity: 1;
  visibility: visible;
  animation-play-state: running;
}

.Block--isDraggable.draggable-source--placed .BlockContent .Pattern--typePlaced {
  opacity: 1;
  visibility: visible;
  animation: placed .24s cubic-bezier(.64,0,.35,1) both;
}

@keyframes placed {
  100% {
    transform: scale(0);
  }
}

.Block--isDraggable.draggable-mirror {
  z-index: 7;
  transition: width .24s cubic-bezier(.32,1.46,.54,1.28), height .24s cubic-bezier(.32,1.46,.54,1.28);
}

.Block--isDraggable.draggable-mirror .BlockContent {
  height: 100%;
  color: #fff;
  background-color: #0042ff;
  border-color: #0042ff;
  transform: scale(1.025);
}

.Block--typeStripes.isColliding .BlockContent {
  color: red;
}

.UniqueDropzone .BlockLayout .BlockWrapper .Block:nth-child(n + 3):not(.draggable-source--is-dragging) {
  min-height: 0;
  height: 0;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:first-child {
  grid-area: a;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(2) {
  grid-area: b;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(3) {
  grid-area: c;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(4) {
  grid-area: d;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(5) {
  grid-area: e;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(6) {
  grid-area: f;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(7) {
  grid-area: g;
}

.UniqueDropzone .BlockLayout--typeGrid .BlockWrapper:nth-child(8) {
  grid-area: h;
}
</style>