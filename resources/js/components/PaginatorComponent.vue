<template>
    <div>
        <nav aria-label="Page navigation example" v-if="shouldDisplayPaginate">
        <ul class="pagination">
            <li class="page-item" v-show="prevurl" ><button class="page-link" href="#" @click="page--">Previous</button></li>
            <li class="page-item" v-show="nexturl"><button class="page-link" href="#" @click="page++">Next</button></li>
        </ul>
</nav>
    </div>
</template>
<script>
export default {
    props:['dataSet

        return {
            page:1,
            prevurl:false,
            nexturl:false,
        }
        
    },
    watch:{
        dataSet(){
            this.page=this.dataSet.meta.current_page
            this.prevurl=this.dataSet.links.prev
            this.nexturl=this.dataSet.links.next
        },
        page(){
            this.broadcast().updateUrl()
        }
    },
    computed:{
        shouldDisplayPaginate(){
            return !!this.prevurl || !!this.nexturl
        }
    },
    methods: {
             broadcast(){
                 this.$emit('changePage',this.page)
                return this

             } ,updateUrl(){
                 history.pushState(null,null,'?page='+this.page)
             }
        },
    
}
</script>