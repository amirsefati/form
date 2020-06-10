<template>
    <div style="width:99%">
        <div class="row background">
            <div class="col-md-4 col-1">&nbsp;</div>
            <div class="col-md-4 col-10 form_layout pl-0">
                <div class="form_box">
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
                        <div class="col-md-12 content">
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="account_circle" placeholder="نام و نام خانوادگی : " v-model="name"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="store" placeholder="نام برند :" v-model="brand"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="history" placeholder="سابقه فعالیت :" v-model="history"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" lang="eng" icon="alternate_email" placeholder="اکانت اینستاگرام :" v-model="insta"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="share" placeholder="وب سایت :" v-model="website"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="local_phone" placeholder="شماره تماس : "  @keypress="isNumber($event)" v-model="phone"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="home" placeholder="آدرس : " v-model="home"/>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">
                            <vs-button :disabled="this.disable === 0" v-on:click="submit" color="dark" style="width:90%" type="gradient">ثبت نام</vs-button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 footer mt-2">
                                <p v-on:click="login_page"  style="font-size:11px">ورود</p>
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
    data(){
        return{
            name: '',
            brand: '',
            history: '',
            insta: '',
            phone: '',
            home: '',
            website : '',
            disable : 1
        }
    },
    created(){
        this.$vs.loading({type:'sound',background:'white'})
        setTimeout( ()=> {
            this.$vs.loading.close()
        },500);
    },
    methods:{
        submit : function(){
            if(this.name.length < 1){
                this.$vs.notify({title:'فیلد خالی',text:'لطفا فیلد نام را پر کنید',color:'red',position:'top-center'})
            }else if (this.name.length < 3) {
                this.$vs.notify({title:'خطا ',text:'حداقل 3 کاراکتر در فیلد نام الزامی است',color:'red',position:'top-center'})
            
            }else if (this.brand.length < 1) {
                this.$vs.notify({title:'فیلد خالی',text:'لطفا فیلد برند را پر کنید',color:'red',position:'top-center'})
            }else if (this.brand.length < 3) {
                this.$vs.notify({title:'خطا ',text:'حداقل 3 کاراکتر در فیلد نام الزامی است',color:'red',position:'top-center'})
            
            }else if (this.history.length < 1) {
                this.$vs.notify({title:'فیلد خالی',text:'لطفا فیلد سابقه فعالیت را پر کنید',color:'red',position:'top-center'})
            }else if (this.history.length < 3) {
            this.$vs.notify({title:'خطا ',text:'حداقل 3 کاراکتر در فیلد سابقه فعالیت الزامی است',color:'red',position:'top-center'})
            
            }else if (this.phone.length < 1) {
                this.$vs.notify({title:'فیلد خالی',text:'لطفا فیلد شماره تلفن را پر کنید',color:'red',position:'top-center'})
            }else if (this.phone.length < 10) {
                this.$vs.notify({title:'خطا ',text:'شماره تلفن باید حاوی 11 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            }else if (this.phone.length > 12) {
                this.$vs.notify({title:'خطا ',text:'شماره تلفن باید حاوی 11 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            }
            
            
            else{
                
                this.disable = 0

                axios.post('/account_user',{
                    data : {'name':this.name,'brand':this.brand,'history':this.history,
                            'insta':this.insta,'phone':this.phone,'home':this.home,
                            'website':this.website}

                }).then((response)=>{
                    if(response.data === 100){
                        this.$router.push('/verifycode').catch(err => {})
                    }else if(response.data === 102){
                        this.$vs.notify({title:'خطا ',text:'چنین کاربری با شماره تلفن در سایت موجود است.',color:'warning',position:'top-center'})
                    setTimeout(() => {
                        this.disable = 1
                    }, 1500);
                    }
                })
            }
        },
        login_page:function(){
            this.$router.push('loginm').catch(err => {})
        },
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
                this.$vs.notify({title:'ورودی نامعتبر',text:'در فیلد شماره تلفن فقط عدد وارد کنید',color:'danger',position:'top-center'})

            }else if(this.phone.length > 10){
                this.$vs.notify({title:'ورودی نامعتبر',text:'فیلد شماره تلفن باید دارای 11 کاراکتر باشد',color:'danger',position:'top-center'})
                evt.preventDefault();;

            } 
            else {
                return true;
            }
        }
        
    }
}
</script>