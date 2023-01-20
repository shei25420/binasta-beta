import{u as f,r as v,o as k,a as c,c as w,w as E,b as e,t as a,k as b,g as d,p as O,F as T,e as l,f as F,v as D,h as y,n as R,i as C}from"./app.431f35f0.js";import{_ as P,a as S}from"./GenericLayout.b87cdd80.js";import"./app.min.421426a6.js";import"./index.15451c4b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const N={class:"card"},j={class:"card-body"},B={class:"invoice"},I={class:"d-md-flex justify-content-between align-items-center mb-4"},q=e("div",{class:"d-md-flex justify-content-between align-items-center"},[e("h4",null,"Invoice"),e("div",null,[e("img",{width:"120",src:S,alt:"logo"})])],-1),A=e("hr",{class:"my-4"},null,-1),X={class:"row"},M={class:"col-md-6"},V=e("p",{class:"text-start"},[e("strong",null,"Bill to")],-1),J={class:"mb-2"},U=e("br",null,null,-1),K={class:"table-responsive",tabindex:"1",style:{overflow:"hidden",outline:"none"}},G={class:"table mb-4 mt-4"},W=e("thead",{class:"thead-light"},[e("tr",null,[e("th",null,"Package"),e("th",{class:"text-end"},"Quantity"),e("th",{class:"text-end"},"Price"),e("th",{class:"text-end"},"Total")])],-1),H={class:"text-start"},L={class:"row"},Y={key:0,class:"col-md-6"},$={class:"accordion accordion-with-radio",id:"accordionExample"},z={class:"accordion-item"},Q={class:"accordion-header",id:"headingOne"},Z=e("div",{class:"form-check"},[e("input",{class:"form-check-input",type:"radio",name:"paymentFlexRadioDefault",id:"paypalFlexRadioDefault"}),e("label",{class:"form-check-label mb-0",for:"paypalFlexRadioDefault"}," Pay with Paypal ")],-1),ee=[Z],te=e("div",{class:"accordion-body"},[e("div",{class:"col-md-12"},[e("img",{width:"50",class:"me-3",src:"#",alt:"..."}),e("div",{id:"paypalContainer",class:"col-sm-12"}),b(" You will be redirected to PayPal website to complete your purchase securely. ")])],-1),oe=[te],se={class:"accordion-item"},ae=e("h2",{class:"accordion-header",id:"headingThree"},[e("button",{class:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseThree","aria-expanded":"false","aria-controls":"collapseThree"},[e("div",{class:"form-check"},[e("input",{class:"form-check-input",type:"radio",name:"paymentFlexRadioDefault",id:"cashOnDeliveryFlexRadioDefault"}),e("label",{class:"form-check-label mb-0",for:"cashOnDeliveryFlexRadioDefault"}," Pay with Mpesa ")])])],-1),ne={id:"collapseThree",class:"accordion-collapse collapse","aria-labelledby":"headingThree","data-bs-parent":"#accordionExample"},re={class:"accordion-body"},le={class:"d-flex align-items-center"},ie={class:"input-group mb-3"},ce=e("div",{class:"input-group-prepend"},[e("span",{style:{padding:"11px"},class:"input-group-text",id:"basic-addon1"},[e("strong",null,"+254")])],-1),de={key:0,class:"invalid-feedback"},pe={class:"form-group"},me=["onClick"],he={class:"col-md-6"},ue={class:"text-end"},_e=e("p",null,"Shipping: Free",-1),ye={class:"fw-bold"},ke={__name:"Invoice",props:{order:Object},setup(i){const u=i,t=f({phone_number:"",payment_type:"mpesa",order_ref:u.order.ref});let p=v(null);const g=f({order_ref:u.order.ref});let m=v(0);const _=r=>{let o=0,n=0,s=r.discounts.length?(100-r.discounts[0].percentage)/100:0;return r.product_options.forEach(h=>{n+=parseFloat(h.price)*parseInt(h.min),o+=parseFloat(h.price)*parseInt(h.min)}),o=s?s*o:o,[o,n]},x=()=>{if(console.log(t.payment_type),t.clearErrors(),p.value=null,!t.phone_number||t.phone_number.trim()==""?t.setError("phone_number","Phone number is required"):t.phone_number.length>9&&t.setError("phone_number","Phone number is invalid. (Hint) Don't start with 0"),(!t.payment_type||t.payment_type.trim()=="")&&t.setError("payment_type","payment type is required"),(!t.order_ref||t.order_ref.trim()=="")&&t.setError("order_ref","Order ref is requireed"),t.errors&&Object.keys(t.errors).length)return;const r=document.getElementById("submitBtn");r.innerText="Making payment....",r.setAttribute("disabled",!0),fetch("/make_payment",{method:"POST",headers:{"Content-Type":"application/json","X-XSRF-TOKEN":decodeURIComponent(document.cookie.split(";").filter(o=>o.startsWith("XSRF-TOKEN="))[0].split("=")[1])},body:JSON.stringify({phone_number:t.phone_number,payment_type:t.payment_type,order_ref:t.order_ref})}).then(o=>o.json()).then(o=>console.log(o)).catch(o=>console.log(o))};return k(()=>{u.order.distributor_packages.forEach(o=>{m.value=_(o)[0],m.value*=o.quantity});let r=document.createElement("script");r.setAttribute("src","https://www.paypal.com/sdk/js?client-id=AaYT0UqlwWovXoGEp6qqBalZR32nG5gDXRVU546jy4_Gv_JrpRAF6fB8xp3gJ7cOTNmHJ-NVhAO4DxIC"),document.head.appendChild(r),r.addEventListener("load",()=>{paypal.Buttons({createOrder:async(o,n)=>fetch("/make_payment",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-XSRF-TOKEN":decodeURIComponent(document.cookie.split(";").filter(s=>s.startsWith("XSRF-TOKEN"))[0].split("=")[1])},body:JSON.stringify({payment_type:t.payment_type,order_ref:t.order_ref})}).then(s=>s.json()).then(s=>s.orderId).catch(s=>console.log("make payment paypal err",s)),onApprove:(o,n)=>{g.transform(s=>({...s,ref:o.orderID})).post("/capture/paypal",{onError:s=>{console.log("paypal capture err",s)}})}}).render("#paypalContainer")})}),(r,o)=>(c(),w(P,null,{default:E(()=>[e("div",N,[e("div",j,[e("div",B,[e("div",I,[e("div",null,"Invoice No : #"+a(i.order.ref),1),e("div",null,"Date: "+a(new Date(i.order.created_at).toDateString()),1)]),q,A,e("div",X,[e("div",M,[V,e("p",J,a(i.order.distributor.first_name)+" "+a(i.order.distributor.last_name),1),e("p",null,[b(a(i.order.location)+", ",1),U,b(a(i.order.phone_number),1)])])]),e("div",K,[e("table",G,[W,e("tbody",null,[(c(!0),d(T,null,O(i.order.distributor_packages,n=>(c(),d("tr",{class:"text-end",key:n.id},[e("td",H,a(n.name),1),e("td",null,a(n.quantity),1),e("td",null,"ksh."+a(_(n)[0]),1),e("td",null,"ksh."+a(_(n)[1]*n.quantity),1)]))),128))])])]),e("div",L,[i.order.status?y("",!0):(c(),d("div",Y,[e("div",$,[e("div",z,[e("h2",Q,[e("button",{class:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseOne","aria-expanded":"false","aria-controls":"collapseOne",onClick:o[0]||(o[0]=()=>l(t).payment_type="paypal")},ee)]),e("div",{id:"collapseOne",class:"accordion-collapse collapse","aria-labelledby":"headingOne","data-bs-parent":"#accordionExample",onClick:o[1]||(o[1]=()=>l(t).payment_type="mpesa")},oe)]),e("div",se,[ae,e("div",ne,[e("div",re,[e("div",le,[e("div",ie,[ce,F(e("input",{type:"text","onUpdate:modelValue":o[2]||(o[2]=n=>l(t).phone_number=n),placeholder:"Enter phone number",class:"form-control"},null,512),[[D,l(t).phone_number]])]),l(t).errors.phone_number?(c(),d("div",de,a(l(t).errors.phone_number),1)):y("",!0),l(p)?(c(),d("div",{key:1,class:R(`alert alert-${l(p).class}`),role:"alert"},[e("strong",null,a(l(p).message),1)],2)):y("",!0)]),e("div",pe,[e("button",{onClick:C(x,["prevent"]),id:"submitBtn",class:"btn btn-primary"},"Make Payment",8,me)])])])])])])),e("div",he,[e("div",ue,[e("p",null,"Sub Total: ksh."+a(l(m)),1),_e,e("h4",ye,"Total: ksh."+a(l(m)),1)])])])])])])]),_:1}))}};export{ke as default};
