import{_ as h}from"./PageBanner.f2eb040e.js";import{S as u,a as l,g as t,d as o,b as s,k as i,t as c,F as n,D as d,p,w as m}from"./app.ccec1e18.js";const f={class:"page-content minus-padding"},_={class:"container"},g={class:"row"},v={class:"col-lg-9"},y={class:"single-blog-detials"},b=["src"],w={class:"post-meta d-flex justify-content-between"},k={href:"#"},x=s("i",{class:"icofont"},"ui_calendar",-1),N=s("li",null,[s("a",{href:"#"},[s("i",{class:"icofont"},"comment"),i("30")])],-1),S=s("li",null,[s("a",{href:"#"},[s("i",{class:"icofont"},"user_alt_4"),i(" Tonmoy Khan")])],-1),T=p('<hr><div class="comments-section"><h3 class="section-title xs2">3 comments</h3><br><div class="media single-comments"><a class="mr-4" href="#"><img class="rounded-circle img-thumbnail" src="assets/images/all-img/comments1.jpg" alt=""></a><div class="media-body"><h5 class="mt-0">Tonmoy Khan <span>25 Nov, 2018 at 10.30 am</span></h5><p>If your delts are a weakness, or you find it\u2019s a muscle group you have seds a hard time connecting with, this workout will help.</p><ul class="likeunlikeBox"><li><a href="#"><i class="icofont">thumbs_up</i>10</a></li><li><a href="#"><i class="icofont">thumbs_down</i>12</a></li><li><a href="#"><i class="icofont">reply</i></a></li></ul><div class="media mt-5"><a class="pr-4" href="#"><img src="assets/images/all-img/comments2.jpg" alt="" class="rounded-circle img-thumbnail"></a><div class="media-body"><h5 class="mt-0">priya khan <span>25 Nov, 2018 at 10.30 am</span></h5><p>f your delts are a weakness, or you find it\u2019s a muscle group you have seds a hard time connecting with, this workout will help</p><ul class="likeunlikeBox"><li><a href="#"><i class="icofont">thumbs_up</i>10</a></li><li><a href="#"><i class="icofont">thumbs_down</i>12</a></li><li><a href="#"><i class="icofont">reply</i></a></li></ul></div></div></div></div><div class="media single-comments mt-5"><a class="mr-4" href="#"><img class="rounded-circle img-thumbnail" src="assets/images/all-img/comments1.jpg" alt=""></a><div class="media-body"><h5 class="mt-0">Tonmoy Khan <span>25 Nov, 2018 at 10.30 am</span></h5><p>If your delts are a weakness, or you find it\u2019s a muscle group you have seds a hard time connecting with, this workout will help.</p><ul class="likeunlikeBox"><li><a href="#"><i class="icofont">thumbs_up</i>10</a></li><li><a href="#"><i class="icofont">thumbs_down</i>12</a></li><li><a href="#"><i class="icofont">reply</i></a></li></ul></div></div><div class="spacer-extra"></div><form class="site-contactform"><h3 class="section-title xs2">leave a comments</h3><div class="form-row"><div class="col-md-6"><input type="text" class="form-control" placeholder="Type Your Name"></div><div class="col-md-6"><input type="email" class="form-control" placeholder="Email"></div><div class="col-md-12"><textarea class="form-control" placeholder="write your message"></textarea></div></div><div class="text-right"><button type="submit" class="btn-mr th-primary pill">SEND</button></div></form></div>',2),E={class:"col-lg-3"},B={class:"sidebar-wrapper"},D={class:"single-sidebar"},j=s("div",{class:"sideabrHeader"},[s("span",null," CATEGORIES")],-1),A={href:"#"},C={class:"single-sidebar"},V=s("div",{class:"sideabrHeader"},[s("span",null,"RECENT POST")],-1),I=["src"],K={class:"media-body align-self-center"},P={__name:"SinglePost",props:{post:Object,categories:Array,new_posts:Array},setup(a){return(L,O)=>{const r=u("Link");return l(),t(n,null,[o(h,{header:a.post.title},null,8,["header"]),s("div",f,[s("div",_,[s("div",g,[s("div",v,[s("article",y,[s("img",{src:"/storage/"+a.post.image_path,alt:""},null,8,b),s("ul",w,[s("li",null,[s("a",k,[x,i(" "+c(new Date(a.post.created_at).toDateString()),1)])]),N,S]),s("h2",null,c(a.post.title),1),i(" {!! post.post !!} ")]),T]),s("div",E,[s("aside",B,[s("div",D,[j,s("ul",null,[(l(!0),t(n,null,d(a.categories,e=>(l(),t("li",null,[s("a",A,c(e.name),1)]))),256))])]),s("div",C,[V,(l(!0),t(n,null,d(a.new_posts,e=>(l(),t("div",{key:e.slug,class:"media mt-5"},[s("img",{class:"mr-3",src:"/storage/"+e.image_path,alt:""},null,8,I),s("div",K,[s("h5",null,[o(r,{href:"/blog/"+e.slug},{default:m(()=>[i("A small river named Duden flows")]),_:2},1032,["href"])]),s("span",null,[o(r,{href:"/blog/"+e.slug},{default:m(()=>[i("22 May 2018")]),_:2},1032,["href"])])])]))),128))])])])])])])],64)}}};export{P as default};