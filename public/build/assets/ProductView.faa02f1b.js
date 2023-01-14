import{u as S,r as h,o as N,$ as g,a,c as B,w as m,b as e,g as l,D as f,F as y,t as n,d as w,e as i,f as _,v as p,h as b,i as E,k as P}from"./app.1ac5e0b9.js";import{e as k,D as T}from"./dataTables.bootstrap5.b1186638.js";import"./dataTables.responsive.219a163f.js";import{_ as F}from"./GenericLayout.1e147c90.js";import{_ as U}from"./ModalComponent.d806c712.js";import"./app.min.11b0299a.js";import"./_plugin-vue_export-helper.cdc0426e.js";const I={class:"row"},M={class:"col-md-12"},D={class:"card mb-4"},q={class:"card-body"},A={class:"row"},O={class:"col-md-5"},$=["data-src"],C={class:"col-md-7"},L={class:"d-flex justify-content-between align-items-start mt-4 mt-md-0"},W={class:"small text-muted mb-2"},j={key:0,class:"badge bg-success"},R={key:1,class:"badge badge-danger"},H=["innerHTML"],z={class:"card"},G={class:"card-header"},J={class:"nav nav-pills",role:"tablist"},K=e("li",{class:"nav-item"},[e("a",{class:"nav-link active",id:"description-tab","data-bs-toggle":"tab",href:"#description",role:"tab","aria-controls":"description","aria-selected":"true"},"Product Variations")],-1),Q={class:"nav-item"},X={class:"nav-link",id:"sss-tab","data-bs-toggle":"tab",href:"#sss",role:"tab","aria-controls":"sss","aria-selected":"false"},Y={class:"card-body"},Z={class:"tab-content"},ee={class:"tab-pane fade show active",id:"description",role:"tabpanel","aria-labelledby":"description-tab"},te=e("button",{type:"button",id:"modalBtn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",class:"btn btn-sm mb-2 btn-icon btn-primary"},[e("i",{class:"bi bi-plus-circle"}),P(" Add Variation ")],-1),se=e("thead",null,[e("tr",null,[e("th",null,"Variation"),e("th",null,"Buying Price"),e("th",null,"Selling Price"),e("th",null,"Wholesale Price"),e("th",null,"Sold"),e("th",null,"Stock"),e("th",null,"Created At"),e("th",null,"Actions")])],-1),ie={class:"tab-pane fade",id:"sss",role:"tabpanel","aria-labelledby":"sss-tab"},oe={class:"row"},ae={class:"col-lg-8"},le=e("div",{class:"mb-5"},[e("div",{class:"display-6"},"4.0"),e("div",{class:"d-flex gap-2 my-3"},[e("i",{class:"bi bi-star-fill icon-lg text-warning"}),e("i",{class:"bi bi-star-fill icon-lg text-warning"}),e("i",{class:"bi bi-star-fill icon-lg text-warning"}),e("i",{class:"bi bi-star-fill icon-lg text-warning"}),e("i",{class:"bi bi-star-fill icon-lg text-muted"}),e("span",null,"(3)")])],-1),re={class:"list-group list-group-flush mb-4"},ne=e("div",{class:"avatar flex-shrink-0 me-3"},[e("span",{class:"avatar-text bg-purple rounded-circle"},"R")],-1),de=e("h5",{class:"mb-1"},"Rodger Stutely",-1),ce=e("div",{class:"d-flex gap-2 mb-3"},[e("i",{class:"bi bi-star-fill text-warning"}),e("i",{class:"bi bi-star-fill text-warning"}),e("i",{class:"bi bi-star-fill text-warning"}),e("i",{class:"bi bi-star-fill text-warning"}),e("i",{class:"bi bi-star-fill text-muted"})],-1),ue=["onSubmit"],_e={class:"row"},pe={class:"col"},be={class:"form-group"},me=e("label",{for:"Variation"},"Variation",-1),ve={key:0,class:"invalid-feedback"},he={class:"col"},ge={class:"form-group"},fe=e("label",{for:"Variation"},"Stock",-1),ye={key:0,class:"invalid-feedback"},we={class:"row mt-3"},ke={class:"col"},xe={class:"form-group"},Ve=e("label",{for:"Buying Price"},"Buying Price",-1),Se={key:0,class:"invalid-feedback"},Ne={class:"col"},Be={class:"form-group"},Ee=e("label",{for:"Selling Price"},"Selling Price",-1),Pe={key:0,class:"invalid-feedback"},Te={class:"row mt-3"},Fe={class:"col"},Ue={class:"form-group"},Ie=e("label",{for:"Selling Price"},"Wholesale Price",-1),Me={key:0,class:"invalid-feedback"},De={class:"col"},qe={class:"form-group"},Ae=e("label",{for:"Wholesale Mininum"},"Wholesale Minimum",-1),Oe={key:0,class:"invalid-feedback"},$e={class:"row mt-4"},Ce={class:"col"},Le=e("button",{type:"button",class:"btn btn-danger",style:{"margin-right":"10px"},"data-bs-dismiss":"modal"},"Close",-1),We={id:"submitBtn",type:"submit",class:"btn btn-primary"},Qe={__name:"ProductView",props:{product:Object},setup(c){const v=c;k.use(T);const t=S({variation:"",buying_price:0,selling_price:0,wholesale_price:0,wholesale_min:1,stock:0,product_id:v.product.id}),u=h(!1),r=h(null),x=()=>{if(t.clearErrors(),(!t.variation||t.variation.trim()=="")&&t.setError("variation","variation field is required"),(!t.buying_price||parseFloat(t.buying_price)===NaN)&&t.setError("buying_price","buying price field is requried"),(!t.selling_price||parseFloat(t.selling_price)===NaN)&&t.setError("selling_price","selling price field is required"),(!t.wholesale_price||parseFloat(t.wholesale_price)===NaN)&&t.setError("wholesale_price","whole sale price is required"),(!t.wholesale_min||parseInt(t.wholesale_min)===NaN)&&t.setError("wholesale minimum field is required"),(!t.stock||parseInt(t.stock)===NaN)&&t.setError("stock","stock field is required"),(!t.product_id||parseInt(t.product_id)===NaN)&&t.setError("product_id","product field is required"),t.errors&&Object.keys(t.errors).length)return;const d=document.getElementById("submitBtn");u.value?(d.innerText="Updating...",t.put(`/product_options/${r.value.id}`,{onSuccess(){u.value=!1,r.value=null,t.reset(),d.innerText="Save"},onError(){d.innerText="Update"}})):(d.innerText="Saving...",t.post("/product_options",{onSuccess(){t.reset()},onFinish(){d.innerText="Save"}}))};return N(()=>{document.getElementById("dt").addEventListener("click",function(d){if(d.target.nodeName!=="BUTTON")return;const o=parseInt(d.target.getAttribute("data-id")),s=d.target.getAttribute("data-type");s==="del"?confirm("Are you sure you want to delete this product variation?")&&t.delete(`/product_options/${o}`):s==="edit"&&(r.value=v.product.product_options.filter(({id:V})=>V==o)[0],t.variation=r.value.variation,t.buying_price=parseFloat(r.value.buying_price),t.selling_price=parseFloat(r.value.selling_price),t.wholesale_price=parseFloat(r.value.wholesale_price),t.wholesale_min=parseInt(r.value.wholesale_min),t.stock=parseInt(r.value.stock),t.product_id=parseInt(r.value.product_id),u.value=!0,g("#modalBtn").click())}),g("#exampleModal").on("hide.bs.modal",function(){u.value&&(t.reset(),u.value=!1,r.value=null)})}),(d,o)=>(a(),B(F,null,{default:m(()=>[e("div",I,[e("div",M,[e("div",D,[e("div",q,[e("div",A,[e("div",O,[(a(!0),l(y,null,f(c.product.images,s=>(a(),l("div",{key:s.id,class:"slider mb-3"},[e("img",{src:"/shop/imgs/theme/img_loading.gif","data-src":"/storage/"+s.url,class:"w-100 rounded lazy",alt:"image"},null,8,$)]))),128))]),e("div",C,[e("div",L,[e("div",null,[e("div",W,n(c.product.category_name),1),e("h2",null,n(c.product.name),1),e("p",null,[c.product.stock?(a(),l("span",j,"In stock")):(a(),l("span",R,"Out Of Stock"))]),e("p",{innerHTML:c.product.description},null,8,H),e("div",z,[e("div",G,[e("ul",J,[K,e("li",Q,[e("a",X,"Customer Reviews ("+n(c.product.user_reviews.length)+")",1)])])]),e("div",Y,[e("div",Z,[e("div",ee,[te,w(i(k),{id:"dt",class:"display table table-responsive",options:{responsive:!0},data:c.product.product_options,columns:[{data:"variation"},{data:"buying_price"},{data:"selling_price"},{data:"wholesale_price"},{data:"sold"},{data:"stock"},{data:"created_at",render:s=>new Date(s).toDateString()},{data:null,render:s=>`<button data-type=edit data-id=${s.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${s.id} class='btn btn-sm btn-danger'>Delete</button>`}]},{default:m(()=>[se]),_:1},8,["data","columns"])]),e("div",ie,[e("div",oe,[e("div",ae,[le,e("div",re,[(a(!0),l(y,null,f(c.product.user_reviews,s=>(a(),l("div",{class:"list-group-item d-flex px-0",key:s.id},[ne,e("div",null,[de,ce,e("div",null,n(s.review),1)])]))),128))])])])])])])])])])])])])])])]),w(U,{title:u.value?"Update Variation":"Add Variation"},{default:m(()=>[e("form",{onSubmit:E(x,["prevent"])},[e("div",_e,[e("div",pe,[e("div",be,[me,_(e("input",{"onUpdate:modelValue":o[0]||(o[0]=s=>i(t).variation=s),type:"text",class:"form-control"},null,512),[[p,i(t).variation]]),i(t).errors.variation?(a(),l("div",ve,n(i(t).errors.variation),1)):b("",!0)])]),e("div",he,[e("div",ge,[fe,_(e("input",{"onUpdate:modelValue":o[1]||(o[1]=s=>i(t).stock=s),type:"text",class:"form-control"},null,512),[[p,i(t).stock]]),i(t).errors.stock?(a(),l("div",ye,n(i(t).errors.stock),1)):b("",!0)])])]),e("div",we,[e("div",ke,[e("div",xe,[Ve,_(e("input",{type:"text","onUpdate:modelValue":o[2]||(o[2]=s=>i(t).buying_price=s),class:"form-control"},null,512),[[p,i(t).buying_price]]),i(t).errors.buying_price?(a(),l("div",Se,n(i(t).errors.buying_price),1)):b("",!0)])]),e("div",Ne,[e("div",Be,[Ee,_(e("input",{type:"text","onUpdate:modelValue":o[3]||(o[3]=s=>i(t).selling_price=s),class:"form-control"},null,512),[[p,i(t).selling_price]]),i(t).errors.selling_price?(a(),l("div",Pe,n(i(t).errors.selling_price),1)):b("",!0)])])]),e("div",Te,[e("div",Fe,[e("div",Ue,[Ie,_(e("input",{type:"text","onUpdate:modelValue":o[4]||(o[4]=s=>i(t).wholesale_price=s),class:"form-control"},null,512),[[p,i(t).wholesale_price]]),i(t).errors.wholesale_price?(a(),l("div",Me,n(i(t).errors.wholesale_price),1)):b("",!0)])]),e("div",De,[e("div",qe,[Ae,_(e("input",{type:"text","onUpdate:modelValue":o[5]||(o[5]=s=>i(t).wholesale_min=s),class:"form-control"},null,512),[[p,i(t).wholesale_min]]),i(t).errors.wholesale_min?(a(),l("div",Oe,n(i(t).errors.wholesale_min),1)):b("",!0)])])]),e("div",$e,[e("div",Ce,[Le,e("button",We,n(u.value?"Update":"Save"),1)])])],40,ue)]),_:1},8,["title"])]),_:1}))}};export{Qe as default};
