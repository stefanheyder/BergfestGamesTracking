<template>
    <div class="row">
        <div class="clockcase" >
            <div :class="{ lastSeconds: remainingTime < 5 && remainingTime > 0 }">
                <span class="zero digit"></span>
                <span :class="minutes"></span>
                <span class="colon"></span>
                <span :class="tenSeconds"></span>
                <span :class="seconds"></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                remainingTime: 0,
                remainingTimers: []
            };
        },
        created() {
            let serverInterval = 0;
            let timerInterval = 0;
            let updateTimer = () => undefined;
            let pollServer = () => {
                axios.get('/timer')
                    .then(response => {
                        if (response.data.start) {
                            clearInterval(serverInterval);
                            this.remainingTime = 180
                            this.remainingTimers.push(30, 180);
                            clearInterval(timerInterval);
                            timerInterval = setInterval(updateTimer, 1000);
                        }
                        else {
                            this.remainingTime = 0;
                        }
                    });
            };
            updateTimer = () => {
                if (this.remainingTime === 0) {
                    if (this.remainingTimers.length > 0) {
                        this.remainingTime = this.remainingTimers[0];
                        this.remainingTimers = this.remainingTimers.slice(1);
                    }
                    else {
                        serverInterval = setInterval(pollServer, 1000)
                        clearInterval(timerInterval);
                    }
                }
                else {
                    this.remainingTime -= 1;
                }
                this.$forceUpdate();
            };
            timerInterval = setInterval(updateTimer, 1000);
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
        --back-color:white;
        --main-color:red;
    }

    .clockcase {
        margin: 5 auto;
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
        background: linear-gradient(-90deg, var(--main-color) 10px, transparent 10px),
        linear-gradient(-90deg, var(--main-color) 10px, transparent 10px);
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
    .lastSeconds {
        -webkit-animation: pulsate 1s ease-out;
        -webkit-animation-iteration-count: infinite;
    }
    @-webkit-keyframes pulsate {
        0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
        50% {opacity: 1.0;}
        100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
    }
</style>
