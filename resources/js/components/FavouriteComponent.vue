<template>
                                  
                                   
                                        <button type="button"  :class="classes"
                                        
                                        aria-disabled="true"
                                        @click="toggleFavourite"
                                        >
                                        <i class="fas fa-heart"></i>
                                        {{favouriteCounts}} </button> 
</template>
<script>
import alert from './alert.mjs'
export default {
        props:['data'],
        data() {
            return {
                replyid:this.data.id,
                favouriteCounts:this.data.favourites_count,
                active:this.data.isFavourited
            }
        },
        computed:{
            classes(){
                return ['btn',this.active?'btn-outline-primary':'btn-success']
            }
        },
        methods:{
            toggleFavourite(){
                this.active?this.unfavourite():this.favourite()
                this.active=!this.active
},
            favourite(){
                axios.post('/replies/'+this.replyid+'/favourites')
                   alert.fire({
                icon: 'success',
                title: 'Favourited Successful'
                })
                this.favouriteCounts++
            },
            unfavourite(){
                 axios.delete('/replies/'+this.replyid+'/favourites')
                   alert.fire({
                icon: 'error',
                title: 'unFavourited Successful'
                })
                this.favouriteCounts--
            }
        }

}
</script>
