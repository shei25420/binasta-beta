import{e as a,D as n}from"./dataTables.bootstrap5.b1186638.js";import{a as o,c as d,w as r,b as t,d as c,e as l}from"./app.1ac5e0b9.js";import"./dataTables.responsive.219a163f.js";import"./ckeditor.8c7893e7.js";import{_ as u}from"./GenericLayout.1e147c90.js";import"./app.min.11b0299a.js";import"./_plugin-vue_export-helper.cdc0426e.js";const i={class:"card"},p=t("div",{class:"card-header"},[t("h4",null,"Products")],-1),_={class:"card-body"},m=t("thead",null,[t("tr",null,[t("th",null,"Name"),t("th",null,"Category"),t("th",null,"Product Image"),t("th",null,"Product Options"),t("th",null,"Created At"),t("th",null,"Actions")])],-1),C={__name:"Products",props:{products:Array},setup(s){return a.use(n),(h,g)=>(o(),d(u,null,{default:r(()=>[t("div",i,[p,t("div",_,[c(l(a),{options:{responsive:!0},columns:[{data:"name"},{data:"product_category",render:e=>e.name},{data:"images",render:e=>`<img class='img img-fluid' src='/storage/${e[0].url}' width=150/>`},{data:"product_options_count",render:e=>e?"<span class='badge bg-success'>Complete ("+e+")</span>":"<span class='badge bg-danger'>Incomplete</span>"},{data:"created_at",render:e=>new Date(e).toDateString()},{data:null,render:e=>`<button data-type='view' data-id='${e.id}' class='btn btn-sm btn-primary mr-4'>View</button>`}],data:s.products,class:"table table-responsive display",id:"dt"},{default:r(()=>[m]),_:1},8,["columns","data"])])])]),_:1}))}};export{C as default};
