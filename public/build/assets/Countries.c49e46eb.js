import{u as k,r as m,o as B,$ as _,a as i,c as N,w as l,b as e,d as p,e as a,f as b,v as f,g as v,t as c,h as y,i as S,k as T}from"./app.2dfc48f0.js";import{e as h,D as E}from"./dataTables.bootstrap5.3db25059.js";import"./dataTables.responsive.02db78a1.js";import{_ as w}from"./GenericLayout.f583260a.js";import{_ as A}from"./ModalComponent.d91dfeff.js";import"./app.min.43ffa372.js";import"./index.37b1d19b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const D={class:"card"},U=e("div",{class:"card-header"},[e("h5",null,"Countries"),e("button",{type:"button",id:"modalBtn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",class:"btn btn-icon btn-primary"},[e("i",{class:"bi bi-plus-circle"}),T(" Add Country ")])],-1),$={class:"card-body"},V=e("thead",null,[e("tr",null,[e("th",null,"Name"),e("th",null,"Code"),e("th",null,"Created At"),e("th",null,"Actions")])],-1),M=["onSubmit"],F={class:"row"},I={class:"col"},q={class:"form-group"},O=e("label",{for:"category name"},"Country Name",-1),j={key:0,class:"invalid-feedback"},L={class:"row mt-3"},z={class:"col"},G={class:"form-group"},H=e("label",{for:"category image"},"Country Code",-1),J={key:0,class:"invalid-feedback"},K={class:"form-group mt-4"},P=e("button",{type:"button",class:"btn btn-danger",style:{"margin-right":"10px"},"data-bs-dismiss":"modal"},"Close",-1),Q={id:"submitBtn",type:"submit",class:"btn btn-primary"},se={__name:"Countries",props:{countries:Array},setup(u){const g=u;h.use(E);const t=k({name:"",code:""}),r=m(null),n=m(!1),C=(d=!1)=>{if(t.clearErrors(),t.name.trim()===null&&t.name.trim()==""?t.setError("name","name field is required"):!t.code&&parseInt(t.code)===NaN&&t.setError("code","country code field is required"),t.errors&&Object.keys(t.errors).length)return;const s=document.getElementById("submitBtn");n.value?(s.innerText="Updating...",t.put(`/countries/${r.value.id}`,{onSuccess(o){r.value=null,n.value=!1,s.innerText="Save",t.reset()},onError(o){s.innerText="Update"}})):(s.innerText="Saving...",t.post("/countries",{onSuccess(o){t.reset()},onFinish(){s.innerText="Save"}}))};return B(()=>{document.getElementById("dt").addEventListener("click",function(d){if(d.target.nodeName!=="BUTTON")return;const s=d.target.getAttribute("data-id"),o=d.target.getAttribute("data-type");o==="del"?confirm("Are you sure you want to delete this country?")&&t.delete(`/countries/${s}`):o==="edit"&&(r.value=g.countries.filter(({id:x})=>x==s)[0],t.name=r.value.name,t.code=r.value.code,n.value=!0,_("#modalBtn").click())}),_("#exampleModal").on("hide.bs.modal",function(){n.value&&(n.value=!1,r.value=null)})}),(d,s)=>(i(),N(w,null,{default:l(()=>[e("div",D,[U,e("div",$,[p(a(h),{options:{responsive:!0},data:u.countries,columns:[{data:"name"},{data:"code"},{data:"created_at",render:o=>new Date(o).toDateString()},{data:null,render:o=>`<button data-type=edit data-id=${o.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${o.id} class='btn btn-sm btn-danger'>Delete</button>`}],class:"table table-responsive display",id:"dt"},{default:l(()=>[V]),_:1},8,["data","columns"])])]),p(A,{title:n.value?"Update Country":"Add Country"},{default:l(()=>[e("form",{onSubmit:S(C,["prevent"])},[e("div",F,[e("div",I,[e("div",q,[O,b(e("input",{type:"text","onUpdate:modelValue":s[0]||(s[0]=o=>a(t).name=o),class:"form-control"},null,512),[[f,a(t).name]]),a(t).errors.name?(i(),v("div",j,c(a(t).errors.name),1)):y("",!0)])])]),e("div",L,[e("div",z,[e("div",G,[H,b(e("input",{type:"number","onUpdate:modelValue":s[1]||(s[1]=o=>a(t).code=o),class:"form-control"},null,512),[[f,a(t).code]]),a(t).errors.code?(i(),v("div",J,c(a(t).errors.code),1)):y("",!0)])])]),e("div",K,[P,e("button",Q,c(n.value?"Update":"Save"),1)])],40,M)]),_:1},8,["title"])]),_:1}))}};export{se as default};