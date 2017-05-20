<template>
    <div class="container-fluid">
        <div class="clockcase">
            <span class="zero digit"></span>
            <span :class="minutes"></span>
            <span class="colon"></span>
            <span :class="tenSeconds"></span>
            <span :class="seconds"></span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                remainingTime: 0
            };
        },
        created() {
            let timer = setInterval(() => {
                if (this.remainingTime === 0) {
                    clearInterval(timer);
                    return;
                }
                this.remainingTime -= 1;
                this.$forceUpdate();
            }, 1000);
            axios.get('/timer')
                .then(response => this.remainingTime = response.data.seconds);
        },
        computed: {
            tenMinutes() {
                let minutes = this.remainingTime / 60;
                let classes = {
                    digit: true,
                };
                classes[this.numberToString(minutes / 10)] = true;
                return classes;
            },
            minutes() {
                let minutes = this.remainingTime / 60;
                let classes = {
                    digit: true,
                };
                classes[this.numberToString(minutes % 10)] = true;
                return classes;
            },
            tenSeconds() {
                let seconds = this.remainingTime % 60;
                let classes = {
                    digit: true,
                };
                classes[this.numberToString(seconds / 10)] = true;
                return classes;
            },
            seconds() {
                let seconds = this.remainingTime % 60;
                let classes = {
                    digit: true,
                };
                classes[this.numberToString(seconds % 10)] = true;
                return classes;
            }

        },
        methods: {
            numberToString(num) {
                num = Math.floor(num);
                switch(num) {
                    case 0: return 'zero';
                    case 1: return 'one';
                    case 2: return 'two';
                    case 3: return 'three';
                    case 4: return 'four';
                    case 5: return 'five';
                    case 6: return 'six';
                    case 7: return 'seven';
                    case 8: return 'eight';
                    case 9: return 'nine';
                }
                return undefined;
            }
        }
    };
</script>

<style lang="css">

    :root{
        --back-color:#333;
        --main-color:lightblue;
    }

    .clockcase {
        background-color: black;
        margin: 100px auto;
        text-align: center;
    }

    .digit, .colon {
        position: relative;
        display: inline-block;
        width: 10px;
        height: 110px;
        margin: 5px;
    }

    .colon {
        background: linear-gradient(-90deg, var(--back-color) 10px, transparent 10px),
        linear-gradient(-90deg, var(--back-color) 10px, transparent 10px);
        background-position: 0 40px, 0 65px;
        background-repeat: no-repeat;
        background-size: 10px 10px, 10px 10px;

    }

    .digit{
        width:60px;

        background-image: linear-gradient(90deg, transparent 10px, var(--back-color) 10px, #333 50px, transparent 50px),   /*  Top  */
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),   /* Middle*/
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),   /* Bottom*/

        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--back-color) 50px),   /* Topleft */
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--back-color) 50px);   /* Bottomleft */

        background-position: 0 0, 0 50px, 0 100px, 0 10px, 0 60px;
        background-repeat:no-repeat;
        background-size:60px 10px, 60px 10px, 60px 10px, 60px 40px, 60px 40px;
    }

    .zero {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .one {
        background-image: linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .two {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--back-color) 50px);
    }

    .three {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .four {
        background-image: linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .five {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--back-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .six {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--back-color) 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .seven {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--back-color) 10px, var(--back-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .eight {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }

    .nine {
        background-image: linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, transparent 10px, var(--main-color) 10px, var(--main-color) 50px, transparent 50px),
        linear-gradient(90deg, var(--main-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px),
        linear-gradient(90deg, var(--back-color) 10px, transparent 10px, transparent 50px, var(--main-color) 50px);
    }
</style>
