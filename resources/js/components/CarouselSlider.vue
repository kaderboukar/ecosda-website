<template>
    <carousel :autoplay="true" :autoplayTimeout="5000">
        <slide>
            <img src="/images/project1.jpg" alt="Projet 1">
        </slide>
        <slide>
            <img src="/images/project2.jpg" alt="Projet 2">
        </slide>
    </carousel>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
    components: {
        Carousel,
        Slide,
    },
};
</script>