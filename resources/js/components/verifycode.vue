<template>
    <div>
        <div style="width:99%">
        <div class="row background">
            <div class="col-md-4 col-1"></div>
            <div class="col-md-4 col-10 form_layout p-0">
                <div class="form_box_verify">
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
                        <div class="col-md-12 content mt-4">
                            <vs-input color="warning" disabled="true" icon-after="true" label-placeholder="icon-after" icon="local_phone" placeholder="شماره تماس : " v-model="phone"/>
                            <vs-input color="warning" size="default" @keypress="isNumber($event)" placeholder="کد ارسال شده" v-model="pass" />
                            <vs-button :disabled="(this.pass.length < 6 || this.pass.length > 6) ? true : false" v-on:click="check_code" class="btn_verify_code" style="width:60%;text-align:center" color="success" type="gradient">تایید کد </vs-button>
                            <p style="font-size:9px;margin:8px 0px 2px 0px">زمان باقی مانده : </p> <span style="font-size:12px;color:red"> {{this.timer}} : 00 </span>   
                            <p v-show="this.send === 1" v-on:click="send_code_b" style="margin-top:10px">ارسال دوباره کد</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 footer mt-2">
                                <p style="font-size:11px" v-on:click="back_page">بازگشت به صفحه قبل</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-1"></div>

        </div>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            'phone' : '',
            'pass' : '',
            'timer' : 60,
            'send' : 0,
        }
    },
    created(){
        setTimeout(() => {
            this.send = 1
        }, 60000);

        axios.post('/getuser_phone',{
            data : {'phone':'ok'}
        }).then((response)=>{
            if(response.data.phone === 0){
                //this.$router.push('index').catch(err => {})
            }else if(response.data.phone === 1){
                //this.$router.push('success').catch(err => {})
            }
            else{
                this.phone = response.data.phone
            }
        })
            this.countDownTimer()

    },
    methods:{
        countDownTimer() {
                if(this.timer > 0) {
                    setTimeout(() => {
                        this.timer -= 1
                        this.countDownTimer()
                    }, 1000)
                }
        },

        check_code:function(){
            axios.post('/check_code',{
                data:{'phone':this.phone,'pass':this.pass}
            }).then((response)=>{
                if(response.data === 106){
                    this.$vs.notify({title:'خطا ',text:'کد وارد شده صحیح نمی باشد ',color:'red',position:'top-center'})
                }else if(response.data === 100){
                    this.$vs.notify({title:'احراز هویت تکمیل شد ',text:'کد وارد شده صحیح میباشد لطفا منتظر بمانید',color:'primary',position:'top-center'})
                    this.$router.push('success').catch(err => {})
                }
            })
        },
        send_code_b:function(){
            this.send = 0
            axios.post('/send_again_sms',{
                data : {'phone' : this.phone}
            }).then((response)=>{
                
            })
        },
          isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
                this.$vs.notify({title:'ورودی نامعتبر',text:'در فیلد شماره تلفن فقط عدد وارد کنید',color:'danger',position:'top-center'})

            }else if(this.pass.length > 5){
                this.$vs.notify({title:'ورودی نامعتبر',text:'کد عبور دارای 6 کاراکتر هست لطفا دقت کنید',color:'danger',position:'top-center'})
                evt.preventDefault();;

            } else {
                return true;
            }
        },
        back_page:function(){
            this.$router.push('index').catch(err => {})
        }
    }
}
</script>