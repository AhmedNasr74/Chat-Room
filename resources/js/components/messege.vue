<template>
    <div>
        <li class="list-group-item" :class="className"><slot></slot>
        <span class="float-right messege-time mt-1">sent at : {{ time }}</span>
        </li>
        <small class="badge float-right" :class="badgColor">{{user}}</small>
    </div>
</template>
<script>
export default {
    props:[
        'color','user','time',
    ],
    computed:{
        className()
        {
            return 'list-group-item-'+this.color;
        },
        badgColor()
        {
            return 'badge-'+this.color;
        }
    }
}
</script>
<style>
    .messege-time{
        font-size: 12px;
        color:#000;
    }
</style>
