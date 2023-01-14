import{r as p,u as k,o as C,$ as f,a as l,c as T,w as d,b as t,d as b,e as r,f as B,v as S,g as c,t as u,h as m,i as E,k as N}from"./app.1ac5e0b9.js";import{_ as w}from"./GenericLayout.1e147c90.js";import{_ as A}from"./ModalComponent.d806c712.js";import{e as h,D}from"./dataTables.bootstrap5.b1186638.js";import"./dataTables.responsive.219a163f.js";import"./app.min.11b0299a.js";import"./_plugin-vue_export-helper.cdc0426e.js";const O={class:"card"},U=t("div",{class:"card-header"},[t("h5",null,"Product Categories"),t("button",{type:"button",id:"modalBtn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",class:"btn btn-icon btn-primary"},[t("i",{class:"bi bi-plus-circle"}),N(" Add Category ")])],-1),$={class:"card-body"},F=t("thead",null,[t("tr",null,[t("th",null,"Name"),t("th",null,"Image"),t("th",null,"No.Of Products"),t("th",null,"Created At"),t("th",null,"Actions")])],-1),I=["onSubmit"],M={class:"row"},P={class:"col"},V={class:"form-group"},j=t("label",{for:"category name"},"Category Name",-1),q={key:0,class:"invalid-feedback"},z={class:"row mt-3"},L={class:"col"},G={class:"form-group"},H=t("label",{for:"category image"},"Feature Image",-1),J={key:0,class:"invalid-feedback"},K=["src"],Q={class:"form-group mt-4"},R=t("button",{type:"button",class:"btn btn-danger",style:{"margin-right":"10px"},"data-bs-dismiss":"modal"},"Close",-1),W={id:"submitBtn",type:"submit",class:"btn btn-primary"},oe={__name:"ProductCategories",props:{categories:Array},setup(g){const v=g;h.use(D);const n=p(!1),i=p(null),e=k({name:"",image_path:null}),_=(a=!0)=>((e.name.trim()===null||e.name.trim()==="")&&e.setError("name","name field is required"),console.log(e.image_path),(a&&e.image_path===null||e.image_path===void 0)&&e.setError("image_path","image field is required"),console.log(e.errors,Object.keys(e.errors).length,Object.getPrototypeOf(e.errors)===Object.prototype),!(e.errors&&Object.keys(e.errors).length)),y=()=>{const a=document.getElementById("submitBtn");if(e.clearErrors(),n.value){if(a.innerText="Updating.....",!_(!1)){a.innerText="Update";return}e.post("/product_categories/update/"+i.value.id,{onSuccess(o){e.reset(),n=!1,i=null,a.innerText="Save"},onError(o){a.innerText="Update"}})}else{if(a.innerText="Saving....",!_()){a.innerText="Save";return}e.post("/product_categories",{onSuccess(o){e.reset()},onFinish(o){a.innerText="Save"}})}};return C(()=>{document.getElementById("dt").addEventListener("click",function(a){if(a.target.nodeName!=="BUTTON")return;const o=a.target.getAttribute("data-type"),s=a.target.getAttribute("data-id");o==="del"?e.delete("/product_categories/"+s):o==="edit"&&(n.value=!0,i.value=v.categories.filter(({id:x})=>s==x)[0],e.name=i.value.name,f("#modalBtn").click())}),f("#exampleModal").on("hide.bs.modal",function(){n.value&&(n.value=!1,selectedConfig.value=null,e.name="",e.image_path="")})}),(a,o)=>(l(),T(w,null,{default:d(()=>[t("div",O,[U,t("div",$,[b(r(h),{id:"dt",options:{responsive:!0},data:g.categories,columns:[{data:"name"},{data:"image",render:s=>`<img class='img img-fluid lazy' src='/shop/imgs/theme/img_loading.gif' data-src=/storage/${s.url} />`},{data:"products_count"},{data:"created_at",render:s=>new Date(s).toDateString()},{data:null,render:s=>`<button data-type=edit data-id=${s.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${s.id} class='btn btn-sm btn-danger'>Delete</button>`}],class:"display table table-responsive"},{default:d(()=>[F]),_:1},8,["data","columns"])])]),b(A,{title:n.value?"Update Category":"Add Category"},{default:d(()=>[t("form",{onSubmit:E(y,["prevent"])},[t("div",M,[t("div",P,[t("div",V,[j,B(t("input",{type:"text","onUpdate:modelValue":o[0]||(o[0]=s=>r(e).name=s),class:"form-control"},null,512),[[S,r(e).name]]),r(e).errors.name?(l(),c("div",q,u(r(e).errors.name),1)):m("",!0)])])]),t("div",z,[t("div",L,[t("div",G,[H,t("input",{type:"file",onInput:o[1]||(o[1]=s=>r(e).image_path=s.target.files[0]),class:"form-control"},null,32),r(e).errors.image_path?(l(),c("div",J,u(r(e).errors.image_path),1)):m("",!0)]),i.value?(l(),c("img",{key:0,class:"img img-fluid mt-3",width:"200",src:"/storage/"+i.value.image.url},null,8,K)):m("",!0)])]),t("div",Q,[R,t("button",W,u(n.value?"Update":"Save"),1)])],40,I)]),_:1},8,["title"])]),_:1}))}};export{oe as default};
