import{_ as u}from"./img_loading.2f197810.js";import{_ as m}from"./banner-11.e7d7d167.js";import{a,c as g,w as c,b as s,k as e,t as o,g as i,D as _,d as l,e as d,L as n,h,F as p}from"./app.1ac5e0b9.js";import{_ as v}from"./ShopLayout.4b5df1c1.js";import"./flogo.b45e8d3c.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./icon-youtube-white.12f5965b.js";const f=s("div",{class:"page-header mt-30 mb-50"},[s("div",{class:"container"},[s("div",{class:"archive-header"},[s("div",{class:"row align-items-center"},[s("div",{class:"col-xl-3"},[s("h1",{class:"mb-15"},"Snack"),s("div",{class:"breadcrumb"},[s("a",{href:"index.html",rel:"nofollow"},[s("i",{class:"fi-rs-home mr-5"}),e("Home")]),s("span"),e(" Shop "),s("span"),e(" Snack ")])])])])])],-1),b={class:"container mb-30",style:{transform:"none"}},w={class:"row",style:{transform:"none"}},y={class:"col-lg-4-5"},k={class:"shop-product-fillter"},x={class:"totall-product"},S={class:"text-brand"},V={class:"row product-grid"},D={class:"product-cart-wrap mb-30 wow animate__ animate__fadeIn animated","data-wow-delay":".1s",style:{visibility:"visible","animation-delay":"0.1s","animation-name":"fadeIn"}},A={class:"product-img-action-wrap"},B={class:"product-img product-img-zoom"},N=["data-src"],z=["src"],C={class:"product-badges product-badges-position product-badges-mrg"},I={key:0,class:"sale"},L={class:"product-content-wrap"},O={class:"product-category"},F={href:"shop-grid-right.html"},T={class:"product-card-bottom"},$={class:"product-price"},E={key:0,class:"old-price"},H={class:"add-cart"},J=s("i",{class:"fi-rs-shopping-cart mr-5"},null,-1),P={key:0,class:"section-padding pb-5"},W=s("div",{class:"section-title"},[s("h3",{class:""},"Deals Of The Day"),s("a",{class:"show-all",href:"shop-grid-right.html"},[e(" All Deals "),s("i",{class:"fi-rs-angle-right"})])],-1),j={class:"row"},q={class:"product-cart-wrap style-2"},G={class:"product-img-action-wrap"},K={class:"product-img"},M=["src"],Q={class:"product-content-wrap"},R={class:"deals-countdown-wrap"},U=["data-countdown"],X={class:"deals-content"},Y={class:"product-card-bottom"},Z={class:"product-price"},ss={class:"old-price"},ts={class:"add-cart"},es=s("i",{class:"fi-rs-shopping-cart mr-5"},null,-1),os={class:"col-lg-1-5 primary-sidebar sticky-sidebar",style:{position:"relative",overflow:"visible","box-sizing":"border-box","min-height":"1px"}},as={class:"theiaStickySidebar",style:{"padding-top":"0px","padding-bottom":"1px",position:"static",transform:"none",top:"0px",left:"12.0156px"}},is={class:"sidebar-widget widget-category-2 mb-30"},cs=s("h5",{class:"section-title style-1 mb-30"}," Category ",-1),ls={href:"shop-grid-right.html"},ds=["src","alt"],ns={class:"count"},rs=s("div",{class:"banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none animated",style:{visibility:"visible"}},[s("img",{src:m,alt:""}),s("div",{class:"banner-text"},[s("span",null,"Oganic"),s("h4",null,[e(" Save 17% "),s("br"),e(" on "),s("span",{class:"text-brand"},"Oganic"),s("br"),e(" Juice ")])])],-1),ws={__name:"Products",props:{categories:Array,products:Array,discounts:Array},setup(r){return(_s,hs)=>(a(),g(v,null,{default:c(()=>[f,s("div",b,[s("div",w,[s("div",y,[s("div",k,[s("div",x,[s("p",null,[e(" We found "),s("strong",S,o(r.products.length),1),e(" items for you! ")])])]),s("div",V,[(a(!0),i(p,null,_(r.products,t=>(a(),i("div",{class:"col-lg-1-5 col-md-4 col-12 col-sm-6",key:t.id},[s("div",D,[s("div",A,[s("div",B,[l(d(n),{href:"/products/"+t.slug},{default:c(()=>[s("img",{class:"default-img lazy",src:u,"data-src":"/storage/"+t.images[0].url,alt:""},null,8,N),s("img",{class:"hover-img",src:"/storage/"+t.images[0].url,alt:""},null,8,z)]),_:2},1032,["href"])]),s("div",C,[t.discounts.length?(a(),i("span",I,"-"+o(t.discounts[0].percentage)+"%",1)):h("",!0)])]),s("div",L,[s("div",O,[s("a",F,o(t.product_category.name),1)]),s("h2",null,[l(d(n),{href:"/products/"+t.slug},{default:c(()=>[e(o(t.name),1)]),_:2},1032,["href"])]),s("div",T,[s("div",$,[s("span",null,"ksh."+o(t.discounts.length?(100-t.discounts[0].percentage)/100*t.product_options[0].selling_price:t.product_options[0].selling_price),1),t.discounts.length?(a(),i("span",E,"$"+o(t.product_options[0].selling_price),1)):h("",!0)]),s("div",H,[l(d(n),{class:"add",href:"/products/"+t.slug},{default:c(()=>[J,e("View ")]),_:2},1032,["href"])])])])])]))),128))]),r.discounts.length?(a(),i("section",P,[W,s("div",j,[(a(!0),i(p,null,_(r.discounts,t=>(a(),i("div",{class:"col-xl-3 col-lg-4 col-md-6",key:t.id},[s("div",q,[s("div",G,[s("div",K,[l(d(n),{href:"/products/"+t.product.slug},{default:c(()=>[s("img",{src:"/storage/"+t.product.images[0].url,alt:""},null,8,M)]),_:2},1032,["href"])])]),s("div",Q,[s("div",R,[s("div",{class:"deals-countdown","data-countdown":t.end_date},null,8,U)]),s("div",X,[s("h2",null,[l(d(n),{href:"/products/"+t.product.slug},{default:c(()=>[e(o(t.product.name),1)]),_:2},1032,["href"])]),s("div",Y,[s("div",Z,[s("span",null,"ksh."+o((100-t.percentage)/100*t.product.product_options[0].selling_price),1),s("span",ss,"ksh."+o(t.product.product_options[0].selling_price),1)]),s("div",ts,[l(d(n),{class:"add",href:"/products/"+t.product.slug},{default:c(()=>[es,e("View ")]),_:2},1032,["href"])])])])])])]))),128))])])):h("",!0)]),s("div",os,[s("div",as,[s("div",is,[cs,s("ul",null,[(a(!0),i(p,null,_(r.categories,t=>(a(),i("li",{key:t.id},[s("a",ls,[s("img",{src:"/storage/"+t.image.url,alt:t.name},null,8,ds),e(o(t.name),1)]),s("span",ns,o(t.products_count),1)]))),128))])]),rs])])])])]),_:1}))}};export{ws as default};
