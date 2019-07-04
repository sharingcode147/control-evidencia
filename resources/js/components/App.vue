<template>
    <div class="contenedor">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header"></div> <!--escribir algo dentro del div (PROBANDO)-->

                    <div class="card-body">
                        <image-uploader></image-uploader>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ImageUploader from './ImageUploader.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            ImageUploader
        }
    }
</script>
