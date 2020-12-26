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
    </div>
</template>

<script>
import Sidebar from '@/Components/Sidebar'
export default {
  components: {
    Sidebar
  },
  methods: {
  }
}
</script>
