<template>
    <div class="flex h-screen bg-gray-200 font-sans">
        <Sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow overflow-hidden">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="max-w-7xl lg:px-10">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>

        <div class="bg-teal-100 absolute top-10 right-10 border-t-4 h-12 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ $page.flash.message }}</p>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
import Sidebar from '@/Components/Sidebar'
export default {
  components: {
    Sidebar
  },
}
</script>
