<template>
    <div class="chat">
        <div class="d-flex flex-fill chat-wrapper">
            <div v-for="message in messages">

                <message
                    :message="message.text"
                    :user="message.user"
                ></message>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data () {
            return {
                scroll:true,
                messages: [],
                newMessage: ''
            }
        },
        mounted () {
            this.fetchMessages();
            Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    if(e.user != this.user) {
                        this.messages.push({
                            text: e.message,
                            user: e.user
                        });

                    }
                    if(document.getElementsByClassName("chat-wrapper")[0].scrollTop +document.getElementsByClassName("chat-wrapper")[0].clientHeight== document.getElementsByClassName("chat-wrapper")[0].scrollHeight){
                        this.scroll=true;
                    }
                });
        },
        updated: function () {
        this.$nextTick(function () {
            if(this.scroll==true){
                this.scroll=false;
                document.getElementsByClassName("chat-wrapper")[0].scrollTop = document.getElementsByClassName("chat-wrapper")[0].scrollHeight;
            }

        })
        },
        methods: {
            fetchMessages() {
                axios.get(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/messages`).then(response => {
                    this.messages = response.data;
                })
            },
        }
    }
</script>
