<script setup>
import { useFormElement } from './composables/FormElement'
import FieldErrors from './_FieldErrors.vue'

/**
 * Element Properties
 */
const props = defineProps({
    type: {
        type: String,
        default: 'text'
    },
    name: {
        type: String,
        required: true,
    },
})

const { data, error } = useFormElement( props.name )

</script>

<template>
    <div class='form-group'>
        <label>
            <slot/>
        </label>

        <input class='form-control' v-model='data' :type='props.type' :name='props.name'>

        <FieldErrors :errors="error"></FieldErrors>
    </div>
</template>

<style>
.form-group {
    display: flex;
    flex-direction: column;
    font-size: 1.1em;
}
label {
    display: block;
    font-weight: 500;
    margin-bottom: 4px;
}
.form-control {
    border: none;
    border-bottom: 1px solid var( --color-accent );
    padding: 0.4em 0.7em;
    border-radius: 4px;
    margin-bottom: 12px;
    background-color: var( --color-bg-form-control );
}
.form-control:focus {
    background-color: var( --color-bg-form-control-active );
    outline: 1px solid var( --color-primary );
    box-shadow: 0 2px 6px 2px var( --color-shadow );
}
</style>