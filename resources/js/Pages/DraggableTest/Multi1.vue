<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import StackedListItem from '@/Components/StackedListItem.vue';
import {Sortable, Plugins} from '@shopify/draggable';
import { onMounted, onBeforeUnmount } from 'vue';

let containers = null;
let sortable = null;

const Classes = {
    draggable: 'StackedListItem--isDraggable',
    capacity: 'draggable-container-parent--capacity',
};

onMounted(() => {
    containers = document.querySelectorAll('#MultipleContainers .StackedList');
    if (containers.length === 0) {
        return false;
    }

    sortable = new Sortable(containers, {
        draggable: `.${Classes.draggable}`,
        mirror: {
            constrainDimensions: true,
        },
        plugins: [Plugins.ResizeMirror],
    });

    const containerTwoCapacity = 3;
    const containerTwoParent = sortable.containers[1].parentNode;
    let currentMediumChildren = null;
    let capacityReached = null;
    let lastOverContainer = null;

    sortable.on('drag:start', (evt) => {
        currentMediumChildren = sortable.getDraggableElementsForContainer(sortable.containers[1]).length;
        capacityReached = currentMediumChildren === containerTwoCapacity;
        lastOverContainer = evt.sourceContainer;
        containerTwoParent.classList.toggle(Classes.capacity, capacityReached);
    });

    sortable.on('sortable:sort', (evt) => {
        if (!capacityReached) {
            return;
        }

        const sourceIsCapacityContainer = evt.dragEvent.sourceContainer === sortable.containers[1];

        if (!sourceIsCapacityContainer && evt.dragEvent.overContainer === sortable.containers[1]) {
            evt.cancel();
        }
    });

    sortable.on('sortable:sorted', (evt) => {
        if (lastOverContainer === evt.dragEvent.overContainer) {
            return;
        }

        lastOverContainer = evt.dragEvent.overContainer;
    });
});

onBeforeUnmount(() => {
  if (sortable) {
    sortable.destroy();
  }
});
</script>

<template>
    <Head title="MultipleContainersテスト" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                MultipleContainersテスト
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <section id="MultipleContainers" class="MultipleContainers">
                            <article id="ContainerOne" class="StackedListWrapper StackedListWrapper--sizeLarge StackedListWrapper--axisHorizontal Container">
                                <header class="StackedListHeader">
                                    <h3 class="Heading Heading--size3 Heading--colorWhite">Container one</h3>
                                </header>

                                <ul class="StackedList">
                                    <StackedListItem :heading="'zebra'" :options="{index: 1, draggable: true}" />
                                    <StackedListItem :heading="'giraffe'" :options="{index: 2, draggable: true}" />
                                    <StackedListItem :heading="'baboon'" :options="{index: 3, draggable: false}" />
                                    <StackedListItem :heading="'elephant'" :options="{index: 4, draggable: true}" />
                                    <StackedListItem :heading="'leopard'" :options="{index: 5, draggable: true}" />
                                </ul>
                            </article>

                            <article id="ContainerTwo" class="StackedListWrapper StackedListWrapper--sizeMedium StackedListWrapper--hasScrollIndicator Container">
                                <header class="StackedListHeader">
                                    <h3 class="Heading Heading--size3 Heading--colorWhite">Container two</h3>
                                    <p><em>3 item capacity</em></p>
                                </header>

                                <ul class="StackedList StackedList--hasScroll">
                                    <StackedListItem :heading="'fluorescent grey'" :options="{index: 6, draggable: true}" />
                                    <StackedListItem :heading="'rebecca purple'" :options="{index: 7, draggable: true}" />
                                </ul>
                            </article>

                            <article id="ContainerThree" class="StackedListWrapper StackedListWrapper--hasScrollIndicator Container">
                                <header class="StackedListHeader">
                                    <h3 class="Heading Heading--size3 Heading--colorWhite">Container three</h3>
                                </header>

                                <ul class="StackedList StackedList--hasScroll">
                                    <StackedListItem :heading="'apple'" :options="{index: 8, draggable: true}" />
                                    <StackedListItem :heading="'banana'" :options="{index: 9, draggable: true}" />
                                    <StackedListItem :heading="'cucumber'" :options="{index: 10, draggable: true}" />
                                    <StackedListItem :heading="'daikon radish'" :options="{index: 11, draggable: false}" />
                                    <StackedListItem :heading="'elderberry'" :options="{index: 12, draggable: true}" />
                                    <StackedListItem :heading="'fresh thyme'" :options="{index: 13, draggable: true}" />
                                    <StackedListItem :heading="'guava'" :options="{index: 14, draggable: true}" />
                                </ul>
                            </article>
                        </section>
                    </div>
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

