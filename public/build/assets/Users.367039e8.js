import{e as t,D as o}from"./dataTables.bootstrap5.be021906.js";import{a as d,c as l,w as a,b as e,d as n,e as _}from"./app.431f35f0.js";import"./dataTables.responsive.26dc8517.js";import{_ as c}from"./GenericLayout.b87cdd80.js";import"./app.min.421426a6.js";import"./index.15451c4b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const i={class:"card"},u=e("div",{class:"card-header"},[e("h5",null,"Users")],-1),m={class:"card-body"},p=e("thead",null,[e("tr",null,[e("th",null,"Email"),e("th",null,"No.Of Orders"),e("th",null,"Created At")])],-1),N={__name:"Users",props:{users:Array},setup(s){return t.use(o),(h,f)=>(d(),l(c,null,{default:a(()=>[e("div",i,[u,e("div",m,[n(_(t),{id:"dt",class:"display table table-responsive",options:{responsive:!0},data:s.users,columns:[{data:"email"},{data:"orders_count"},{data:"created_at",render:r=>new Date(r).toDateString()}]},{default:a(()=>[p]),_:1},8,["data","columns"])])])]),_:1}))}};export{N as default};
