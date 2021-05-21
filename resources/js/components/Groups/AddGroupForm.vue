<template>
    <div class="container">
        Add Group
        <form :action="'/api/groups/' + this.userid + '/add'" method="POST">
            <div class="d-flex flex-column">
                <input 
                    type="text"
                    name="groupName"
                    placeholder="Enter group name...">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'userid'
    ]
}
</script>
