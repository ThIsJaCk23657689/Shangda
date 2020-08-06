<template>
<div class="nav-div">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="#" id="a_all" @click="allClick"><i class="fas fa-check-double" id="i_all"></i>所有訂單</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="a_none" @click="noneClick"><i class="fas fa-check-double" style="display:none;" id="i_none"></i>未付款未出貨訂單</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="a_paid" @click="paidClick"><i class="fas fa-check-double" style="display:none;" id="i_paid"></i>已付款未出貨訂單</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="a_delivered" @click="deliveredClick"><i class="fas fa-check-double" style="display:none;" id="i_delivered"></i>未付款已出貨訂單</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="a_done" @click="doneClick"><i class="fas fa-check-double" style="display:none;" id="i_done"></i>已完成訂單</a>
        </li>
    </ul>
</div>
</template>

<script>
export default {
    props: ['filter'],
    data(){
        return {

        }
    },
    methods: {
        allClick(){
            $('#a_all').addClass('active');
            $('#i_all').fadeIn();

            $('#a_none').removeClass('active');
            $('#a_paid').removeClass('active');
            $('#a_delivered').removeClass('active');
            $('#a_done').removeClass('active');

            $('#i_none').hide();
            $('#i_paid').hide();
            $('#i_delivered').hide();
            $('#i_done').hide();

            let status = 0;
            this.$emit('change-status',status);

        },
        noneClick(){
            $('#a_none').addClass('active');
            $('#i_none').fadeIn();

            $('#a_all').removeClass('active');
            $('#a_paid').removeClass('active');
            $('#a_delivered').removeClass('active');
            $('#a_done').removeClass('active');

            $('#i_all').hide();
            $('#i_paid').hide();
            $('#i_delivered').hide();
            $('#i_done').hide();

            let status = 1;
            this.$emit('change-status',status);
        },
        paidClick(){
            $('#a_paid').addClass('active');
            $('#i_paid').fadeIn();

            $('#a_all').removeClass('active');
            $('#a_none').removeClass('active');
            $('#a_delivered').removeClass('active');
            $('#a_done').removeClass('active');

            $('#i_all').hide();
            $('#i_none').hide();
            $('#i_delivered').hide();
            $('#i_done').hide();

            let status = 2;
            this.$emit('change-status',status);
        },
        deliveredClick(){
            $('#a_delivered').addClass('active');
            $('#i_delivered').fadeIn();

            $('#a_all').removeClass('active');
            $('#a_none').removeClass('active');
            $('#a_paid').removeClass('active');
            $('#a_done').removeClass('active');

            $('#i_all').hide();
            $('#i_none').hide();
            $('#i_paid').hide();
            $('#i_done').hide();

            let status = 3;
            this.$emit('change-status',status);
        },
        doneClick(){
            $('#a_done').addClass('active');
            $('#i_done').fadeIn();

            $('#a_all').removeClass('active');
            $('#a_none').removeClass('active');
            $('#a_paid').removeClass('active');
            $('#a_delivered').removeClass('active');

            $('#i_all').hide();
            $('#i_none').hide();
            $('#i_paid').hide();
            $('#i_delivered').hide();

            let status = 4;
            this.$emit('change-status',status);
        },
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>