.MultipleContainers {
    display: grid;
    gap: 0.8rem;
    grid-template-columns: 100%;
    grid-template-areas: 'a' 'b' 'c';

    @media screen and (min-width: 1440px) {
        grid-template-columns: repeat(8, 1fr);
        grid-template-areas:
        'a a a a a a a a'
        'b b b b b c c c';
    }

    @media screen and (min-width: 1920px) {
        margin-left: auto;
        margin-right: auto;
        max-width: 75%;
    }

    .Container {
        &:nth-child(1) {
        grid-area: a;
        }

        &:nth-child(2) {
        grid-area: b;
        }

        &:nth-child(3) {
        grid-area: c;
        }
    }

    .StackedListHeader {
        @media screen and (min-width: 768px) and (max-width: 1439px) {
            height: auto;
        }
    }

    .draggable--is-dragging & .draggable-container-parent--capacity {
        color: #0042ff;
    }
}

.StackedListWrapper {
    background-image: repeating-linear-gradient(-45deg, white 0%, white 40%, CurrentColor 40%, CurrentColor 50%, white 50%);
    background-size: 0.8rem 0.8rem;
    position: relative;
    color: #212529;
    box-shadow: inset 0 0 0 0.6rem currentColor;

    @media screen and (min-width: 768px) {
        box-shadow: inset 0 0 0 0.8rem currentColor;
    }
}

.StackedListHeader,
.StackedListContent {
    height: 7.2rem;

    @media screen and (min-width: 1440px) {
        height: 8.6rem;
    }
}

.StackedListHeader {
    padding: 2.2rem;
    background-color: currentColor;
    transition: color 0.12s cubic-bezier(0.64, 0, 0.35, 1);

    @media screen and (min-width: 768px) {
        padding: 2.4rem;
    }

    p {
        margin-top: 0.2em;
        font-size: 2rem;
        color: white;

        @media screen and (min-width: 768px) {
            font-size: 2.4rem;
        }

        @media screen and (min-width: 1440px) {
            font-size: 2.8rem;
        }
    }
}

