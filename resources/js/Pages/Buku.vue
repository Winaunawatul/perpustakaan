<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref, watch, onBeforeUnmount } from 'vue';

const props = defineProps({
    books: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({ search: '' }),
    },
});

const page = usePage();
const search = ref(props.filters.search || '');

const successMessage = computed(
    () => page.props.flash?.success || ''
);

let searchTimer = null;

watch(search, (value) => {
    if (searchTimer) {
        clearTimeout(searchTimer);
    }

    searchTimer = setTimeout(() => {
        router.get(
            '/buku',
            { search: value.trim() },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            }
        );
    }, 300);
});

onBeforeUnmount(() => {
    if (searchTimer) {
        clearTimeout(searchTimer);
    }
});

function hapusBuku(book) {
    const yakin = window.confirm(
        `Yakin ingin menghapus buku "${book.judul}"?`
    );

    if (!yakin) return;

    router.delete(`/buku/${book.id}`, {
        preserveScroll: true,
    });
}
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

                    <div
                        v-if="successMessage"
                        class="mb-4 rounded-md bg-green-100 p-3 text-green-800"
                        role="status"
                    >
                        {{ successMessage }}
                    </div>

                    <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-bold">
                            Data Buku Perpustakaan
                        </h3>

                        <Link
                            href="/buku/create"
                            class="rounded bg-blue-600 px-4 py-2 text-center text-white hover:bg-blue-700"
                        >
                            + Tambah Buku
                        </Link>
                    </div>

                    <div class="mb-5">
                        <label
                            for="search"
                            class="mb-2 block font-medium text-gray-700"
                        >
                            Cari Buku
                        </label>

                        <input
                            id="search"
                            v-model="search"
                            type="search"
                            placeholder="Cari judul, pengarang, atau kode buku..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:max-w-md"
                        />
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
                                    <th class="border p-3">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="books.length === 0">
                                    <td
                                        colspan="8"
                                        class="border p-4 text-center text-gray-500"
                                    >
                                        {{
                                            search
                                                ? 'Buku yang dicari tidak ditemukan.'
                                                : 'Belum ada data buku.'
                                        }}
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

                                    <td class="border p-3">
                                        <div class="flex flex-wrap gap-2">
                                            <Link
                                                :href="`/buku/${book.id}/edit`"
                                                class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
                                            >
                                                Edit
                                            </Link>

                                            <button
                                                type="button"
                                                @click="hapusBuku(book)"
                                                class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700"
                                            >
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>