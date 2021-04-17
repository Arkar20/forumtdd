
<script>
import replies from "../components/RepliesComponent";
export default {
    props:['replycount'],

    data(){
        return{
            replyCounts:this.replycount
        }
    },
   
    components:{replies},
}
</script>
