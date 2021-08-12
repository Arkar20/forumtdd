<template>
    <button @click="click" class="btn btn-pimary">Click To sweet alert</button>
</template>
<script lang="ts">
import Swal from 'sweetalert2'


export default {
    methods:{
        click(){

const Toast = Swal.mixin({
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
        }
    }   
}
</script>
