<template>
    <div v-if="!errors">
        Group ID: {{ groupData.id }}
        Group Name: {{ groupData.groupName }}
        Group Owner: {{ groupData.owner_id }}
        Group Members: {{ groupMembers }}

        <button @click="joinGroup()">Join Group</button>
    </div>
    <div v-else>
        No group exists with ID of {{ groupId }}
    </div>
</template>

<script>
export default {
    props: [
        'groupId',
        'userId'
    ],
    
    data() {
        return {
            errors: false,
            groupData: {},
            groupMembers: [],
        }
    },

    methods: {
        getGroupData() {
            axios.get('/api/groups/lfg?groupId=' + this.groupId
            ).then(res => {
                if (!res.data.error) {
                    this.groupData = res.data;
                    this.groupMembers = res.data.member_ids;
                } else {
                    this.errors = true;
                }
            }).catch(err => {
                console.log(err);
            })
        },

        joinGroup() {
            axios.get('/api/groups/' + this.groupData.id + '/join/' + this.userId
            ).finally(() => {
                window.location.reload();
            }).catch(err => {
                //TODO: add notification alert that user is already joined
                console.log(err);
            });
        }
    },

    mounted() {
        this.getGroupData();
    }
}
</script>