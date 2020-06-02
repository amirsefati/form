<template>
<div style="width:99%">
        <div class="row background">
            <div class="col-md-4 col-1"></div>
            <div class="col-md-4 col-10 form_layout p-0">
                <div class="form_box_success">
                    <div class="row">
                        <div class="col-md-12 head">
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 logo">
                                <img src="/img/logo.png" alt="">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 content"><br>
                            <img src="/img/tick.png" alt=""> <br> <br>
                            با تشکر از ثبت نام شما در مزوتو <br>
                            به زودی اطلاعات شما توسط کارشناسان ما بررسی میشود و با شما تماس میگیریم. <br> <br>
                            به امید دیدار
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 footer mt-2">
                                <p v-on:click="logout_system" style="font-size:13px"> بازگشت به صفحه اصلی  </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-1"></div>

        </div>
    </div>
        
</template>

<script>
export default {
    methods:{
        logout_system:function(){
            axios.post('/logout_system',{
                data : {'logout' : 'user'}
            }).then((response)=>{
                this.$router.push('index').catch(err => {})
            })
        }
    }
}
</script>