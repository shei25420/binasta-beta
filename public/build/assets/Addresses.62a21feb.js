import{_ as o}from"./GenericLayout.f583260a.js";import{a as t,c as r,w as d,b as e,g as a,p as m,t as l,k as n,F as _}from"./app.2dfc48f0.js";import"./app.min.43ffa372.js";import"./index.37b1d19b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const p=e("div",{class:"buyer-profile-cover bg-image mb-4",style:{background:'url("../../assets/images/profile-bg.jpg")'}},[e("div",{class:"container d-flex align-items-center justify-content-center h-100 flex-column flex-md-row text-center text-md-start"},[e("div",{class:"my-4 my-md-0"},[e("a",{href:"settings.html",class:"btn btn-primary btn-lg btn-icon"},[e("i",{class:"bi bi-pencil small"}),n(" Add Address ")])])])],-1),u={class:"row g-4 mb-4"},b={class:"card"},f={class:"card-body d-flex flex-column gap-3"},g=e("div",{class:"d-flex justify-content-between align-items-center"},[e("h5",{class:"mb-0"},"Home"),e("a",{href:"#"},"Edit")],-1),h=e("i",{class:"bi bi-telephone me-2"},null,-1),A={__name:"Addresses",props:"locations",setup(c){const i=c;return(x,v)=>(t(),r(o,null,{default:d(()=>[p,e("div",u,[(t(!0),a(_,null,m(i.locations,s=>(t(),a("div",{key:s.id,class:"col-md-6 col-sm-12"},[e("div",b,[e("div",f,[g,e("div",null,l(s.name),1),e("div",null,[h,n(" "+l(s.phone_number),1)])])])]))),128))])]),_:1}))}};export{A as default};