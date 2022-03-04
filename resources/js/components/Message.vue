<template>
    <div class="is-clearfix">
        <div class="message is-info is-pulled-left">
            <div class="flex-fill flex-wrap">
                <span class="message-user">
                    <div class="message-photo">
                    </div>
                    <div class="message-avatar" :style="{'background-image': 'url(' +avatar+ ')'}"></div>
                     <div class="message-level">43</div>

                    <p class="message-username">{{ user }}:</p>
                </span>

                <p class="message-text">{{ message }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'message',
            'user',
            'avatar',
        ]
    }
</script>

