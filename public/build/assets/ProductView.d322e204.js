import{r as k,o as q,$ as w,a as i,c as z,w as p,b as s,d as v,k as d,e as m,L as g,t as a,g as l,D as f,F as b,h as x,n as N,i as y}from"./app.1ac5e0b9.js";import{_ as O}from"./img_loading.2f197810.js";import{u as V,_ as $}from"./ShopLayout.4b5df1c1.js";import"./flogo.b45e8d3c.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./icon-youtube-white.12f5965b.js";const A={class:"page-header breadcrumb-wrap"},B={class:"container"},L={class:"breadcrumb"},M=s("i",{class:"fi-rs-home mr-5"},null,-1),F=s("span",null,null,-1),H=s("span",null,null,-1),E={class:"container mb-30",style:{transform:"none"}},D={class:"row",style:{transform:"none"}},J={class:"col-xl-11 col-lg-12 m-auto",style:{transform:"none"}},Q={class:"row",style:{transform:"none"}},R={class:"col-xl-9"},W={class:"product-detail accordion-detail"},j={class:"row mb-50 mt-30"},P={class:"col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5"},G={class:"detail-gallery"},K=s("span",{class:"zoom-icon"},[s("i",{class:"fi-rs-search"})],-1),U={class:"product-image-slider"},X=["data-src"],Y={class:"col-md-6 col-sm-12 col-xs-12"},Z={class:"detail-info pr-30 pl-30"},ss={key:0,class:"stock-status out-stock"},ts={class:"title-detail"},es={class:"clearfix product-price-cover"},os={class:"product-price primary-color float-left"},as={class:"current-price text-brand"},is={key:0},ls={class:"save-price font-md color3 ml-15"},cs={class:"old-price font-md ml-15"},ns={class:"short-desc mb-30"},ds=["innerHTML"],rs={class:"attr-detail attr-size mb-30"},us=s("strong",{class:"mr-10"},"Size / Weight: ",-1),hs={class:"list-filter size-filter font-small"},_s=["onClick"],ps={class:"detail-extralink mb-50"},ms={class:"detail-qty border radius"},vs=s("i",{class:"fi-rs-angle-small-down"},null,-1),gs=[vs],fs=["value"],bs=s("i",{class:"fi-rs-angle-small-up"},null,-1),ys=[bs],ks={class:"product-extra-link2"},ws=["onClick"],xs=s("i",{class:"fi-rs-shopping-cart"},null,-1),Ss={class:"font-xs"},Cs={class:"mr-50 float-start"},Is={class:"mb-5"},Ts={class:"text-brand"},qs={key:0,class:"row mt-60"},zs=s("div",{class:"col-12"},[s("h2",{class:"section-title style-1 mb-30"},"Related products")],-1),Ns={class:"col-12"},Os={class:"row related-products"},Vs={class:"product-cart-wrap hover-up"},$s={class:"product-img-action-wrap"},As={class:"product-img product-img-zoom"},Bs=["src"],Ls=["src"],Ms=s("div",{class:"product-action-1"},[s("a",{"aria-label":"Quick view",class:"action-btn small hover-up","data-bs-toggle":"modal","data-bs-target":"#quickViewModal"},[s("i",{class:"fi-rs-search"})]),s("a",{"aria-label":"Add To Wishlist",class:"action-btn small hover-up",href:"shop-wishlist.html",tabindex:"0"},[s("i",{class:"fi-rs-heart"})]),s("a",{"aria-label":"Compare",class:"action-btn small hover-up",href:"shop-compare.html",tabindex:"0"},[s("i",{class:"fi-rs-shuffle"})])],-1),Fs=s("div",{class:"product-badges product-badges-position product-badges-mrg"},[s("span",{class:"hot"},"Hot")],-1),Hs={class:"product-content-wrap"},Es={href:"shop-product-right.html",tabindex:"0"},Ds=s("div",{class:"rating-result",title:"90%"},[s("span")],-1),Js={class:"product-price"},Qs=s("span",{class:"old-price"},"$245.8",-1),Rs={class:"col-xl-3 primary-sidebar sticky-sidebar mt-30",style:{position:"relative",overflow:"visible","box-sizing":"border-box","min-height":"1px"}},Ws={class:"theiaStickySidebar",style:{"padding-top":"0px","padding-bottom":"1px",position:"static",transform:"none"}},js={class:"sidebar-widget widget-category-2 mb-30"},Ps=s("h5",{class:"section-title style-1 mb-30"},"Category",-1),Gs=["src"],Ks={class:"count"},Us=s("div",{class:"banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none",style:{visibility:"hidden","animation-name":"none"}},[s("img",{src:"/assets/imgs/banner/banner-11.png",alt:""}),s("div",{class:"banner-text"},[s("span",null,"Oganic"),s("h4",null,[d(" Save 17% "),s("br"),d(" on "),s("span",{class:"text-brand"},"Oganic"),s("br"),d(" Juice ")])])],-1),it={__name:"ProductView",props:{product:Object,related:Array,categories:Array},emits:["addItem"],setup(e,{emit:Xs}){const u=e,r=V("cart",[]),c=k(1),h=k(u.product.product_options[0]);let _=k(!1);const C=()=>{if(_.value)r.value=r.value.filter(o=>o.product.id!==u.product.id),_.value=!1;else{if(r.value.some(o=>parseInt(o.product.id)===parseInt(u.product.id)))return;r.value.push({product:u.product,option:h.value,qty:c.value}),_.value=!0}},S=o=>{o?c.value++:c.value>1&&c.value--,_.value&&(r.value.forEach(n=>{parseInt(n.product.id)===parseInt(u.product.id)&&(n.qty=c.value)}),localStorage.setItem("cart",JSON.stringify(r)))},I=o=>{h.value=o,_.value&&r.value.forEach(n=>{parseInt(n.product.id)===parseInt(u.product.id)&&(n.option=o)})},T=o=>o.id==h.value.id;return q(()=>{_.value=r.value.some(o=>parseInt(o.product.id)===parseInt(u.product.id)?(h.value=o.option,c.value=o.qty,!0):!1),w(".product-image-slider").slick({slidesToShow:1}),w(".pro-dec-big-img-slider").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,draggable:!1,fade:!1,asNavFor:".product-dec-slider-small , .product-dec-slider-small-2"}),w(".product-dec-slider-small").slick({slidesToShow:4,slidesToScroll:1,asNavFor:".pro-dec-big-img-slider",dots:!1,focusOnSelect:!0,fade:!1,arrows:!1,responsive:[{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:4}},{breakpoint:575,settings:{slidesToShow:2}}]})}),(o,n)=>(i(),z($,null,{default:p(()=>[s("div",A,[s("div",B,[s("div",L,[v(m(g),{href:"/",rel:"nofollow"},{default:p(()=>[M,d("Home")]),_:1}),F,v(m(g),{href:"/products"},{default:p(()=>[d(a(e.product.product_category.name),1)]),_:1}),d(),H,d(" "+a(e.product.name),1)])])]),s("div",E,[s("div",D,[s("div",J,[s("div",Q,[s("div",R,[s("div",W,[s("div",j,[s("div",P,[s("div",G,[K,s("div",U,[(i(!0),l(b,null,f(e.product.images,t=>(i(),l("figure",{key:t.id,class:"border-radius-10"},[s("img",{class:"lazy",src:O,"data-src":"/storage/"+t.url,alt:"product image"},null,8,X)]))),128))])])]),s("div",Y,[s("div",Z,[e.product.discounts.length?(i(),l("span",ss," -"+a(e.product.discounts[0].percentage)+"%",1)):x("",!0),s("h2",ts,a(e.product.name),1),s("div",es,[s("div",os,[s("span",as,"ksh."+a(e.product.discounts.length?(100-e.product.discounts[0].percentage)/100*h.value.selling_price*c.value:h.value.selling_price*c.value),1),e.product.discounts.length?(i(),l("span",is,[s("span",ls,a(e.product.discounts[0].percentage)+"% Off",1),s("span",cs,"ksh."+a(h.value.selling_price*c.value),1)])):x("",!0)])]),s("div",ns,[s("p",{class:"font-lg",innerHTML:e.product.description},null,8,ds)]),s("div",rs,[us,s("ul",hs,[(i(!0),l(b,null,f(e.product.product_options,t=>(i(),l("li",{key:t.id,class:N({active:T(t)})},[s("a",{href:"#",onClick:y(Ys=>I(t),["prevent"])},a(t.variation),9,_s)],2))),128))])]),s("div",ps,[s("div",ms,[s("a",{href:"#",onClick:n[0]||(n[0]=y(t=>S(0),["prevent"])),class:"qty-down"},gs),s("input",{type:"text",name:"quantity",class:"qty-val",value:c.value,min:"1"},null,8,fs),s("a",{href:"#",class:"qty-up",onClick:n[1]||(n[1]=y(t=>S(1),["prevent"]))},ys)]),s("div",ks,[s("button",{onClick:y(C,["prevent"]),id:"addBtn",type:"button",class:"button button-add-to-cart"},[xs,d(a(m(_)?"Remove from ":"Add to ")+"cart",1)],8,ws)])]),s("div",Ss,[s("ul",Cs,[s("li",Is,[d("Ingredients: "),s("span",Ts,a(e.product.ingredients),1)])])])])])]),e.related.length?(i(),l("div",qs,[zs,s("div",Ns,[s("div",Os,[(i(!0),l(b,null,f(e.related,t=>(i(),l("div",{key:t.id,class:"col-lg-3 col-md-4 col-12 col-sm-6"},[s("div",Vs,[s("div",$s,[s("div",As,[v(m(g),{href:"/products/"+t.slug,tabindex:"0"},{default:p(()=>[s("img",{class:"default-img",src:"/storage/"+t.images[0].url,alt:""},null,8,Bs),s("img",{class:"hover-img",src:"/storage/"+t.images[1].url,alt:""},null,8,Ls)]),_:2},1032,["href"])]),Ms,Fs]),s("div",Hs,[s("h2",null,[s("a",Es,a(t.name),1)]),Ds,s("div",Js,[s("span",null,"ksh."+a(t.product_options[0].selling_price),1),Qs])])])]))),128))])])])):x("",!0)])]),s("div",Rs,[s("div",Ws,[s("div",js,[Ps,s("ul",null,[(i(!0),l(b,null,f(e.categories,t=>(i(),l("li",{key:t.id},[v(m(g),{href:"/products"},{default:p(()=>[s("img",{src:"/storage/"+t.image.url,alt:""},null,8,Gs),d(a(t.name),1)]),_:2},1024),s("span",Ks,a(t.products_count),1)]))),128))])]),Us])])])])])])]),_:1}))}};export{it as default};
