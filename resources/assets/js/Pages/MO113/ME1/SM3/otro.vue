<template>
    <div class="row pt-5">
        
        <div class="col-12">
            
            <div class="form-label-group">
                <input type="text" class="form-control form-control-sm" v-model="datos" placeholder="USUARIO"/>
                <label for="usuario"><b>USUARIO</b></label>
            </div>
        </div>
    </div>
</template>

<script>

export default {
	name: "otro",
	components: {
        
    },
    data() {
        return {
            datos: null
        }
    },
    methods: {
        
    },
    mounted() {
        
    }
};
</script>