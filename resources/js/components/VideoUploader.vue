<template>
  <form @submit.prevent="uploadVideo">
    <input type="file" accept="video/*" @change="onFileChange" />
    <button type="submit">Upload Video</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      video: null,
    };
  },
  methods: {
    onFileChange(e) {
      this.video = e.target.files[0];
    },
    async uploadVideo() {
      const formData = new FormData();
      formData.append('video', this.video);

      await axios.post('/videos/upload', formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });

      alert('Video uploaded successfully!');
    },
  },
};
</script>