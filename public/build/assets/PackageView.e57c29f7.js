import{r as _,o as f,a as d,c as k,w as I,b as t,t as l,k as b,g as u,p as S,F as y,h as w,i as p,e as N}from"./app.431f35f0.js";import{_ as x}from"./GenericLayout.b87cdd80.js";import"./app.min.421426a6.js";import"./index.15451c4b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const O=t("div",{class:"mb-4"},[t("nav",{"aria-label":"breadcrumb"},[t("ol",{class:"breadcrumb"},[t("li",{class:"breadcrumb-item"},[t("a",{href:"#"},[t("i",{class:"bi bi-globe2 small me-2"}),b(" Dashboard ")])]),t("li",{class:"breadcrumb-item active","aria-current":"page"},"Product Detail")])])],-1),C={class:"row"},J={class:"col-md-12"},P={class:"card mb-4"},q={class:"card-body"},B={class:"row"},D={class:"col-md-5"},F={class:"slider-for mb-3"},M=["data-src"],T={class:"col-md-7"},V={class:"d-flex justify-content-between align-items-start mt-4 mt-md-0"},A=t("div",{class:"small text-muted mb-2"},"Distributor Packages",-1),E=t("p",null,[t("span",{class:"badge bg-success"},"In stock")],-1),L=["innerHTML"],j={class:"d-flex gap-3 mb-3 align-items-center"},H={key:0,class:"text-muted mb-0"},z={class:"mb-0"},Q={class:"row row-cols-lg-auto"},R=["onSubmit"],$={class:"col-12"},G={class:"input-group"},K=["onChange"],U=["value"],et={__name:"PackageView",props:{distributor_package:Object},setup(r){const i=r,o=_(1);let c=_(!1);const m=e=>{let a=0,s=0,g=i.distributor_package.discounts.length?(100-i.distributor_package.discounts[0].percentage)/100:0;return e.forEach(n=>{s+=parseFloat(n.price)*parseInt(n.min),a+=parseFloat(n.price)*parseInt(n.min)}),a=g?g*a:a,[a,s]},h=()=>{if(c.value){let e=JSON.parse(localStorage.getItem("cart"));e=e.filter(a=>a.product.id!==i.product.id),localStorage.setItem("cart",JSON.stringify(e)),c.value=!1}else{let e=localStorage.getItem("cart");if(e){if(e=JSON.parse(localStorage.getItem("cart")),e.some(a=>parseInt(a.distributor_package.id)===parseInt(i.distributor_package.id)))return}else e=[];e.push({distributor_package:i.distributor_package,qty:o.value}),localStorage.setItem("cart",JSON.stringify(e)),c.value=!0}},v=e=>{if(o.value=e.target.value,c.value){const a=JSON.parse(localStorage.getItem("cart"));a.forEach(s=>{parseInt(s.distributor_package.id)===parseInt(i.distributor_package.id)&&(s.qty=o.value)}),localStorage.setItem("cart",JSON.stringify(a))}};return f(()=>{const e=localStorage.getItem("cart")?JSON.parse(localStorage.getItem("cart")):null;e&&(c.value=e.some(a=>parseInt(a.distributor_package.id)===parseInt(i.distributor_package.id)?(o.value=a.qty,!0):!1))}),(e,a)=>(d(),k(x,null,{default:I(()=>[O,t("div",C,[t("div",J,[t("div",P,[t("div",q,[t("div",B,[t("div",D,[t("div",F,[t("img",{src:"/shop/imgs/theme/img_loading.gif","data-src":"/storage/"+r.distributor_package.image_path,class:"lazy w-100 rounded",alt:"image"},null,8,M)])]),t("div",T,[t("div",V,[t("div",null,[A,t("h2",null,l(r.distributor_package.name),1),E,t("p",{innerHTML:r.distributor_package.description},null,8,L),t("p",null,[b(" Package Contents: "),t("ul",null,[(d(!0),u(y,null,S(r.distributor_package.product_options,s=>(d(),u("li",{key:s.id},l(s.product.name)+" - "+l(s.variation),1))),128))])]),t("div",j,[r.distributor_package.discounts.length?(d(),u("h4",H,[t("del",null,"ksh."+l(m(r.distributor_package.product_options)[0]*o.value),1)])):w("",!0),t("h4",z,"ksh."+l(m(r.distributor_package.product_options)[1]*o.value),1)]),t("div",Q,[t("form",{onSubmit:p(h,["prevent"])},[t("div",$,[t("div",G,[t("input",{type:"number",class:"form-control",min:"0",onChange:p(v,["prevent"]),value:1},null,40,K),t("input",{class:"btn btn-primary",type:"submit",value:N(c)?"Remove from cart":"Add to cart"},null,8,U)])])],40,R)])])])])])])])])])]),_:1}))}};export{et as default};
