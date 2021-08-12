<template>
    <div class="container">
        <form  method="POST" class="mx-10">
            <label class="form-group">Title</label>
            <input type="text" 
            v-model="title"
            class="form-control  text-white" style="background-color: black;">
           
            <label class="form-group">Wirte On Your Mind!</label>
            <textarea id=""
            v-model="body"
             msg="" cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
            
            <label class="form-group">Choose Channel</label>
            <select type="text" class="form-control  text-white" style="background-color: black;">
                <option>Choose One Of the Channels</option>
                
            </select>
           

                    <button class="btn btn-outline-success my-2" @click.prevent="addThread" > Submit </button>
        </form>
                </div>
</template>
<script>
import alert from "./alert.mjs";
export default {
    name:"thread-create",
    data(){
        return{
            title:'',
            body:'',
            channelid:1
        }
    },
    methods:{
        addThread(){
            
            axios.post('/threads',{body:this.body,title:this.title,channel_id:this.channelid}).then(()=>{

                alert.fire({    
                icon: 'success',
                title: 'Reply Deleted Successful'
                }) 
            })
            this.resetform()

        },
        resetform(){
             this.title='',
            this.body=''
        }
    }
}
</script>