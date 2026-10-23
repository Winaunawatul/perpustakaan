<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    book: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    kode_buku: props.book.kode_buku ?? '',
    judul: props.book.judul ?? '',
    pengarang: props.book.pengarang ?? '',
    penerbit: props.book.penerbit ?? '',
    tahun: props.book.tahun ?? '',
    stok: props.book.stok ?? 0,
});

function simpanPerubahan() {
    form.put(`/buku/${props.book.id}`);
}
</script>

<template>
    <Head title="Edit Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Buku
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <form @submit.prevent="simpanPerubahan" class="space-y-4">

                        <div>
                            <label class="mb-1 block font-medium">Kode Buku</label>
                            <input
                                v-model="form.kode_buku"
                                type="text"
                                class="w-full rounded-md border-gray-300"
                                required
                            />
                            <p v-if="form.errors.kode_buku" class="text-sm text-red-600">
                                {{ form.errors.kode_buku }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-1 block font-medium">Judul</label>
                            <input
                                v-model="form.judul"
                                type="text"
                                class="w-full rounded-md border-gray-300"
                                required
                            />
                            <p v-if="form.errors.judul" class="text-sm text-red-600">
                                {{ form.errors.judul }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-1 block font-medium">Pengarang</label>
                            <input
                                v-model="form.pengarang"
                                type="text"
                                class="w-full rounded-md border-gray-300"
                                required
                            />
                            <p v-if="form.errors.pengarang" class="text-sm text-red-600">
                                {{ form.errors.pengarang }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-1 block font-medium">Penerbit</label>
                            <input
                                v-model="form.penerbit"
                                type="text"
                                class="w-full rounded-md border-gray-300"
                            />
                        </div>

                        <div>
                            <label class="mb-1 block font-medium">Tahun</label>
                            <input
                                v-model="form.tahun"
                                type="number"
                                min="1000"
                                max="9999"
                                class="w-full rounded-md border-gray-300"
                            />
                            <p v-if="form.errors.tahun" class="text-sm text-red-600">
                                {{ form.errors.tahun }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-1 block font-medium">Stok</label>
                            <input
                                v-model.number="form.stok"
                                type="number"
                                min="0"
                                class="w-full rounded-md border-gray-300"
                                required
                            />
                            <p v-if="form.errors.stok" class="text-sm text-red-600">
                                {{ form.errors.stok }}
                            </p>
                        </div>

                        <div class="flex gap-3 pt-3">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                            >
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
                            </button>

                            <Link
                                href="/buku"
                                class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                            >
                                Batal
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
