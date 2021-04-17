<template>
    <div>
        
        <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h1>Comments</h1>
               
               <div v-for="(reply,index) in items" :key="reply.id">
                     <reply :data="reply" @deleted="remove(index)"></reply>
             </div>
               
            </div>
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
               <newreply @added="added"></newreply>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
import reply from "./ReplyComponent"
import alert from "./alert.mjs"
import newreply from "./NewreplyComponent"
export default{
    props:['data'],
    components:{reply,newreply},
    data(){
        return{
            items : this.data
        }
    },
    methods:{
        added(reply){
            // console.log(reply)
                this.items.push(reply)
                this.$emit('added')
        },
        remove(index){
            this.items.splice(index,1)
            this.$emit('removed')
            alert.fire({    
                icon: 'success',
                title: 'Reply Deleted Successful'
                })
        }
    }
}
</script>