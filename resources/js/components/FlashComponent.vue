<template lang="">
<div v-show="show">
 <div class="flash alert alert-info d-inline-block" role="alert" >
                {{info}}
    </div>
   

</div>
</template>
<script>
import Vue from 'vue'
export default {
    props:['message'],
    data(){
        return{
            info:"",
            show:false
        }
    },
    created(){
        if(this.message){
           this.flash(this.message)
          
        }
    
    },
    
    methods: {
        flash(message){
            this.info=message
           this.show=true
            this.hide()
        },
        hide(){
            setTimeout(()=>{
                this.show=false
            },4000)
        }  
    },
}
</script>