import{r as p,o as y,$ as m,a as l,c as I,w,b as t,g as d,D as b,F as h,t as n,k as v,h as N,i as f,e as x}from"./app.ccec1e18.js";import{_ as C}from"./GenericLayout.8882146b.js";import"./slick.9cd918fd.js";import"./app.min.c51efb0b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const O=t("div",{class:"mb-4"},[t("nav",{"aria-label":"breadcrumb"},[t("ol",{class:"breadcrumb"},[t("li",{class:"breadcrumb-item"},[t("a",{href:"#"},[t("i",{class:"bi bi-globe2 small me-2"}),v(" Dashboard ")])]),t("li",{class:"breadcrumb-item active","aria-current":"page"},"Product Detail")])])],-1),T={class:"row"},F={class:"col-md-12"},J={class:"card mb-4"},P={class:"card-body"},q={class:"row"},B={class:"col-md-5"},D={class:"slider-for mb-3"},V=["src"],A={class:"slider-nav"},E=["src"],L={class:"col-md-7"},M={class:"d-flex justify-content-between align-items-start mt-4 mt-md-0"},j=t("div",{class:"small text-muted mb-2"},"Technology Products",-1),$=t("p",null,[t("span",{class:"badge bg-success"},"In stock")],-1),Q=t("p",null,"Features:",-1),R=t("p",null,"It is a long established fact that a reader will be distracted. Contrary to popular belief, Lorem Ipsum is not text. There are many variations of passages of Lorem.",-1),z={class:"d-flex gap-3 mb-3 align-items-center"},G={key:0,class:"text-muted mb-0"},H={class:"mb-0"},K={class:"row row-cols-lg-auto"},U=["onSubmit"],W={class:"col-12"},X={class:"input-group"},Y=["onChange"],Z=["value"],ot={__name:"PackageView",props:{distributor_package:Object},setup(r){const o=r,i=p(1);let c=p(!1);const _=e=>{let s=0,a=0,g=o.distributor_package.discounts.length?(100-o.distributor_package.discounts[0].percentage)/100:0;return e.forEach(u=>{a+=parseFloat(u.price)*parseInt(u.min),s+=parseFloat(u.price)*parseInt(u.min)}),s=g?g*s:s,[s,a]},k=()=>{if(c.value){let e=JSON.parse(localStorage.getItem("cart"));e=e.filter(s=>s.product.id!==o.product.id),localStorage.setItem("cart",JSON.stringify(e)),c.value=!1}else{let e=localStorage.getItem("cart");if(e){if(e=JSON.parse(localStorage.getItem("cart")),e.some(s=>parseInt(s.distributor_package.id)===parseInt(o.distributor_package.id)))return}else e=[];e.push({distributor_package:o.distributor_package,qty:i.value}),localStorage.setItem("cart",JSON.stringify(e)),c.value=!0}},S=e=>{if(e?i.value++:i.value>1&&i.value--,c.value){const s=JSON.parse(localStorage.getItem("cart"));s.forEach(a=>{parseInt(a.distributor_package.id)===parseInt(o.distributor_package.id)&&(a.qty=i.value)}),localStorage.setItem("cart",JSON.stringify(s))}};return y(()=>{const e=localStorage.getItem("cart")?JSON.parse(localStorage.getItem("cart")):null;e&&(c.value=e.some(s=>parseInt(s.distributor_package.id)===parseInt(o.distributor_package.id)?(i.value=s.qty,!0):!1)),m(".slider-for").slick({slidesToShow:1,slidesToScroll:1,arrows:!0,fade:!0,asNavFor:".slider-nav",rtl:!!m("body").hasClass("rtl")}),m(".slider-nav").slick({slidesToShow:3,slidesToScroll:1,asNavFor:".slider-for",dots:!1,centerMode:!0,centerPadding:"60px",focusOnSelect:!0,rtl:!!m("body").hasClass("rtl")})}),(e,s)=>(l(),I(C,null,{default:w(()=>[O,t("div",T,[t("div",F,[t("div",J,[t("div",P,[t("div",q,[t("div",B,[t("div",D,[t("img",{src:"/storage/"+r.distributor_package.product_options[0].product.images[0].url,class:"w-100 rounded",alt:"image"},null,8,V)]),t("div",A,[(l(!0),d(h,null,b(r.distributor_package.product_options,a=>(l(),d("img",{key:a.id,src:"/storage/"+a.product.images[0].url,class:"w-100 rounded",alt:"image"},null,8,E))),128))])]),t("div",L,[t("div",M,[t("div",null,[j,t("h2",null,n(r.distributor_package.name),1),$,Q,R,t("p",null,[v(" Package Contents: "),t("ul",null,[(l(!0),d(h,null,b(r.distributor_package.product_options,a=>(l(),d("li",{key:a.id},n(a.product.name)+" - "+n(a.variation),1))),128))])]),t("div",z,[r.distributor_package.discounts.length?(l(),d("h4",G,[t("del",null,"ksh."+n(_(r.distributor_package.product_options)[0]),1)])):N("",!0),t("h4",H,"ksh."+n(_(r.distributor_package.product_options)[1]),1)]),t("div",K,[t("form",{onSubmit:f(k,["prevent"])},[t("div",W,[t("div",X,[t("input",{type:"number",class:"form-control",min:"0",onChange:f(S,["prevent"]),value:1},null,40,Y),t("input",{class:"btn btn-primary",type:"submit",value:x(c)?"Remove from cart":"Add to cart"},null,8,Z)])])],40,U)])])])])])])])])])]),_:1}))}};export{ot as default};