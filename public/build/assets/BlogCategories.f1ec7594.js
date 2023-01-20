import{r as c,u as v,o as h,$ as u,a as m,c as x,w as l,b as e,d as _,e as i,f as B,v as C,g as S,t as g,h as T,i as k,k as A}from"./app.2dfc48f0.js";import{e as b,D as N}from"./dataTables.bootstrap5.3db25059.js";import{_ as w}from"./ModalComponent.d91dfeff.js";import{_ as D}from"./GenericLayout.f583260a.js";import"./app.min.43ffa372.js";import"./index.37b1d19b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const E={class:"card"},$=e("div",{class:"card-header"},[e("h5",null,"Blog Categories"),e("button",{type:"button",id:"modalBtn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",class:"btn btn-icon btn-primary"},[e("i",{class:"bi bi-plus-circle"}),A(" Add Category ")])],-1),U={class:"card-body"},M=e("thead",null,[e("tr",null,[e("th",null,"Name"),e("th",null,"Created At"),e("th",null,"Actions")])],-1),V=["onSubmit"],F={class:"row"},I={class:"col"},q={class:"form-group"},L=e("label",{for:"category name"},"Category Name",-1),O={key:0,class:"invalid-feedback"},j={class:"form-group mt-4"},z=e("button",{type:"button",class:"btn btn-danger",style:{"margin-right":"10px"},"data-bs-dismiss":"modal"},"Close",-1),G={id:"submitBtn",type:"submit",class:"btn btn-primary"},X={__name:"BlogCategories",props:{categories:Array},setup(d){const p=d;b.use(N);const o=c(!1),n=c(null),t=v({name:""}),f=()=>{if(!t.name||t.name.trim()==""){t.setError("name","category name is required");return}const a=document.getElementById("submitBtn");o.value?(a.innerText="Updating...",t.put(`/blog_categories/${n.value.id}`,{onSuccess(){t.reset(),o.value=!1,n.value=null,a.innerText="Save"},onError(){a.innerText="Update"}})):(a.innerText="Saving...",t.post("/blog_categories",{onSuccess(){t.reset()},onFinish(){a.innerText="Save"}}))};return h(()=>{document.getElementById("dt").addEventListener("click",function(a){if(a.target.nodeName!=="BUTTON")return;const r=parseInt(a.target.getAttribute("data-id")),s=a.target.getAttribute("data-type");s==="del"?confirm("Are you sure you want to delete this category?")&&t.delete(`/blog_categories/${r}`):s==="edit"&&(n.value=p.categories.filter(({id:y})=>y==r)[0],t.name=n.value.name,o.value=!0,u("#modalBtn").click())}),u("#exampleModal").on("hide.bs.modal",function(){o.value&&(o.value=!1,n.value=null)})}),(a,r)=>(m(),x(D,null,{default:l(()=>[e("div",E,[$,e("div",U,[_(i(b),{id:"dt",class:"display table table-responsive",data:d.categories,columns:[{data:"name"},{data:"created_at",render:s=>new Date(s).toDateString()},{data:null,render:s=>`<button class='btn btn-sm btn-secondary mr-3' data-type='edit' data-id='${s.id}'>Edit</button><button class='btn btn-sm btn-danger' data-type='del' data-id='${s.id}'>Delete</button>`}]},{default:l(()=>[M]),_:1},8,["data","columns"])])]),_(w,{title:o.value?"Update Category":"Add Category"},{default:l(()=>[e("form",{onSubmit:k(f,["prevent"])},[e("div",F,[e("div",I,[e("div",q,[L,B(e("input",{type:"text","onUpdate:modelValue":r[0]||(r[0]=s=>i(t).name=s),class:"form-control"},null,512),[[C,i(t).name]]),i(t).errors.name?(m(),S("div",O,g(i(t).errors.name),1)):T("",!0)])])]),e("div",j,[z,e("button",G,g(o.value?"Update":"Save"),1)])],40,V)]),_:1},8,["title"])]),_:1}))}};export{X as default};