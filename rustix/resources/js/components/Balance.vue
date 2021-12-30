<template>
    <span class="navbar-text">
        BALANCE:<span>{{ balance }}</span>
    </span>
</template>

<script>
    export default {
        data() {
            return {
                balance: 0
            }
        },
        created() {
            this.fetchBalance();
            setInterval(() => this.fetchBalance(),2000);
        },

        methods: {
            fetchBalance(){
                axios.get(`/balance`).then(response => {
                    this.balance = response.data;
                })
            }
        }

    }
</script>
