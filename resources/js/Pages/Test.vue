<template>
<div class="container">
    <div class="spacer s2"></div>
    <div id="trigger1" class="spacer s0"></div>
    <div id="pin1" class="box2 blue">
        <div class="test">
            <p>Stay where you are (at least for a while).</p>
            <a href="#" class="viewsource">view source</a>

        </div>
    </div>
    <div class="spacer s2"></div>
</div>

</template>

<script>
export default {
    mounted() {
       const scene2 = this.$scrollmagic.scene({
        // ID of element where animation starts
        triggerElement: '#trigger1',

        // {0,0.5,1} - animations starts from {top,center,end} of window
        triggerHook: 0,

        // Duration of animation
        duration: 300
    })
    .addIndicators({ name: '2 (duration: 300)' })
    .setPin('#pin1')

    this.$scrollmagic.addScene(scene2)

    }
}

</script>

<style scoped>
.container {
    height: 2000px;
    display: flex;
    flex-direction: column;

}
.box2 {
}





    .test {
        height: 200px;
        width: 200px;
        background-color: blue;
    }

</style>
