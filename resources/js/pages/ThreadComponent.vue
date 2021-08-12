
<script>
import replies from "../components/RepliesComponent"
import subscribebutton from '../components/SubscribebtnComponent'
export default {
    props:['replycount'],
    components:{subscribebutton,replies},
    data(){
        return{
            replyCounts:this.replycount
        }
    },
   
}
</script>
