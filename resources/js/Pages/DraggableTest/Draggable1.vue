<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Draggable, Sortable } from '@shopify/draggable';
import { onMounted } from 'vue';

onMounted(() => {
  // ドラッグ可能な要素を含むコンテナを指定
  const containers = document.querySelectorAll('.container');
  
  // Draggableを初期化
  const draggable = new Draggable(containers, {
    draggable: '.item',
    mirror: {
      constrainDimensions: true, // ミラーのサイズを元要素に一致させる
      // xAxis: true, // X軸の動きを許可
      // yAxis: true, // Y軸の動きを許可
      // appendTo: 'body', // ミラー要素を`body`に追加してパフォーマンス向上
      // delay: 0, // ドラッグ開始の遅延をゼロに設定
    },
  });
  
  // // ドラッグ中の要素
  let activeItem = null;
  
  // // ドラッグ開始イベント
  draggable.on('drag:start', (event) => {
    activeItem = event.source; // ドラッグ中のアイテム
    console.log(activeItem);
  });
  
  // // ドラッグオーバーイベント
  draggable.on('drag:over', (event) => {
    const overElement = event.over;
    console.log(overElement);
  
    if (overElement  && overElement.classList.contains('item')) {
      // 別のアイテムの上にいる場合は入れ替え
      const container = overElement.parentNode;
      console.log('container:'+container);
      container.insertBefore(activeItem, overElement.nextSibling);
    }
  });
  
  // // ドラッグ停止イベント
  draggable.on('drag:stop', (event) => {
    const targetContainer = event.source.parentNode;
    console.log(targetContainer);
  
    // 他のコンテナの空きスペースにドロップされた場合
    // if (!targetContainer.contains(event.source)) {
    //   const closestContainer = document.elementFromPoint(event.sensorEvent.clientX, event.sensorEvent.clientY).closest('.container');
    //   if (closestContainer) {
    //     closestContainer.appendChild(event.source);
    //   }
    // }
  
    activeItem = null; // リセット
  });
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                      <div class="container" id="container-1">
                        <div class="item">Item 1</div>
                        <div class="item">Item 2</div>
                        <div class="item">Item 3</div>
                      </div>

                      <div class="container" id="container-2">
                        <div class="item">Item A</div>
                        <div class="item">Item B</div>
                        <div class="item">Item C</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* コンテナのスタイル */
.container {
  width: 300px;
  min-height: 200px;
  border: 2px dashed #ccc;
  border-radius: 8px;
  padding: 10px;
  margin: 20px;
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  background-color: #f9f9f9;
}

/* ドラッグ可能なアイテムのスタイル */
.item {
  width: 80px;
  height: 80px;
  background-color: #4caf50;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
  line-height: 80px;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  cursor: grab;
  user-select: none;
  /* transition: transform 0.2s, background-color 0.2s; */
}

/* ドラッグ中のアイテムスタイル */
.item:active {
  cursor: grabbing;
  transform: scale(1.1);
  background-color: #388e3c;
}

/* コンテナがドラッグを受け入れる時のスタイル */
.container.drag-over {
  border-color: #4caf50;
  background-color: #e8f5e9;
}

/* ドラッグ中のアイテムの影（ミラーリング） */
.draggable--mirror {
  opacity: 0.8;
  transform: scale(1.05);
  background-color: #81c784;
}
</style>