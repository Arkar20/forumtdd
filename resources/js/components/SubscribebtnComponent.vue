<template>
    <button :class="classes" @click="subscribe" >{{changeText}}</button>
</template>
<script>
import alert from "./alert.mjs";

export default {
    name:"subscribebutton",
    props:['active'],
    data() {
        return {
            isActive:this.active,
        }
    },
    computed:{
        classes(){
            return ['btn',this.isActive?'btn-primary':'btn-outline-primary','my-3']
        },
        changeText(){
            return this.isActive?'Unscribe':'Subscribe';
        }

    },
   
    methods:{
        subscribe(){
            axios.post(location.pathname+'/subscriptions').then(({data})=>{
                this.isActive=data.status
                this.flash(data.status)
            })
           
        },
        flash(status){
           status
           ?alert.fire({
                icon: 'success',
                title: 'Subscribed'
                })
            :alert.fire({
                icon: 'success',
                title: 'Unsubscribed'
                })
        }
        
    }
}
</script>