<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sortable from 'sortablejs/modular/sortable.complete.esm.js';
import { onMounted } from 'vue';

    // グループ名
    const groupName = "shared";

    // 同じコンテナ内ではソート（並び替え）を適用するオプション
    const sortOptions = {
      group: {
        name: groupName,
        pull: true, // 他のコンテナにアイテムを移動可能
        put: true,  // 他のコンテナからのアイテムを受け入れ可能
      },
      animation: 150,
      onEnd(evt) {
        if (evt.from === evt.to) {
          console.log(`Sorted ${evt.item.textContent} within the same container.`);
        }
      },
    };

    // 異なるコンテナ間ではスワップと空きスペースの処理を適用
    const swapAndSortOptions = {
      group: {
        name: groupName,
        pull: true,
        put: true,
      },
      animation: 150,
      swap: true, // スワップモードを有効化
      swapClass: "sortable-swap-highlight", // スワップ時のハイライトクラス
      swapThreshold: 0.65, // スワップのしきい値
      emptyInsertThreshold: 5, // 空きスペースへの挿入しきい値
      onAdd(evt) {
        console.log(`${evt.item.textContent} was added to ${evt.to.id}`);
      },
      onEnd(evt) {
        if (evt.from !== evt.to) {
          console.log(`Moved ${evt.item.textContent} to another container.`);
        }
      },
    };

onMounted(() => {
  const container1 = new Sortable(document.getElementById("container1"), {
      ...sortOptions,
      onMove(evt) {
        // 同じコンテナ内ではスワップを無効化
        if (evt.from === evt.to) {
          evt.swap = false;
        }
      },
    });

    const container2 = new Sortable(document.getElementById("container2"), {
      ...swapAndSortOptions,
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
                      <div id="container1" class="sortable-container">
                        <div>Item 1</div>
                        <div>Item 2</div>
                        <div>Item 3</div>
                      </div>

                      <div id="container2" class="sortable-container">
                        <div>Item A</div>
                        <div>Item B</div>
                        <div>Item C</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.sortable-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  min-width: 200px;
  min-height: 200px;
  background-color: #f9f9f9;
}

.sortable-container div {
  padding: 10px;
  background-color: lightgray;
  border: 1px solid #aaa;
  cursor: grab;
}

.sortable-container div.dragging {
  opacity: 0.5;
}
</style>