
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head} from '@inertiajs/vue3';

defineProps({
    books: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Data Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Data Buku
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-lg bg-white p-6 shadow-sm">

                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="text-lg font-bold">
                            Data Buku Perpustakaan
                        </h3>
<button
    type="button"
    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
>
    + Tambah Buku
</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-3">No.</th>
                                    <th class="border p-3">Kode Buku</th>
                                    <th class="border p-3">Judul</th>
                                    <th class="border p-3">Pengarang</th>
                                    <th class="border p-3">Penerbit</th>
                                    <th class="border p-3">Tahun</th>
                                    <th class="border p-3">Stok</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="books.length === 0">
                                    <td
                                        colspan="7"
                                        class="border p-4 text-center text-gray-500"
                                    >
                                        Belum ada data buku.
                                    </td>
                                </tr>

                                <tr
                                    v-for="(book, index) in books"
                                    :key="book.id"
                                >
                                    <td class="border p-3">{{ index + 1 }}</td>
                                    <td class="border p-3">{{ book.kode_buku }}</td>
                                    <td class="border p-3">{{ book.judul }}</td>
                                    <td class="border p-3">{{ book.pengarang }}</td>
                                    <td class="border p-3">{{ book.penerbit || '-' }}</td>
                                    <td class="border p-3">{{ book.tahun || '-' }}</td>
                                    <td class="border p-3">{{ book.stok }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
