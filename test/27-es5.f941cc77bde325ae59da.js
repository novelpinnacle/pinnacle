function _classCallCheck(e,i){if(!(e instanceof i))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,i){for(var n=0;n<i.length;n++){var o=i[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function _createClass(e,i,n){return i&&_defineProperties(e.prototype,i),n&&_defineProperties(e,n),e}(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{"8ac8":function(e,i,n){"use strict";n.r(i),n.d(i,"DefaultPermissionsModule",(function(){return O}));var o,c=n("ofXK"),t=n("tyNb"),r=n("n+G7"),s=n("SP9e"),a=n("fXoL"),l=n("4KEQ"),d=n("aCk2"),u=n("G0I0"),p=n("3Pt+"),m=n("bTqV"),f=n("ZMsq"),g=n("kmnG"),h=n("qFsG"),b=((o=function(){function e(i){_classCallCheck(this,e),this.coreService=i}return _createClass(e,[{key:"ngOnInit",value:function(){}},{key:"submit",value:function(){var e=this;this.coreService.postRequest(s.a.API_URL+"permissions/new-role",{roleName:this.roleName}).subscribe((function(i){e.roles.push(i.role),e.modal.addRole=!1}))}}]),e}()).\u0275fac=function(e){return new(e||o)(a.dc(l.a))},o.\u0275cmp=a.Xb({type:o,selectors:[["add-role"]],inputs:{modal:"modal",roles:"roles"},decls:6,vars:2,consts:[["matInput","","placeholder","For eg. Manager,Coordinator etc","required","",3,"ngModel","ngModelChange"],["mat-raised-button","","color","primary",3,"disabled","click"]],template:function(e,i){1&e&&(a.jc(0,"mat-form-field"),a.jc(1,"mat-label"),a.Wc(2,"Enter Role Name"),a.ic(),a.jc(3,"input",0),a.rc("ngModelChange",(function(e){return i.roleName=e})),a.ic(),a.ic(),a.jc(4,"button",1),a.rc("click",(function(){return i.submit()})),a.Wc(5,"Submit"),a.ic()),2&e&&(a.Pb(3),a.Bc("ngModel",i.roleName),a.Pb(1),a.Bc("disabled",!i.roleName))},directives:[g.b,g.e,h.a,p.b,p.r,p.k,p.n,m.b],styles:[""]}),o),v=n("V/o5"),P=n("bSwM"),k=n("CGWC");function C(e,i){if(1&e&&(a.jc(0,"option",17),a.Wc(1),a.ic()),2&e){var n=i.$implicit;a.Bc("value",n.roleId),a.Pb(1),a.Xc(n.roleName)}}function w(e,i){if(1&e){var n=a.kc();a.jc(0,"div",23),a.jc(1,"mat-checkbox",24),a.rc("ngModelChange",(function(e){a.Mc(n);var o=i.$implicit;return a.vc().$implicit.permissions[o]=e})),a.Wc(2),a.ic(),a.ic()}if(2&e){var o=i.$implicit,c=a.vc().$implicit,t=a.vc();a.Pb(1),a.Bc("ngModel",c.permissions[o]),a.Pb(1),a.Yc(" ",t.renameKeys(o)," ")}}function y(e,i){if(1&e){var n=a.kc();a.jc(0,"div",18),a.ec(1,"div",19),a.wc(2,"safe"),a.jc(3,"mat-checkbox",20),a.rc("change",(function(e){a.Mc(n);var o=i.$implicit;return a.vc().toggleAll(o,e)})),a.ic(),a.jc(4,"div",21),a.Vc(5,w,3,2,"div",22),a.ic(),a.ic()}if(2&e){var o=i.$implicit,c=a.vc();a.Pb(1),a.Bc("innerHTML",a.xc(2,2,o.permissionsTitle),a.Nc),a.Pb(4),a.Bc("ngForOf",c.getKeys(o.permissions))}}function M(e,i){1&e&&(a.jc(0,"div",25),a.Wc(1,"Please choose role"),a.ic())}var j,_,x=function(){return{width:"400px"}},I=[{path:"",component:(j=function(){function e(i){_classCallCheck(this,e),this.coreService=i,this.loading=!0,this.roles=[],this.roleId="",this.permissions=[],this.modals={addRole:!1}}return _createClass(e,[{key:"ngOnInit",value:function(){var e=this;this.coreService.getRequest(s.a.API_URL+"permissions/default-role-permissions").subscribe((function(i){e.roles=i,e.loading=!1}))}},{key:"getKeys",value:function(e){return Object.keys(e)}},{key:"renameKeys",value:function(e){return e.split("_").join(" ")}},{key:"toggleAll",value:function(e,i){for(var n in e.permissions)e.permissions[n]=+i.checked}},{key:"loadPermissions",value:function(){var e=this;this.permissions=[];var i=this.roles.find((function(i){return i.roleId==e.roleId}));i&&(this.permissions=i.permissions),"-1"==this.roleId&&(this.modals.addRole=!0)}},{key:"updatePermissions",value:function(){var e=this;this.loading=!0,this.coreService.putRequest(s.a.API_URL+"permissions/default-permissions-all",{permissions:this.permissions,roleId:this.roleId}).subscribe((function(i){e.loading=!1}))}}]),e}(),j.\u0275fac=function(e){return new(e||j)(a.dc(l.a))},j.\u0275cmp=a.Xb({type:j,selectors:[["default-permissions-home"]],decls:24,vars:12,consts:[["id","page-content"],[1,"row","filter-row"],[1,"select",3,"ngModel","ngModelChange","change"],["value",""],[3,"value",4,"ngFor","ngForOf"],["id","add-role",3,"value"],["mat-raised-button","",3,"disabled","click"],["id","permissions-wrapper"],["class","permission-item",4,"ngFor","ngForOf"],["class","no-data perfect-centered",4,"ngIf"],["modal","",1,"modal",3,"show","options"],[1,"dialog"],[1,"modal-header"],[1,"close",3,"click"],[1,"modal-body"],[3,"modal","roles"],[3,"show"],[3,"value"],[1,"permission-item"],[1,"permission-title",3,"innerHTML"],[1,"toggle-checkbox",3,"change"],[1,"row"],["class","col-sm-2",4,"ngFor","ngForOf"],[1,"col-sm-2"],[3,"ngModel","ngModelChange"],[1,"no-data","perfect-centered"]],template:function(e,i){1&e&&(a.ec(0,"admin-header"),a.ec(1,"admin-sidebar"),a.jc(2,"div",0),a.jc(3,"div",1),a.jc(4,"select",2),a.rc("ngModelChange",(function(e){return i.roleId=e}))("change",(function(){return i.loadPermissions()})),a.jc(5,"option",3),a.Wc(6,"Select Role"),a.ic(),a.Vc(7,C,2,2,"option",4),a.jc(8,"option",5),a.Wc(9,"Add Role"),a.ic(),a.ic(),a.jc(10,"button",6),a.rc("click",(function(){return i.updatePermissions()})),a.Wc(11,"Update"),a.ic(),a.ic(),a.jc(12,"div",7),a.Vc(13,y,6,4,"div",8),a.ic(),a.Vc(14,M,2,0,"div",9),a.ic(),a.jc(15,"div",10),a.jc(16,"div",11),a.jc(17,"div",12),a.Wc(18,"Add Role"),a.ic(),a.jc(19,"div",13),a.rc("click",(function(){return i.modals.addRole=!1})),a.Wc(20,"\xd7"),a.ic(),a.jc(21,"div",14),a.ec(22,"add-role",15),a.ic(),a.ic(),a.ic(),a.ec(23,"loading",16)),2&e&&(a.Pb(4),a.Bc("ngModel",i.roleId),a.Pb(3),a.Bc("ngForOf",i.roles),a.Pb(1),a.Bc("value",-1),a.Pb(2),a.Bc("disabled",!i.roleId||"-1"==i.roleId),a.Pb(3),a.Bc("ngForOf",i.permissions),a.Pb(1),a.Bc("ngIf",!i.permissions.length),a.Pb(1),a.Bc("show",i.modals.addRole)("options",a.Cc(11,x)),a.Pb(7),a.Bc("modal",i.modals)("roles",i.roles),a.Pb(1),a.Bc("show",i.loading))},directives:[d.a,u.a,p.s,p.k,p.n,p.o,p.u,c.j,m.b,c.k,f.a,b,v.a,P.a],pipes:[k.a],styles:[".filter-row[_ngcontent-%COMP%]{padding-bottom:15px}.filter-row[_ngcontent-%COMP%] > *[_ngcontent-%COMP%]{width:180px;margin-right:10px}#add-role[_ngcontent-%COMP%]{font-style:italic;font-weight:700}#permissions-wrapper[_ngcontent-%COMP%]{background-color:#fff;max-height:74vh;overflow-y:auto;padding:15px}.permission-item[_ngcontent-%COMP%]{padding:8px 15px;box-shadow:0 0 2px -1px rgba(0,0,0,.25);margin:15px 0;background:#fcfcfc}.permission-item[_ngcontent-%COMP%]:first-child{margin-top:0}.permission-title[_ngcontent-%COMP%]{display:inline-block;font-size:15px;font-weight:500;color:#555;margin-bottom:5px}mat-checkbox[_ngcontent-%COMP%]{margin-top:5px;display:block;text-transform:capitalize}.toggle-checkbox[_ngcontent-%COMP%]{display:inline-block;margin-left:10px}"]}),j)}],O=((_=function e(){_classCallCheck(this,e)}).\u0275mod=a.bc({type:_}),_.\u0275inj=a.ac({factory:function(e){return new(e||_)},imports:[[c.c,r.a,t.f.forChild(I)]]}),_)}}]);