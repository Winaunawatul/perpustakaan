<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

function submit() {
    form.post(route('buku.store'));
}
</script>

<template>
    <Head title="Tambah Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Buku
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label class="block font-medium">Kode Buku</label>
                            <input
                                v-model="form.kode_buku"
                                type="text"
                                class="mt-1 w-full rounded border-gray-300"
                                required
                            />
                            <p v-if="form.errors.kode_buku" class="text-red-600">
                                {{ form.errors.kode_buku }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium">Judul</label>
                            <input
                                v-model="form.judul"
                                type="text"
                                class="mt-1 w-full rounded border-gray-300"
                                required
                            />
                            <p v-if="form.errors.judul" class="text-red-600">
                                {{ form.errors.judul }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium">Pengarang</label>
                            <input
                                v-model="form.pengarang"
                                type="text"
                                class="mt-1 w-full rounded border-gray-300"
                                required
                            />
                            <p v-if="form.errors.pengarang" class="text-red-600">
                                {{ form.errors.pengarang }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium">Penerbit</label>
                            <input
                                v-model="form.penerbit"
                                type="text"
                                class="mt-1 w-full rounded border-gray-300"
                            />
                        </div>

                        <div>
                            <label class="block font-medium">Tahun</label>
                            <input
                                v-model="form.tahun"
                                type="number"
                                min="1000"
                                max="9999"
                                class="mt-1 w-full rounded border-gray-300"
                            />
                            <p v-if="form.errors.tahun" class="text-red-600">
                                {{ form.errors.tahun }}
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium">Stok</label>
                            <input
                                v-model="form.stok"
                                type="number"
                                min="0"
                                class="mt-1 w-full rounded border-gray-300"
                                required
                            />
                            <p v-if="form.errors.stok" class="text-red-600">
                                {{ form.errors.stok }}
                            </p>
                        </div>

                        <div class="flex gap-3 pt-3">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                            >
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Buku' }}
                            </button>

                            <Link
                                :href="route('buku')"
                                class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300"
                            >
                                Kembali
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
