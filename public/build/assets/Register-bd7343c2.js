import{A as k}from"./alert-4d2d625c.js";import{_ as b,c as v,a as s,d as u,w as a,F as P,r,o as U,e as C,b as h,t as p,f as S}from"./app-d88e6648.js";const A={name:"Register",components:{Alert:k},data(){return{second:30,intervalId:null,dialog:!0,policy:!1,closeStatus:!0,form:{email:"",password:"",password_confirmation:"",phone:"",agreement:!1},alert:{title:null,type:null,show:!1,data:[]}}},methods:{showPolicy(){this.policy=!0,this.dialog=!1,window.setInterval(()=>{this.second>0?this.second--:this.closeStatus=!1},1e3)},closePolicy(){this.policy=!1,this.dialog=!0},register(){this.alert.data=[],axios.post("/api/v1/users/register",this.form).then(e=>{this.alert.title=e.data.message,this.alert.type=e.data.status,this.alert.show=!0,localStorage.setItem("token",e.data.data.token),setTimeout(()=>{this.alert.show=!1,this.$router.push({name:"dashboard"})},2e3)}).catch(e=>{this.alert.title=e.response.data.message,this.alert.type=e.response.data.status,this.alert.show=!0,e.response.data.errors.hasOwnProperty("phone")&&(this.alert.data.phone=e.response.data.errors.phone[0]),e.response.data.errors.hasOwnProperty("email")&&(this.alert.data.email=e.response.data.errors.email[0]),e.response.data.errors.hasOwnProperty("password")&&(this.alert.data.password=e.response.data.errors.password[0]),e.response.data.errors.hasOwnProperty("agreement")&&(this.alert.data.agreement=e.response.data.errors.agreement[0]),setTimeout(()=>{this.alert.show=!1},5e3)})}}},O={class:"container"};function B(e,l,D,I,o,i){const w=r("Alert"),d=r("el-input"),n=r("el-form-item"),_=r("el-checkbox"),m=r("el-button"),f=r("el-form"),c=r("el-dialog"),g=r("el-col"),y=r("el-row"),V=S("maska");return U(),v(P,null,[s(w,{title:o.alert.title,type:o.alert.type,show:o.alert.show},null,8,["title","type","show"]),u("div",O,[s(y,null,{default:a(()=>[s(g,{span:24,md:12},{default:a(()=>[s(c,{modelValue:o.dialog,"onUpdate:modelValue":l[7]||(l[7]=t=>o.dialog=t),title:e.$t("users.cabinet"),center:"","close-on-click-modal":!1,"close-on-press-escapes":!1,"show-close":!1},{default:a(()=>[s(f,null,{default:a(()=>[s(n,{error:this.alert.data.phone},{default:a(()=>[C(s(d,{modelValue:o.form.phone,"onUpdate:modelValue":l[0]||(l[0]=t=>o.form.phone=t),placeholder:e.$t("users.phone"),"data-maska":"+7 7## ###-##-##"},null,8,["modelValue","placeholder"]),[[V]])]),_:1},8,["error"]),s(n,{error:this.alert.data.email},{default:a(()=>[s(d,{modelValue:o.form.email,"onUpdate:modelValue":l[1]||(l[1]=t=>o.form.email=t),placeholder:"E-mail"},null,8,["modelValue"])]),_:1},8,["error"]),s(n,{error:this.alert.data.password},{default:a(()=>[s(d,{type:"password",modelValue:o.form.password,"onUpdate:modelValue":l[2]||(l[2]=t=>o.form.password=t),"show-password":"",placeholder:e.$t("users.password")},null,8,["modelValue","placeholder"])]),_:1},8,["error"]),s(n,{error:this.alert.data.password},{default:a(()=>[s(d,{type:"password",modelValue:o.form.password_confirmation,"onUpdate:modelValue":l[3]||(l[3]=t=>o.form.password_confirmation=t),"show-password":"",placeholder:e.$t("users.password_confirmation")},null,8,["modelValue","placeholder"])]),_:1},8,["error"]),s(n,{error:this.alert.data.agreement},{default:a(()=>[s(_,{modelValue:o.form.agreement,"onUpdate:modelValue":l[4]||(l[4]=t=>o.form.agreement=t),label:e.$t("users.agree_checkbox"),onClick:l[5]||(l[5]=t=>i.showPolicy())},null,8,["modelValue","label"])]),_:1},8,["error"]),s(n,null,{default:a(()=>[s(m,{type:"success",onClick:l[6]||(l[6]=t=>i.register())},{default:a(()=>[h(p(e.$t("users.sign_up")),1)]),_:1})]),_:1})]),_:1})]),_:1},8,["modelValue","title"]),s(c,{modelValue:o.policy,"onUpdate:modelValue":l[9]||(l[9]=t=>o.policy=t),title:e.$t("users.policy"),center:"","close-on-click-modal":!1,"close-on-press-escapes":!1,"show-close":!1,"before-close":i.closePolicy},{default:a(()=>[s(f,null,{default:a(()=>[s(n,null,{default:a(()=>[u("p",null,p(e.$t("users.agreement_text")),1)]),_:1}),s(n,null,{default:a(()=>[u("p",null,p(e.$t("users.policy_text")),1)]),_:1})]),_:1}),s(m,{type:"success",onClick:l[8]||(l[8]=t=>i.closePolicy()),disabled:o.closeStatus},{default:a(()=>[h(p(e.$t("users.read",{msg:o.second})),1)]),_:1},8,["disabled"])]),_:1},8,["modelValue","title","before-close"])]),_:1})]),_:1})])],64)}const E=b(A,[["render",B]]);export{E as default};