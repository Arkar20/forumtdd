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
        <paginator :dataSet="dataSet" @changePage="getData"></paginator>
    </div>
    </div>
</template>
<script>
import reply from "./ReplyComponent"
import alert from "./alert.mjs"
import newreply from "./NewreplyComponent"
import paginator from './PaginatorComponent.vue'
export default{
    components:{reply,newreply,paginator},
    data(){
        return{
            dataSet:false,
            items : []
        }
    },
    created(){
        this.getData()
    },
    methods:{
        getData(page){
        axios.get(this.url(page)).then(
            ({data})=>{
              this.refresh(data)
                }
        )
        },
        refresh(data){
            this.dataSet=data
            this.items=data.data
        },
        url(page){
         if(!page)  {
             let query=location.search.match(/page=(\d+)/)
             page=query?location.search.match(/pa`ge=(\d+)/)[1]:1
         }   
        return location.pathname+'/replies?page='+page
        },
        added(reply){
                this.getData()
                this.$emit('added')
        },
        remove(index){
            this.items.splice(index,1)
             this.getData()
            this.$emit('removed')
            alert.fire({    
                icon: 'success',
                title: 'Reply Deleted Successful'
                })
        }
    }
}
</script>