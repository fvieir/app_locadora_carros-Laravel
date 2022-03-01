<template>
    <div class="mb-3">
        <label :for="forLabel" class="form-label">{{ label }}</label>
        <slot/>
        <div :id="idHelp" class="form-text">{{ texto }}</div>
    </div>
</template>
<script>
export default {
    name: 'InputContainer',
    props: {
        forLabel : {
            type: String,
            required: true
        },
        label :{
            Type: String,
            required: true
        },
        idHelp: {
            Type: String,
            required: true
        },
        texto: {
            Type: String,
            required: true
        }
    }
}
</script>