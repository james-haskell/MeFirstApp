<template>
    <div class="col-md-6">
        <div class="card">   
            <!-- User post section -->
            <div class="card-body overflow-auto">
                <form @submit.prevent="savePost">
                    <div class="form-group">
                        <img class="ml-1" style="height: 55px; width: 55px;" src="">
                        <textarea  
                            class="float-right border-0 shadow-sm bg-light form-control rounded" 
                            maxlength="150"
                            style="width: 85%; height: 55px; resize: none;"
                            v-model="body"
                            required
                            placeholder="What's going on today?">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right rounded">Post</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Friends' Posts -->
        <friends-posts></friends-posts>

    </div>
</template>

<script>
import FriendsPosts from './FriendsPosts.vue';
export default {

    components: { 
        FriendsPosts,
    },

    data() {
        return {
            body: '',
            postData: {}
        }
    },

    methods: {
        savePost() {
            axios.post('/posts/post', {
                body: this.body
            }).then(res => {
                this.postData = res.data;
                Event.$emit('added_post', this.postData);
            }).catch(e => {
                console.log(e);
            });
            this.body = '';
        }
    }
}
</script>