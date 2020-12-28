<template>
    <article @click="viewBlog" class="overflow-hidden bg-white w-64 h-64 mr-3 mb-6 rounded-lg shadow-lg">
        <a href="#">
            <img alt="Placeholder" class="block h-1/2 w-full object-cover" :src="'/images/blogs/' + blog.image">
        </a>

        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
            <h1 class="text-lg">
                <a class="no-underline hover:underline text-black text-sm font-bold" href="#">
                    {{ blog.title }}
                </a>
            </h1>
            <p class="text-grey-darker text-xs">
                {{ convertDate(blog.created_at) }}
            </p>
        </header>

        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
            <a class="flex items-center no-underline hover:underline text-black" href="#">
                <p class="ml-2 text-sm truncate">
                    Jose Paulo Dela Cruz
                </p>
            </a>
            <div class="flex">
                <button @click="isDelete = true" class="mr-1 bg-red-500 rounded-lg p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
                <inertia-link :href="route('admin.blog.update', blog)" class=" bg-blue-500 rounded-lg p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                </inertia-link>
            </div>
        </footer>

        <jet-dialog-modal :show="isDelete" @close="isDelete = false">
            <template #title>
                Delete Blog {{ blog.title }}
            </template>
            <template #content>
                Are you sure you want to delete this Blog? Once your blog is Deleted, all of it will be permanently deleted.
            </template>
            <template #footer>
                <jet-secondary-button @click.native="isDelete = false">
                    Cancel
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="blogDelete(blog)" >
                    Delete Blog
                </jet-danger-button>
            </template>
        </jet-dialog-modal>


    </article>
</template>

<script>
import moment from 'moment';
import JetDialogModal from '@/Jetstream/DialogModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
export default {
  props: [
    'blog',
  ],
  components: {
    JetDialogModal,
    JetSecondaryButton,
    JetDangerButton
  },
  data() {
    return {
      isDelete: false
    }
  },
  methods: {
    convertDate(date) {
      return moment(date).format('MMMM Do YYYY')
    },
    viewBlog() {
      console.log(this.blog)
    },
    blogDelete(b) {
      b._method = "DELETE"
      this.$inertia.post(`/admin/blog/${b.id}/delete`, b)
      this.isDelete = true
    },
  },

}

</script>
