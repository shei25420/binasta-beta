import{u as p,a as f,c as h,w as n,b as t,i as g,f as d,v as m,e as s,k as o,d as l,L as c}from"./app.431f35f0.js";import{_ as u}from"./flogo.b45e8d3c.js";import{_ as b}from"./AuthenticationLayout.43aea518.js";import"./bootstrap.2e2e0d94.js";import"./app.min.421426a6.js";const w={class:"col"},v={class:"row"},x={class:"col-md-10 offset-md-1"},y=t("div",{class:"d-block d-lg-none text-center text-lg-start"},[t("img",{width:"120",src:u,alt:"logo"})],-1),S=t("div",{class:"my-5 text-center text-lg-start"},[t("h1",{class:"display-8"},"Sign In"),t("p",{class:"text-muted"},"Sign in to Binasta to continue")],-1),k=["onSubmit"],B={class:"mb-3"},E={class:"mb-3"},I={class:"text-center text-lg-start"},T={class:"small"},V=t("button",{id:"submitBtn",class:"btn btn-primary"},"Sign In",-1),q={class:"text-center d-block d-lg-none mt-5 mt-lg-0"},C={class:"col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center"},L=t("div",{class:"logo"},[t("img",{width:"120",src:u,alt:"logo"})],-1),N=t("h3",{class:"fw-bold"},"Welcome to Binasta!",-1),P=t("p",{class:"lead my-5"},"If you don't have an account, would you like to register right now?",-1),j=t("ul",{class:"list-inline"},[t("li",{class:"list-inline-item"},[t("a",{href:"#"},"Privacy Policy")]),t("li",{class:"list-inline-item"},[t("a",{href:"#"},"Terms & Conditions")])],-1),R={__name:"Login",setup(A){const e=p({email:"",password:""}),_=()=>{if(e.clearErrors(),(!e.email||e.email.trim()==="")&&e.setError("email","Email field is required"),(!e.password||e.password.trim()==="")&&e.setError("password","Password field is required"),e.errors&&Object.keys(e.errors).length)return;const i=document.getElementById("submitBtn");i.innerText="Siging In....",i.setAttribute("disabled",!0),e.post("/login",{onFinish:()=>{i.innerText="Sign In",i.removeAttribute("disabled")}})};return(i,r)=>(f(),h(b,null,{default:n(()=>[t("div",w,[t("div",v,[t("div",x,[y,S,t("form",{onSubmit:g(_,["prevent"]),class:"mb-5"},[t("div",B,[d(t("input",{"onUpdate:modelValue":r[0]||(r[0]=a=>s(e).email=a),type:"email",class:"form-control",placeholder:"Enter email",autofocus:"",required:"",autocomplete:"email"},null,512),[[m,s(e).email]])]),t("div",E,[d(t("input",{"onUpdate:modelValue":r[1]||(r[1]=a=>s(e).password=a),type:"password",class:"form-control",placeholder:"Enter password",required:"",autocomplete:"current-password"},null,512),[[m,s(e).password]])]),t("div",I,[t("p",T,[o("Can't access your account? "),l(s(c),{href:"/forgot-password"},{default:n(()=>[o("Reset your password now")]),_:1}),o(".")]),V])],40,k),t("p",q,[o(" Don't have an account? "),l(s(c),{href:"/register"},{default:n(()=>[o("Sign up")]),_:1}),o(". ")])])])]),t("div",C,[L,t("div",null,[N,P,l(s(c),{href:"/register",class:"btn btn-primary"},{default:n(()=>[o("Sign up")]),_:1})]),j])]),_:1}))}};export{R as default};