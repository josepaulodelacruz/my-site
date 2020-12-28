<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Blog
            </h2>
        </template>

        <div class="grid grid-cols-1 pt-6">
            <jet-form-section enctype="multipart/form-data">
                <template #title>
                    Add Blog
                </template>
                <template #description>
                    Write any topics you want to discuss, share or explained.
                </template>
                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Blog Title"/>
                        <jet-input v-model="form.title" :value="form.title" id="title" type="text" class="mt-1 block w-full" />
                        <jet-input-error
                            :message="form.error('title')"
                        />


                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="Description" value="Blog Description" />
                        <jet-input v-model="form.description" id="description" type="text" class="mt-1 block w-full"/>
                        <jet-input-error :message="form.error('description')"/>
                    </div>

                </template>
                <template #actions>
                    <jet-action-message class="mr-3">
                        Saved.
                    </jet-action-message>

                    <button @click="submitBlog" class="bg-gray-500 p-2 rounded-lg text-white font-bold">
                        ADD
                    </button>
                </template>
            </jet-form-section>

            <div class="lg:flex">
                <div class="flex-col flex-grow">
                    <jet-input-error :message="form.error('coverPhoto')"/>
                    <h2>Add Blog Cover Photo</h2>
                    <div v-if="!uploadedImage" class="flex justify-center items-center bg-white h-56 rounded-lg shadow">
                        <button class="bg-gray-200 h-24 w-24 flex items-center justify-center  rounded-full">
                            +
                        </button>
                    </div>
                    <input type="file" accept="image/*" id="file-input" @change="uploadPic($event)" class="bg-gray-200 h-24 w-24 flex items-center justify-center  rounded-full">
                    <img v-if="uploadedImage" class="h-56 object-fill" :src="uploadedImage" alt="">

                </div>

                <div class="flex-col lg:ml-6 flex-grow">
                    <h2>Body</h2>
                    <div class="w-full bg-white rounded-lg">
                        <VueTrix v-model="form.body"/>
                    </div>
                    <jet-input-error :message="form.error('body')"/>
                </div>

            </div>

        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import VueTrix from 'vue-trix'

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    AdminLayout,
    VueTrix
  },
  data() {
    return {
      uploadedImage: null,
      photo: null,
      form: this.$inertia.form({
        'title': null,
        'description': null,
        'body': null,
        'coverPhoto': null
      }, {
        bag: 'blogForm'
      })
    }
  },
  methods: {
    submitBlog() {
      this.form.coverPhoto = this.photo
      var data = new FormData()

      data.append('title', this.form.title)
      data.append('description', this.form.description)
      data.append('coverPhoto', this.photo)
      data.append('body', this.form.body);
      data.append('bag', 'blogForm');

      this.form.post(route("admin.blog.add"), {
        preserveScroll: true,
      });
    },
    uploadPic(event) {
      // Reference to the DOM input element
      var input = event.target;
      this.photo = input.files[0]
      // Ensure that you have a file before attempting to read it
      if (input.files && input.files[0]) {
        // create a new FileReader to read this image and convert to base64 format
        var reader = new FileReader();
        // Define a callback function to run, when FileReader finishes its job
        reader.onload = (e) => {
          // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
          // Read image as base64 and set to imageData
          this.uploadedImage = e.target.result;
        }
        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(input.files[0]);

      }
    },
  },

}
</script>
