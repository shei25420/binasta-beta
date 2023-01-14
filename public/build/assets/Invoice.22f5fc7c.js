import{r as u,u as v,o as b,a as h,c as x,w as g,b as e,t as s,k as d,g as y,D as w,F,e as f}from"./app.1ac5e0b9.js";import{_ as D}from"./GenericLayout.1e147c90.js";import"./app.min.11b0299a.js";import"./_plugin-vue_export-helper.cdc0426e.js";const O={class:"card"},T={class:"card-body"},k={class:"invoice"},E={class:"d-md-flex justify-content-between align-items-center mb-4"},R=e("div",{class:"d-md-flex justify-content-between align-items-center"},[e("h4",null,"Invoice"),e("div",null,[e("img",{width:"120",src:"#",alt:"logo"})])],-1),P=e("hr",{class:"my-4"},null,-1),I={class:"row"},S={class:"col-md-6"},j=e("p",{class:"text-start"},[e("strong",null,"Bill to")],-1),A={class:"mb-2"},B=e("br",null,null,-1),N={class:"table-responsive",tabindex:"1",style:{overflow:"hidden",outline:"none"}},C={class:"table mb-4 mt-4"},q=e("thead",{class:"thead-light"},[e("tr",null,[e("th",null,"Package"),e("th",{class:"text-end"},"Quantity"),e("th",{class:"text-end"},"Price"),e("th",{class:"text-end"},"Total")])],-1),X={class:"text-start"},J={class:"row"},V=e("div",{class:"col-md-6"},[e("div",{class:"accordion accordion-with-radio",id:"accordionExample"},[e("div",{class:"accordion-item"},[e("h2",{class:"accordion-header",id:"headingOne"},[e("button",{class:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseOne","aria-expanded":"false","aria-controls":"collapseOne"},[e("div",{class:"form-check"},[e("input",{class:"form-check-input",type:"radio",name:"paymentFlexRadioDefault",id:"paypalFlexRadioDefault"}),e("label",{class:"form-check-label mb-0",for:"paypalFlexRadioDefault"}," Pay with Paypal ")])])]),e("div",{id:"collapseOne",class:"accordion-collapse collapse","aria-labelledby":"headingOne","data-bs-parent":"#accordionExample"},[e("div",{class:"accordion-body"},[e("div",{class:"col-md-12"},[e("img",{width:"50",class:"me-3",src:"#",alt:"..."}),e("div",{id:"paypalContainer",class:"col-sm-12"}),d(" You will be redirected to PayPal website to complete your purchase securely. ")])])])]),e("div",{class:"accordion-item"},[e("h2",{class:"accordion-header",id:"headingThree"},[e("button",{class:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseThree","aria-expanded":"false","aria-controls":"collapseThree"},[e("div",{class:"form-check"},[e("input",{class:"form-check-input",type:"radio",name:"paymentFlexRadioDefault",id:"cashOnDeliveryFlexRadioDefault"}),e("label",{class:"form-check-label mb-0",for:"cashOnDeliveryFlexRadioDefault"}," Pay with Mpesa ")])])]),e("div",{id:"collapseThree",class:"accordion-collapse collapse","aria-labelledby":"headingThree","data-bs-parent":"#accordionExample"},[e("div",{class:"accordion-body"},[e("div",{class:"d-flex align-items-center"},[e("img",{width:"50",class:"me-3",src:"#",alt:"..."}),d(" Pay with cash when your order is delivered. ")])])])])])],-1),G={class:"col-md-6"},U={class:"text-end"},K=e("p",null,"Shipping: Free",-1),L={class:"fw-bold"},Q={__name:"Invoice",props:{order:Object},setup(l){const i=l,m=u({payment_type:"paypal",order_ref:i.order.ref}),_=v({order_ref:i.order.ref});let r=u(0);const p=c=>{let t=0,o=0,a=c.discounts.length?(100-c.discounts[0].percentage)/100:0;return c.product_options.forEach(n=>{console.log(n),o+=parseFloat(n.price)*parseInt(n.min),t+=parseFloat(n.price)*parseInt(n.min)}),t=a?a*t:t,[t,o]};return b(()=>{i.order.distributor_packages.forEach(t=>{r.value=p(t)[0],r.value*=t.quantity});let c=document.createElement("script");c.setAttribute("src","https://www.paypal.com/sdk/js?client-id=AaYT0UqlwWovXoGEp6qqBalZR32nG5gDXRVU546jy4_Gv_JrpRAF6fB8xp3gJ7cOTNmHJ-NVhAO4DxIC"),document.head.appendChild(c),c.addEventListener("load",()=>{paypal.Buttons({createOrder:async(t,o)=>fetch("/make_payment",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json","X-XSRF-TOKEN":decodeURIComponent(document.cookie.split(";").filter(a=>a.startsWith("XSRF-TOKEN"))[0].split("=")[1])},body:JSON.stringify({payment_type:m.value.payment_type,order_ref:m.value.order_ref})}).then(a=>a.json()).then(a=>a.orderId).catch(a=>console.log("make payment paypal err",a)),onApprove:(t,o)=>{_.transform(a=>({...a,ref:t.orderID})).post("/capture/paypal",{onError:a=>{console.log("paypal capture err",a)}})}}).render("#paypalContainer")})}),(c,t)=>(h(),x(D,null,{default:g(()=>[e("div",O,[e("div",T,[e("div",k,[e("div",E,[e("div",null,"Invoice No : #"+s(l.order.ref),1),e("div",null,"Date: "+s(new Date(l.order.created_at).toDateString()),1)]),R,P,e("div",I,[e("div",S,[j,e("p",A,s(l.order.distributor.first_name)+" "+s(l.order.distributor.last_name),1),e("p",null,[d(s(l.order.location)+", ",1),B,d(s(l.order.phone_number),1)])])]),e("div",N,[e("table",C,[q,e("tbody",null,[(h(!0),y(F,null,w(l.order.distributor_packages,o=>(h(),y("tr",{class:"text-end",key:o.id},[e("td",X,s(o.name),1),e("td",null,s(o.quantity),1),e("td",null,"ksh."+s(p(o)[0]),1),e("td",null,"ksh."+s(p(o)[1]*o.quantity),1)]))),128))])])]),e("div",J,[V,e("div",G,[e("div",U,[e("p",null,"Sub Total: ksh."+s(f(r)),1),K,e("h4",L,"Total: ksh."+s(f(r)),1)])])])])])])]),_:1}))}};export{Q as default};
