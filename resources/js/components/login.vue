<template>
    <div style="width:99%">
        <div class="row background">
            <div class="col-md-4 col-1"></div>
            <div class="col-md-4 col-10 form_layout p-0">
                <div v-show="this.step === 0" class="form_box_login">
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
                        <div class="col-md-12 content">
                                <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="local_phone" @keypress="isNumber($event)" placeholder="شماره تماس : " v-model="phone"/>
                                <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="https" @keypress="isNumber($event)" placeholder=" پسورد : " v-model="pass"/>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">
                            <vs-button v-on:click="submit" color="dark" style="width:90%" type="gradient">ورود</vs-button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 footer mt-2">
                                <p v-on:click="register_page" style="font-size:11px">ثبت نام</p>
                        </div>
                    </div>

                </div>

                <div v-show="this.step > 0" class="form_box">
                    <div class="row">
                        <div class="col-md-12 head">
                                بخش بالایی
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 logo">
                                لوگو
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 content">
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="account_circle" placeholder="نام و نام خانوادگی : " v-model="name"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="store" placeholder="نام برند :" v-model="brand"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="history" placeholder="سابقه فعالیت :" v-model="history"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="alternate_email" placeholder="اکانت اینستاگرام :" v-model="insta"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="share" placeholder="وب سایت :" v-model="website"/>
                            <vs-input color="warning"  disabled="true"  icon-after="true" label-placeholder="icon-after" icon="local_phone"   placeholder="شماره تماس : " v-model="phone"/>
                            <vs-input color="warning"  icon-after="true" label-placeholder="icon-after" icon="home" placeholder="آدرس : " v-model="home"/>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 submit mt-5">
                            <vs-button v-on:click="change_details" color="success" style="width:90%" type="gradient">ثبت تغییر</vs-button>
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
    data(){
        return{
            phone :'',
            pass : '',
            step : 0,

            name: '',
            brand: '',
            history: '',
            insta: '',
            home: '',
            website : ''
        }
    },
    methods:{
        register_page:function(){
            this.$router.push('index').catch(err => {})
        },
        submit:function(){

            if (this.phone.length < 1) {
                this.$vs.notify({title:'فیلد خالی',text:'لطفا فیلد شماره تلفن را پر کنید',color:'red',position:'top-center'})
            }else if (this.phone.length < 10) {
                this.$vs.notify({title:'خطا ',text:'شماره تلفن باید حاوی 11 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            }else if (this.phone.length > 12) {
                this.$vs.notify({title:'خطا ',text:'شماره تلفن باید حاوی 11 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            
            }else if (this.pass.length > 6) {
                this.$vs.notify({title:'خطا ',text:'پسورد  باید حاوی 6 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            }else if (this.pass.length < 6) {
                this.$vs.notify({title:'خطا ',text:' پسورد باید حاوی 6 کاراکتر باشد دقت کنید',color:'red',position:'top-center'})
            }else{

                axios.post('/login_system',{
                data : {'phone':this.phone,'pass':this.pass}
                    }).then((response)=>{
                if(response.data.status === 100){
                    this.$vs.notify({title:'ورود موفقیت آمیز',text:'کاربر گرامی خوش آمدید',color:'success',position:'top-center'})
                    this.step = 1
                    this.name = response.data.data.name
                    this.brand = response.data.data.brand
                    this.history = response.data.data.history
                    this.insta = response.data.data.insta
                    this.home = response.data.data.home
                    this.website = response.data.data.website

                }else{
                    this.$vs.notify({title:' خطا در ورود',text:'لطفا اطلاعات خود را دوباره بررسی کنید',color:'danger',position:'top-center'})

                }
            })
            }  
        },
        change_details:function(){
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
            
            else if (this.home.length < 1) {
                this.$vs.notify({title:'خطا ',text:'حداقل 3 کاراکتر در فیلد آدرس الزامی است',color:'red',position:'top-center'})
            }else if (this.home.length < 3) {
                this.$vs.notify({title:'خطا ',text:'حداقل 3 کاراکتر در فیلد آدرس الزامی است',color:'red',position:'top-center'})
            }else{
                axios.post('/change_data_update',{
                    data : {'name':this.name,'brand':this.brand,'history':this.history,
                            'insta':this.insta,'phone':this.phone,'home':this.home,
                            'website':this.website}
                }).then((response)=>{
                    if(response.data.status === 100){
                        this.$vs.notify({title:'تغییرات ثبت شد ',text:'تغغیرات با موفیت ثبت شد با تشکر',color:'success',position:'top-center'})
                        this.$router.push('/index').catch(err => {})
                    }else if(response.data.status === 102){
                        this.$vs.notify({title:'خطا ',text:'لطفا با پشیتبانی تماس بگیرید خطا در سایت ',color:'danger',position:'top-center'})
                    }
                })
            }
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

            } else {
                return true;
            }
        }
    }
}
</script>