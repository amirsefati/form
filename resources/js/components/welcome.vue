<template>
        <div style="width:99%">
        <div class="row background">
            <div class="col-md-4 col-1"></div>
            <div class="col-md-4 col-10 form_layout p-0">
                <div class="form_box_login">
                    <div class="row">
                        <div class="col-md-12 head">
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 logo">
                            <img src="/img/logo.svg" width="200px"  height="45px" alt="">

                       </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 content mt-4">
                              <img src="/img/login.svg" width="80px" alt="">
                            <br> <br>
                            <p>به سامانه ثبت نام مزوتو خوش آمدید</p>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">
                            
                            <vs-button color="#361736" v-on:click="gotosignin" style="width:90%" type="filled">ثبت نام</vs-button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 footer mt-2">

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
    created() {
            this.$vs.loading({type:'sound',background:'white'})
            setTimeout( ()=> {
                this.$vs.loading.close()
            },500);
        },
    methods:{
        gotosignin:function(){
            this.$router.push('index').catch(err => {})
        }
    }
}
</script>