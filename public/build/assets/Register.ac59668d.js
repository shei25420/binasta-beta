import{u as d,a as m,c as p,w as _,d as u,e,Y as f,b as s,i as h,f as i,v as n,k as r}from"./app.2dfc48f0.js";import{_ as g}from"./flogo.b45e8d3c.js";import{_ as v}from"./AuthenticationLayout.16b9adec.js";import"./bootstrap.627b38bb.js";import"./app.min.43ffa372.js";const b={class:"form-wrapper"},w={class:"container"},x={class:"card"},y={class:"row g-0"},B={class:"col"},k={class:"row"},S={class:"col-md-10 offset-md-1"},V=s("div",{class:"ltf-block-logo d-block d-lg-none text-center text-lg-start"},[s("img",{width:"120",src:"https://vetra.laborasyon.com/assets/images/logo.svg",alt:"logo"})],-1),U=s("div",{class:"my-5 text-center text-lg-start"},[s("h1",{class:"display-8"},"Create Account"),s("p",{class:"text-muted"},"You can create a free account now")],-1),T=["onSubmit"],q={class:"mb-3"},C={class:"mb-3"},D={class:"mb-3"},E=s("div",{class:"text-center text-lg-start"},[s("button",{type:"submit",id:"submitBtn",class:"btn btn-primary"},"Sign Up")],-1),I=s("p",{class:"text-center d-block d-lg-none mt-5 mt-lg-0"},[r(" Don't have an account? "),s("a",{href:"#"},"Sign In"),r(". ")],-1),N=s("div",{class:"col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center"},[s("div",{class:"logo"},[s("img",{width:"120",src:g,alt:"logo"})]),s("div",null,[s("h3",{class:"fw-bold"},"Welcome to Binasta Limited!"),s("p",{class:"lead my-5"},"Do you already have an account?"),s("a",{href:"#",class:"btn btn-primary"},"Sign In")]),s("ul",{class:"list-inline"},[s("li",{class:"list-inline-item"},[s("a",{href:"#"},"Privacy Policy")]),s("li",{class:"list-inline-item"},[s("a",{href:"#"},"Terms & Conditions")])])],-1),A={__name:"Register",setup(R){const t=d({email:"",password:"",password_confirmation:"",terms:!1}),c=()=>{const l=document.getElementById("submitBtn");l.innerText="Siging Up....",t.post(route("shop-register"),{onFinish:()=>t.reset("password","password_confirmation")})};return(l,o)=>(m(),p(v,null,{default:_(()=>[u(e(f),{title:"Register"}),s("div",b,[s("div",w,[s("div",x,[s("div",y,[s("div",B,[s("div",k,[s("div",S,[V,U,s("form",{onSubmit:h(c,["prevent"]),class:"mb-5"},[s("div",q,[i(s("input",{"onUpdate:modelValue":o[0]||(o[0]=a=>e(t).email=a),type:"email",class:"form-control",placeholder:"Enter email",required:""},null,512),[[n,e(t).email]])]),s("div",C,[i(s("input",{"onUpdate:modelValue":o[1]||(o[1]=a=>e(t).password=a),type:"password",class:"form-control",placeholder:"Enter password",required:""},null,512),[[n,e(t).password]])]),s("div",D,[i(s("input",{"onUpdate:modelValue":o[2]||(o[2]=a=>e(t).password_confirmation=a),type:"password",class:"form-control",placeholder:"Re-enter password",required:""},null,512),[[n,e(t).password_confirmation]])]),E],40,T),I])])]),N])])])])]),_:1}))}};export{A as default};