.StackedList {
    position: relative;
    margin-top: -0.6rem;

    @media screen and (min-width: 768px) {
        margin-top: -0.8rem;
    }

    &::before {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        letter-spacing: -0.01em;
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
        background-color: white;
        transition: opacity 0.24s cubic-bezier(0.64, 0, 0.35, 1), visibility 0.24s cubic-bezier(0.64, 0, 0.35, 1);
        
        @media screen and (min-width: 768px) {
            font-size: 2.4rem;
        }

        @media screen and (min-width: 1440px) {
            font-size: 2.8rem;
        }
    }

    &:empty {
        &::before {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
    }
}

.StackedListItem {
    cursor: grab;

    &:nth-child(1n + 2) {
        margin-top: -0.6rem;

        @media screen and (min-width: 768px) {
            margin-top: -0.8rem;
        }
    }

    .draggable--original:first-child + & {
        margin-top: 0;
    }
}

.StackedListContent {
    position: relative;
    display: flex;
    align-items: center;
    padding: 1.6rem;
    color: currentColor;
    background-color: #fafbfc;
    border: 0.6rem solid currentColor;
    transition: color 0.12s cubic-bezier(0.64, 0, 0.35, 1), background-color 0.12s cubic-bezier(0.64, 0, 0.35, 1), transform 0.24s cubic-bezier(0.32, 1.46, 0.54, 1.28);

    @media screen and (min-width: 768px) {
        border-width: 0.8rem;
    }

    .Heading {
        flex: 1 1 auto;
    }

    .DragHandle,
    .NopeHandle {
        flex: 0 0 2rem;
        margin-left: 2.4rem;
    }

    &::before {
        content: '';
        position: absolute;
        top: -0.6rem;
        right: -0.6rem;
        left: -0.6rem;
        display: block;
        height: 0.6rem;
        background-color: currentColor;
        opacity: 0;
        transition: color 0.12s cubic-bezier(0.64, 0, 0.35, 1), opacity 0.12s cubic-bezier(0.64, 0, 0.35, 1);

        @media screen and (min-width: 768px) {
            top: -0.8rem;
            right: -0.8rem;
            left: -0.8rem;
            height: 0.8rem;
        }
    }
}

.StackedListWrapper--sizeMedium {
    .StackedListHeader,
    .StackedListContent {
        height: 10rem;

        @media screen and (min-width: 1440px) {
            height: 16.4rem;
        }
    }
}

.StackedListWrapper--sizeLarge {
    .StackedListHeader,
    .StackedListContent {
        height: 14.4rem;

        @media screen and (min-width: 1440px) {
            height: 20.6rem;
        }
    }
}

.StackedListWrapper--hasScrollIndicator {
    &::after {
        content: '';
        position: absolute;
        display: block;
        background-color: currentColor;
        transition: color 0.12s cubic-bezier(0.64, 0, 0.35, 1), opacity 0.24s cubic-bezier(0.64, 0, 0.35, 1);
        right: 0;
        bottom: 0;
        left: 0;
        height: 0.6rem;
    }

    &:hover {
        &::after {
            opacity: 0.1;
        }
    }
}

.StackedList--hasScroll {
    height: 40.2rem;
    overflow-y: scroll;

    @media screen and (min-width: get-breakpoint(desktop)) {
        height: 55.4rem;
    }

    .StackedListWrapper--sizeMedium & {
        height: 28.8rem;

        @media screen and (min-width: 1440px) {
            height: 47.6rem;
        }
    }

    // .StackedListWrapper--sizeLarge & {
    //     @include stacked-list-scroll-height(stacked-list-item(large), 3);

    //     @media screen and (min-width: get-breakpoint(desktop)) {
    //         @include stacked-list-scroll-height(stacked-list-item(large, desktop), 3, base);
    //     }
    // }
}

.StackedListWrapper--axisHorizontal {
    display: flex;

    &::after {
        content: '';
        position: absolute;
        display: block;
        background-color: currentColor;
        transition: color 0.12s cubic-bezier(0.64, 0, 0.35, 1), opacity 0.24s cubic-bezier(0.64, 0, 0.35, 1);
        top: 0;
        right: 0;
        bottom: 0;
        width: 0.6rem;
    }

    &:hover {
        &::after {
            opacity: 0.1;
        }
    }

    .StackedListHeader,
    .StackedListContent {
        height: 7.2rem;

        @media screen and (min-width: 768px) {
            height: 8.6rem;
        }
    }

    .StackedListHeader {
        flex: 0 0 14.4rem;

        @media screen and (min-width: 768px) {
            flex-basis: 20.6rem;
        }
    }

    .StackedList {
        display: flex;
        flex: 1 1 auto;
        margin-top: 0;
        margin-left: -0.6rem;
        overflow-x: scroll;

        @media screen and (min-width: 768px) {
            margin-left: -0.8rem;
        }
    }

    .StackedListItem {
        flex: 1 0 14.4rem;
        max-width: 28.8rem;

        &:nth-child(1n + 2) {
            margin-top: 0;
            margin-left: -0.6rem;

            @media screen and (min-width: 768px) {
                margin-left: -0.8rem;
            }
        }

        @media screen and (min-width: 768px) {
            flex-basis: 20.6rem;
            max-width: 41.2rem;
        }
    }

    .draggable--original:first-child + .StackedListItem {
        margin-left: 0;
    }

    .StackedListContent {
        flex-direction: column;
        justify-content: center;
        text-align: center;

        &::before {
            top: -0.6rem;
            right: auto;
            bottom: -0.6rem;
            left: -0.6rem;
            width: 0.6rem;
            height: auto;

            @media screen and (min-width: 768px) {
                top: -0.8rem;
                bottom: -0.8rem;
                left: -0.8rem;
                width: 0.8rem;
            }
        }
    }

    .DragHandle,
    .NopeHandle {
        margin-left: 0;
    }

    &.StackedListWrapper--sizeMedium {
        .StackedListHeader,
        .StackedListContent {
            height: 10rem;

            @media screen and (min-width: 768px) {
                height: 16.4rem;
            }
        }
    }

    &.StackedListWrapper--sizeLarge {
        .StackedListHeader,
        .StackedListContent {
            height: 14.4rem;

            @media screen and (min-width: 768px) {
                height: 20.6rem;
            }
        }
    }
}

.StackedListItem--isDraggable {
    cursor: grab;

    .StackedListContent {
        background-color: white;
    }

    &:focus {
        outline: none;
    }

    &:focus,
    &:hover {
        .StackedListContent {
            color: #0042ff;
        }

        + .StackedListItem {
            .StackedListContent::before {
                background-color: #0042ff;
                opacity: 1;
            }
        }
    }

    &.draggable-source--is-dragging {
        .StackedListContent {
            color: #0042ff;

            .Pattern--typeHalftone {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                animation-play-state: running;
            }
        }

        + .StackedListItem,
        + .draggable--original + .StackedListItem {
            .StackedListContent::before {
                background-color: #0042ff;
                opacity: 1;
            }
        }
    }

    &.draggable-source--placed {
        .StackedListContent {
            .Pattern--typePlaced {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                animation: placed 0.24s cubic-bezier(0.64, 0, 0.35, 1) both;
            }
        }
    }

    &.draggable-mirror {
        z-index: 9999;
        transition: width 0.24s cubic-bezier(0.32, 1.46, 0.54, 1.28), height 0.24s cubic-bezier(0.32, 1.46, 0.54, 1.28);

        .StackedListContent {
            height: 100%;
            color: white;
            background-color: #0042ff;
            border-color: #0042ff;
            transform: scale(1.025);

            &::before,
            &::after {
                display: none;
            }
        }

        .DragHandle {
            background-color: white;

            &::before,
            &::after {
                background-color: #0042ff;
            }
        }
    }
}

.DragHandle {
    position: relative;
    width: 2rem;
    height: 2rem;
    background-color: currentColor;
    transition: background-color 0.12s cubic-bezier(0.64, 0, 0.35, 1);

    &::before,
    &::after {
        content: '';
        position: absolute;
        right: 0;
        left: 0;
        display: block;
        height: 0.4rem;
        background-color: white;
        transition: background-color 0.12s cubic-bezier(0.64, 0, 0.35, 1);
    }

    &::before {
        top: 0.4rem;
    }

    &::after {
        bottom: 0.4rem;
    }
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

.Pattern--typeStripes {
    background-image: repeating-linear-gradient(-45deg, white 0%, white 40%, CurrentColor 40%, CurrentColor 50%, white 50%);
    background-size: 0.8rem 0.8rem;
}

.Pattern--typeHalftone {
    background-image: radial-gradient(CurrentColor 24%, transparent 25%), radial-gradient(CurrentColor 24%, transparent 25%);
    background-position: 0 0, 0.6rem 0.6rem;
    background-size: 1.2rem 1.2rem;
    animation: halftone 0.48s steps(3) infinite both paused;
}

.Pattern--typePlaced {
    background-color: #0042ff;
}

@keyframes placed {
    100% {
        transform: scale(0);
    }
}

@keyframes halftone {
    0% {
        background-position: 0 0, 0.6rem 0.6rem;
    }

    100% {
        background-position: 0.6rem 0.6rem, 1.2rem 1.2rem;
    }
}

.Heading {
    letter-spacing: -0.01em;
    line-height: 1.2;
    color: currentColor;
}

.Heading--size3 {
    font-size: 2.4rem;
    font-weight: 700;

    @media screen and (min-width: 768px) {
        font-size: 2.8rem;
    }

    @media screen and (min-width: 1440px) {
        font-size: 3.2rem;
    }
}

.Heading--colorWhite {
    color: white;
}
</style>