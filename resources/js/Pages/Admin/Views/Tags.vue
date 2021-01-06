<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Tags
            </h2>
        </template>

        <div class="py-12">
            <jet-form-section>
                <template #title>
                    Tags
                </template>
                <template #description>
                    Create new Tags for each items
                </template>
                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Tag"/>
                        <jet-input id="title" v-model="form.type" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('type')"/>
                    </div>
                </template>

                <template #actions>
                    <button @click="submit" class="bg-gray-500 p-2 rounded-lg text-white font-bold">
                        Add
                    </button>
                </template>
            </jet-form-section>

            <table class="bg-white mt-10 rounded-lg p-6 shadow-lg table-auto w-full">
                <thead class="border">
                    <tr>
                        <th class="border text-left px-2">No.</th>
                        <th class="border text-left p-4">Tags</th>
                        <th class="border text-left p-4">Created At</th>
                        <th class="border text-left p-4">Associated</th>
                        <th class="border text-left p-4">Actions</th>
                    </tr>
                </thead>
                <tbody v-for="(tag, index) in tags" :key="tag.id">
                    <tr>
                        <td class="text-left border px-2">{{ index + 1 }}.</td>
                        <td class="text-left border font-bold p-4">{{ tag.type }}</td>
                        <td class="text-left border p-4">{{ convertDate(tag.created_at) }}</td>
                        <td class="text-left border p-4">{{ tag.related }}</td>
                        <td class="text-left border p-4">
                            <button @click="deleteTag(tag)" class="bg-red-500 text-white p-2 rounded-lg font-bold">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </admin-layout>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import moment from "moment";
export default {
  props: ['tags'],
  components: {
    AdminLayout,
    JetFormSection,
    JetInputError,
    JetInput,
    JetLabel
  },
  data() {
    return {
      form: this.$inertia.form({
        type: null,
      }, {
        bag: 'tagForm'
      })
    }
  },
  methods: {
    submit() {
        this.form.post(route('tag.add'))
    },
    convertDate(date) {
        return moment(date).format('MMMM Do YYYY')
    },
    deleteTag(tag) {
        tag._method = "DELETE"
        this.$inertia.post(`/admin/tags/${tag.id}/delete`, tag)
    }
  },
  mounted() {
      console.log(this.tags)
  }
}
</script>
