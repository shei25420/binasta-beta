import{$ as r}from"./app.ccec1e18.js";import{D as _}from"./dataTables.bootstrap5.9dec3023.js";/*! Responsive 2.4.0
 * 2014-2022 SpryMedia Ltd - datatables.net/license
 */var p=function(e,t){if(!_.versionCheck||!_.versionCheck("1.10.10"))throw"DataTables Responsive requires DataTables 1.10.10 or newer";this.s={childNodeStore:{},columns:[],current:[],dt:new _.Api(e)},!this.s.dt.settings()[0].responsive&&(t&&typeof t.details=="string"?t.details={type:t.details}:t&&t.details===!1?t.details={type:!1}:t&&t.details===!0&&(t.details={type:"inline"}),this.c=r.extend(!0,{},p.defaults,_.defaults.responsive,t),e.responsive=this,this._constructor())};r.extend(p.prototype,{_constructor:function(){var e=this,t=this.s.dt,i=t.settings()[0],n=r(window).innerWidth();t.settings()[0]._responsive=this,r(window).on("resize.dtr orientationchange.dtr",_.util.throttle(function(){var d=r(window).innerWidth();d!==n&&(e._resize(),n=d)})),i.oApi._fnCallbackReg(i,"aoRowCreatedCallback",function(d,a,o){r.inArray(!1,e.s.current)!==-1&&r(">td, >th",d).each(function(u){var f=t.column.index("toData",u);e.s.current[f]===!1&&r(this).css("display","none")})}),t.on("destroy.dtr",function(){t.off(".dtr"),r(t.table().body()).off(".dtr"),r(window).off("resize.dtr orientationchange.dtr"),t.cells(".dtr-control").nodes().to$().removeClass("dtr-control"),r.each(e.s.current,function(d,a){a===!1&&e._setColumnVis(d,!0)})}),this.c.breakpoints.sort(function(d,a){return d.width<a.width?1:d.width>a.width?-1:0}),this._classLogic(),this._resizeAuto();var s=this.c.details;s.type!==!1&&(e._detailsInit(),t.on("column-visibility.dtr",function(){e._timer&&clearTimeout(e._timer),e._timer=setTimeout(function(){e._timer=null,e._classLogic(),e._resizeAuto(),e._resize(!0),e._redrawChildren()},100)}),t.on("draw.dtr",function(){e._redrawChildren()}),r(t.table().node()).addClass("dtr-"+s.type)),t.on("column-reorder.dtr",function(d,a,o){e._classLogic(),e._resizeAuto(),e._resize(!0)}),t.on("column-sizing.dtr",function(){e._resizeAuto(),e._resize()}),t.on("column-calc.dt",function(d,a){for(var o=e.s.current,u=0;u<o.length;u++){var f=a.visible.indexOf(u);o[u]===!1&&f>=0&&a.visible.splice(f,1)}}),t.on("preXhr.dtr",function(){var d=[];t.rows().every(function(){this.child.isShown()&&d.push(this.id(!0))}),t.one("draw.dtr",function(){e._resizeAuto(),e._resize(),t.rows(d).every(function(){e._detailsDisplay(this,!1)})})}),t.on("draw.dtr",function(){e._controlClass()}).on("init.dtr",function(d,a,o){d.namespace==="dt"&&(e._resizeAuto(),e._resize(),r.inArray(!1,e.s.current)&&t.columns.adjust())}),this._resize()},_childNodes:function(e,t,i){var n=t+"-"+i;if(this.s.childNodeStore[n])return this.s.childNodeStore[n];for(var s=[],d=e.cell(t,i).node().childNodes,a=0,o=d.length;a<o;a++)s.push(d[a]);return this.s.childNodeStore[n]=s,s},_childNodesRestore:function(e,t,i){var n=t+"-"+i;if(!!this.s.childNodeStore[n]){for(var s=e.cell(t,i).node(),d=this.s.childNodeStore[n],a=d[0].parentNode,o=a.childNodes,u=[],f=0,h=o.length;f<h;f++)u.push(o[f]);for(var l=0,c=u.length;l<c;l++)s.appendChild(u[l]);this.s.childNodeStore[n]=void 0}},_columnsVisiblity:function(e){var t=this.s.dt,i=this.s.columns,n,s,d=i.map(function(v,y){return{columnIdx:y,priority:v.priority}}).sort(function(v,y){return v.priority!==y.priority?v.priority-y.priority:v.columnIdx-y.columnIdx}),a=r.map(i,function(v,y){return t.column(y).visible()===!1?"not-visible":v.auto&&v.minWidth===null?!1:v.auto===!0?"-":r.inArray(e,v.includeIn)!==-1}),o=0;for(n=0,s=a.length;n<s;n++)a[n]===!0&&(o+=i[n].minWidth);var u=t.settings()[0].oScroll,f=u.sY||u.sX?u.iBarWidth:0,h=t.table().container().offsetWidth-f,l=h-o;for(n=0,s=a.length;n<s;n++)i[n].control&&(l-=i[n].minWidth);var c=!1;for(n=0,s=d.length;n<s;n++){var m=d[n].columnIdx;a[m]==="-"&&!i[m].control&&i[m].minWidth&&(c||l-i[m].minWidth<0?(c=!0,a[m]=!1):a[m]=!0,l-=i[m].minWidth)}var g=!1;for(n=0,s=i.length;n<s;n++)if(!i[n].control&&!i[n].never&&a[n]===!1){g=!0;break}for(n=0,s=i.length;n<s;n++)i[n].control&&(a[n]=g),a[n]==="not-visible"&&(a[n]=!1);return r.inArray(!0,a)===-1&&(a[0]=!0),a},_classLogic:function(){var e=this,t=this.c.breakpoints,i=this.s.dt,n=i.columns().eq(0).map(function(a){var o=this.column(a),u=o.header().className,f=i.settings()[0].aoColumns[a].responsivePriority,h=o.header().getAttribute("data-priority");return f===void 0&&(f=h==null?1e4:h*1),{className:u,includeIn:[],auto:!1,control:!1,never:!!u.match(/\b(dtr\-)?never\b/),priority:f}}),s=function(a,o){var u=n[a].includeIn;r.inArray(o,u)===-1&&u.push(o)},d=function(a,o,u,f){var h,l,c;if(!u)n[a].includeIn.push(o);else if(u==="max-")for(h=e._find(o).width,l=0,c=t.length;l<c;l++)t[l].width<=h&&s(a,t[l].name);else if(u==="min-")for(h=e._find(o).width,l=0,c=t.length;l<c;l++)t[l].width>=h&&s(a,t[l].name);else if(u==="not-")for(l=0,c=t.length;l<c;l++)t[l].name.indexOf(f)===-1&&s(a,t[l].name)};n.each(function(a,o){for(var u=a.className.split(" "),f=!1,h=0,l=u.length;h<l;h++){var c=u[h].trim();if(c==="all"||c==="dtr-all"){f=!0,a.includeIn=r.map(t,function(m){return m.name});return}else if(c==="none"||c==="dtr-none"||a.never){f=!0;return}else if(c==="control"||c==="dtr-control"){f=!0,a.control=!0;return}r.each(t,function(m,g){var v=g.name.split("-"),y=new RegExp("(min\\-|max\\-|not\\-)?("+v[0]+")(\\-[_a-zA-Z0-9])?"),b=c.match(y);b&&(f=!0,b[2]===v[0]&&b[3]==="-"+v[1]?d(o,g.name,b[1],b[2]+b[3]):b[2]===v[0]&&!b[3]&&d(o,g.name,b[1],b[2]))})}f||(a.auto=!0)}),this.s.columns=n},_controlClass:function(){if(this.c.details.type==="inline"){var e=this.s.dt,t=this.s.current,i=r.inArray(!0,t);e.cells(null,function(n){return n!==i},{page:"current"}).nodes().to$().filter(".dtr-control").removeClass("dtr-control"),e.cells(null,i,{page:"current"}).nodes().to$().addClass("dtr-control")}},_detailsDisplay:function(e,t){var i=this,n=this.s.dt,s=this.c.details;if(s&&s.type!==!1){var d=typeof s.renderer=="string"?p.renderer[s.renderer]():s.renderer,a=s.display(e,t,function(){return d.call(i,n,e[0],i._detailsObj(e[0]))});(a===!0||a===!1)&&r(n.table().node()).triggerHandler("responsive-display.dt",[n,e,a,t])}},_detailsInit:function(){var e=this,t=this.s.dt,i=this.c.details;i.type==="inline"&&(i.target="td.dtr-control, th.dtr-control"),t.on("draw.dtr",function(){e._tabIndexes()}),e._tabIndexes(),r(t.table().body()).on("keyup.dtr","td, th",function(d){d.keyCode===13&&r(this).data("dtr-keyboard")&&r(this).click()});var n=i.target,s=typeof n=="string"?n:"td, th";(n!==void 0||n!==null)&&r(t.table().body()).on("click.dtr mousedown.dtr mouseup.dtr",s,function(d){if(!!r(t.table().node()).hasClass("collapsed")&&r.inArray(r(this).closest("tr").get(0),t.rows().nodes().toArray())!==-1){if(typeof n=="number"){var a=n<0?t.columns().eq(0).length+n:n;if(t.cell(this).index().column!==a)return}var o=t.row(r(this).closest("tr"));d.type==="click"?e._detailsDisplay(o,!1):d.type==="mousedown"?r(this).css("outline","none"):d.type==="mouseup"&&r(this).trigger("blur").css("outline","")}})},_detailsObj:function(e){var t=this,i=this.s.dt;return r.map(this.s.columns,function(n,s){if(!(n.never||n.control)){var d=i.settings()[0].aoColumns[s];return{className:d.sClass,columnIndex:s,data:i.cell(e,s).render(t.c.orthogonal),hidden:i.column(s).visible()&&!t.s.current[s],rowIndex:e,title:d.sTitle!==null?d.sTitle:r(i.column(s).header()).text()}}})},_find:function(e){for(var t=this.c.breakpoints,i=0,n=t.length;i<n;i++)if(t[i].name===e)return t[i]},_redrawChildren:function(){var e=this,t=this.s.dt;t.rows({page:"current"}).iterator("row",function(i,n){t.row(n),e._detailsDisplay(t.row(n),!0)})},_resize:function(e){var t=this,i=this.s.dt,n=r(window).innerWidth(),s=this.c.breakpoints,d=s[0].name,a=this.s.columns,o,u,f=this.s.current.slice();for(o=s.length-1;o>=0;o--)if(n<=s[o].width){d=s[o].name;break}var h=this._columnsVisiblity(d);this.s.current=h;var l=!1;for(o=0,u=a.length;o<u;o++)if(h[o]===!1&&!a[o].never&&!a[o].control&&!!i.column(o).visible()){l=!0;break}r(i.table().node()).toggleClass("collapsed",l);var c=!1,m=0;i.columns().eq(0).each(function(g,v){h[v]===!0&&m++,(e||h[v]!==f[v])&&(c=!0,t._setColumnVis(g,h[v]))}),this._redrawChildren(),c&&(r(i.table().node()).trigger("responsive-resize.dt",[i,this.s.current]),i.page.info().recordsDisplay===0&&r("td",i.table().body()).eq(0).attr("colspan",m)),t._controlClass()},_resizeAuto:function(){var e=this.s.dt,t=this.s.columns,i=this;if(!!this.c.auto&&r.inArray(!0,r.map(t,function(l){return l.auto}))!==-1){r.isEmptyObject(this.s.childNodeStore)||r.each(this.s.childNodeStore,function(l){var c=l.split("-");i._childNodesRestore(e,c[0]*1,c[1]*1)}),e.table().node().offsetWidth,e.columns;var n=e.table().node().cloneNode(!1),s=r(e.table().header().cloneNode(!1)).appendTo(n),d=r(e.table().body()).clone(!1,!1).empty().appendTo(n);n.style.width="auto";var a=e.columns().header().filter(function(l){return e.column(l).visible()}).to$().clone(!1).css("display","table-cell").css("width","auto").css("min-width",0);r(d).append(r(e.rows({page:"current"}).nodes()).clone(!1)).find("th, td").css("display","");var o=e.table().footer();if(o){var u=r(o.cloneNode(!1)).appendTo(n),f=e.columns().footer().filter(function(l){return e.column(l).visible()}).to$().clone(!1).css("display","table-cell");r("<tr/>").append(f).appendTo(u)}r("<tr/>").append(a).appendTo(s),this.c.details.type==="inline"&&r(n).addClass("dtr-inline collapsed"),r(n).find("[name]").removeAttr("name"),r(n).css("position","relative");var h=r("<div/>").css({width:1,height:1,overflow:"hidden",clear:"both"}).append(n);h.insertBefore(e.table().node()),a.each(function(l){var c=e.column.index("fromVisible",l);t[c].minWidth=this.offsetWidth||0}),h.remove()}},_responsiveOnlyHidden:function(){var e=this.s.dt;return r.map(this.s.current,function(t,i){return e.column(i).visible()===!1?!0:t})},_setColumnVis:function(e,t){var i=this,n=this.s.dt,s=t?"":"none";r(n.column(e).header()).css("display",s).toggleClass("dtr-hidden",!t),r(n.column(e).footer()).css("display",s).toggleClass("dtr-hidden",!t),n.column(e).nodes().to$().css("display",s).toggleClass("dtr-hidden",!t),r.isEmptyObject(this.s.childNodeStore)||n.cells(null,e).indexes().each(function(d){i._childNodesRestore(n,d.row,d.column)})},_tabIndexes:function(){var e=this.s.dt,t=e.cells({page:"current"}).nodes().to$(),i=e.settings()[0],n=this.c.details.target;t.filter("[data-dtr-keyboard]").removeData("[data-dtr-keyboard]"),typeof n=="number"?e.cells(null,n,{page:"current"}).nodes().to$().attr("tabIndex",i.iTabIndex).data("dtr-keyboard",1):(n==="td:first-child, th:first-child"&&(n=">td:first-child, >th:first-child"),r(n,e.rows({page:"current"}).nodes()).attr("tabIndex",i.iTabIndex).data("dtr-keyboard",1))}});p.breakpoints=[{name:"desktop",width:1/0},{name:"tablet-l",width:1024},{name:"tablet-p",width:768},{name:"mobile-l",width:480},{name:"mobile-p",width:320}];p.display={childRow:function(e,t,i){if(t){if(r(e.node()).hasClass("parent"))return e.child(i(),"child").show(),!0}else return e.child.isShown()?(e.child(!1),r(e.node()).removeClass("parent"),!1):(e.child(i(),"child").show(),r(e.node()).addClass("parent"),!0)},childRowImmediate:function(e,t,i){return!t&&e.child.isShown()||!e.responsive.hasHidden()?(e.child(!1),r(e.node()).removeClass("parent"),!1):(e.child(i(),"child").show(),r(e.node()).addClass("parent"),!0)},modal:function(e){return function(t,i,n){if(i)r("div.dtr-modal-content").empty().append(n());else{var s=function(){d.remove(),r(document).off("keypress.dtr")},d=r('<div class="dtr-modal"/>').append(r('<div class="dtr-modal-display"/>').append(r('<div class="dtr-modal-content"/>').append(n())).append(r('<div class="dtr-modal-close">&times;</div>').click(function(){s()}))).append(r('<div class="dtr-modal-background"/>').click(function(){s()})).appendTo("body");r(document).on("keyup.dtr",function(a){a.keyCode===27&&(a.stopPropagation(),s())})}e&&e.header&&r("div.dtr-modal-content").prepend("<h2>"+e.header(t)+"</h2>")}}};p.renderer={listHiddenNodes:function(){return function(e,t,i){var n=this,s=r('<ul data-dtr-index="'+t+'" class="dtr-details"/>'),d=!1;return r.each(i,function(a,o){if(o.hidden){var u=o.className?'class="'+o.className+'"':"";r("<li "+u+' data-dtr-index="'+o.columnIndex+'" data-dt-row="'+o.rowIndex+'" data-dt-column="'+o.columnIndex+'"><span class="dtr-title">'+o.title+"</span> </li>").append(r('<span class="dtr-data"/>').append(n._childNodes(e,o.rowIndex,o.columnIndex))).appendTo(s),d=!0}}),d?s:!1}},listHidden:function(){return function(e,t,i){var n=r.map(i,function(s){var d=s.className?'class="'+s.className+'"':"";return s.hidden?"<li "+d+' data-dtr-index="'+s.columnIndex+'" data-dt-row="'+s.rowIndex+'" data-dt-column="'+s.columnIndex+'"><span class="dtr-title">'+s.title+'</span> <span class="dtr-data">'+s.data+"</span></li>":""}).join("");return n?r('<ul data-dtr-index="'+t+'" class="dtr-details"/>').append(n):!1}},tableAll:function(e){return e=r.extend({tableClass:""},e),function(t,i,n){var s=r.map(n,function(d){var a=d.className?'class="'+d.className+'"':"";return"<tr "+a+' data-dt-row="'+d.rowIndex+'" data-dt-column="'+d.columnIndex+'"><td>'+d.title+":</td> <td>"+d.data+"</td></tr>"}).join("");return r('<table class="'+e.tableClass+' dtr-details" width="100%"/>').append(s)}}};p.defaults={breakpoints:p.breakpoints,auto:!0,details:{display:p.display.childRow,renderer:p.renderer.listHidden(),target:0,type:"inline"},orthogonal:"display"};var w=r.fn.dataTable.Api;w.register("responsive()",function(){return this});w.register("responsive.index()",function(e){return e=r(e),{column:e.data("dtr-index"),row:e.parent().data("dtr-index")}});w.register("responsive.rebuild()",function(){return this.iterator("table",function(e){e._responsive&&e._responsive._classLogic()})});w.register("responsive.recalc()",function(){return this.iterator("table",function(e){e._responsive&&(e._responsive._resizeAuto(),e._responsive._resize())})});w.register("responsive.hasHidden()",function(){var e=this.context[0];return e._responsive?r.inArray(!1,e._responsive._responsiveOnlyHidden())!==-1:!1});w.registerPlural("columns().responsiveHidden()","column().responsiveHidden()",function(){return this.iterator("column",function(e,t){return e._responsive?e._responsive._responsiveOnlyHidden()[t]:!1},1)});p.version="2.4.0";r.fn.dataTable.Responsive=p;r.fn.DataTable.Responsive=p;r(document).on("preInit.dt.dtr",function(e,t,i){if(e.namespace==="dt"&&(r(t.nTable).hasClass("responsive")||r(t.nTable).hasClass("dt-responsive")||t.oInit.responsive||_.defaults.responsive)){var n=t.oInit.responsive;n!==!1&&new p(t,r.isPlainObject(n)?n:{})}});