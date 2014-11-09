"use strict";angular.module("hdashApp",["ngCookies","ngResource","ngSanitize","ui.router","config","ui.utils"]).config(["$stateProvider","$urlRouterProvider",function(a,b){b.otherwise("/"),a.state("g",{"abstract":!0,templateUrl:"views/global.html"}).state("g.event",{url:"/event/:id",templateUrl:"../modules/event/event.html",controller:"EventCtrl"}).state("g.user",{url:"/user/:id",templateUrl:"../modules/user/user.html",controller:"UserCtrl"}).state("g.proj",{url:"/proj/:id",templateUrl:"../modules/proj/proj.html",controller:"ProjCtrl"}).state("g.projs",{url:"/projs",templateUrl:"../modules/proj/projs.html",controller:"ProjsCtrl"}).state("g.projAdd",{url:"/projAdd",templateUrl:"../modules/proj/projAdd.html",controller:"ProjaddCtrl"}).state("g.experts",{url:"/experts",templateUrl:"../modules/expert/experts.html",controller:"ExpertsCtrl"}).state("g.expert/:id",{url:"/expert",templateUrl:"../modules/expert/expert.html",controller:"ExpertCtrl"}).state("g.index",{url:"/",templateUrl:"views/main.html",controller:"MainCtrl"}),a.state("manager",{"abstract":!0,templateUrl:"../modules/manager/manager.html"}).state("manager.main",{url:"/manager",templateUrl:"../modules/manager/mainManager.html",controller:"MainmanagerCtrl"}).state("manager.experts",{url:"/manager/experts",templateUrl:"../modules/manager/expertsManager.html",controller:"ExpertsmanagerCtrl"}).state("manager.expertAdd",{url:"/expertAdd",templateUrl:"../modules/expert/expertAdd.html",controller:"ExpertaddCtrl"}).state("manager.expertEdit",{url:"/expertEdit/:id",templateUrl:"../modules/expert/expertEdit.html",controller:"ExperteditCtrl"}).state("manager.events",{url:"/manager/events",templateUrl:"../modules/event/events.html",controller:"EventsCtrl"}).state("manager.eventAdd",{url:"/manager/eventAdd",templateUrl:"../modules/event/eventAdd.html",controller:"EventaddCtrl"}).state("manager.eventEdit",{url:"/manager/eventEdit/:id",templateUrl:"../modules/event/eventEdit.html",controller:"EventeditCtrl"}).state("manager.users",{url:"/manager/users",templateUrl:"../modules/user/users.html",controller:"UsermanagerCtrl"}).state("manager.userAdd",{url:"/manager/userAdd",templateUrl:"../modules/user/userAdd.html",controller:"UseraddCtrl"}).state("manager.userEdit",{url:"/manager/userEdit/:id",templateUrl:"../modules/user/userEdit.html",controller:"UsereditCtrl"}),a.state("admin",{"abstract":!0,templateUrl:"../modules/admin/admin.html"}).state("admin.main",{url:"/admin",templateUrl:"../modules/admin/adminMain.html",controller:"AdminmainCtrl"}).state("admin.managers",{url:"/managers",templateUrl:"../modules/admin/managers.html",controller:"ManagersCtrl"}).state("admin.managerEdit",{url:"/managerEdit/:id",templateUrl:"../modules/admin/managerEdit.html",controller:"ManagereditCtrl"}).state("manager.criterias",{url:"/criterias",templateUrl:"../modules/criteria/criterias.html",controller:"CriteriasCtrl"}).state("manager.criteriaAdd",{url:"/criteriaAdd",templateUrl:"../modules/criteria/criteriaAdd.html",controller:"CriteriaaddCtrl"}).state("manager.criteriaEdit",{url:"/criteriaEdit/:id",templateUrl:"../modules/criteria/criteriaEdit.html",controller:"CriteriaeditCtrl"}).state("eventMarks",{url:"/eventMarks",templateUrl:"views/eventMarks.html",controller:"EventmarksCtrl"}).state("login",{url:"/login",templateUrl:"views/login.html",controller:"LoginCtrl"}).state("loginManager",{url:"/loginManager",templateUrl:"views/loginManager.html",controller:"LoginmanagerCtrl"}).state("loginExpert",{url:"/loginExpert",templateUrl:"views/loginExpert.html",controller:"LoginexpertCtrl"}).state("admin.managerAdd",{url:"/managerAdd",templateUrl:"../modules/admin/managerAdd.html",controller:"ManageraddCtrl"})}]),angular.module("config",[]).constant("debug",!1).constant("apiurl","http://hdash.ru/index.php"),angular.module("hdashApp").factory("UtilF",["$rootScope","$resource","$q","$timeout","$cookies","apiurl","$state","$templateCache",function(a,b,c,d,e,f){var g={};return g.selectEditElement=function(a,b,c,d){return d.$invalid&&$Form.$dirty?(g.addAlert("Вначале заполните форму!","error"),null):void(a=b[c])},g.tryAddElement=function(a,b,c,d,e){var f=c.indexOf(a[b]);return d.$invalid&&d.$dirty?(g.addAlert("Вначале заполните предыдущую форму!","error"),a[e]=!0,null):(a[e]=!1,d.$valid?(-1==f&&(a[b].aid=c.length,c.push(a[b])),a[b]={},d.$setPristine(),["success",f]):void 0)},g.clearForm=function(a,b,c,d,e){var f,h;a[b].id?(f="Вы действительно хотите отменить изменения?",h="Введённые вами знаения будут утеряны"):(f="Вы действительно хотите очистить форму?",h="Форма будет очищена");var i=$modal.open({templateUrl:"template/dialogs/confirmDialog.html",controller:"ConfirmDialogCtrl",resolve:{header:function(){return f},text:function(){return h}}});return i.result.then(function(){console.log("Идёт очистка");var f=c.indexOf(a[b]);return a[b].id?(c[f]=angular.copy(g.getObjById(d,a[b].id)),c[f].aid=f,a[b]=c[f]):f>-1?(c.splice(f,1),a[b]={}):a[b]={},e.$setPristine(),!0},function(){return console.log("отмена"),!1})},g.removeFromArray=function(a,b){for(var c=a.length,d=b;c-1>d;d++)a[d]=a[d+1],a[d].aid=d;a.length--},g.DeleteFromResource=function(a,b,c){var d="Вы действительно хотите удалить элемент?",e="Элемент будет удалён с сервера сразу после подтверждения!";a[c].id||(d="Вы действительно хотите удалить форму?",e="Введённые вами данные будут удалены");var f=$modal.open({templateUrl:"template/dialogs/confirmDialog.html",controller:"ConfirmDialogCtrl",resolve:{header:function(){return d},text:function(){return e}}});return f.result.then(function(){return a[c].id?b.DELETE({id:a[c].id},function(){g.removeFromArray(a,c),g.addAlert("элемент был успешно удалён с сервера","info")}):g.removeFromArray(a,c),!0},function(){return console.log("отмена"),!1})},g.addAlert=function(b,c){var e={msg:b,type:c};e.fun=function(){var b=function(b){var c=a.alerts.indexOf(b);c>-1&&a.alerts.splice(c,1)},c=this;d(function(){b(c)},5e3)},a.alerts||(a.alerts=[]),a.alerts.push(e),a.alerts.length>3&&a.alerts.splice(0,a.alerts.length-3),e.fun()},g.doShowTooltip=function(a,b){return a?a.$error.required&&(a.$dirty||b):!1},g.catchConnectionError=function(a){switch(console.log(a),a.status){case 403:g.logout();break;case 0:g.addAlert("Ошибка! Сервер временно недоступен, попробуйте перезапустить страницу.","error");break;default:g.addAlert("Произошла ошибка "+a.status+" "+(a.data instanceof Object)?a.data:a.data.error,"error")}},g.showErrors=function(){for(var a=document.getElementsByTagName("multiselect"),b=0;b<a.length;b++)angular.element(a[b]).addClass("multiselect-show-errors");for(var c=document.getElementsByClassName("g-input"),b=0;b<c.length;b++)angular.element(c[b]).addClass("g-input_show_error");for(var d=document.getElementsByClassName("g-input_2"),b=0;b<d.length;b++)angular.element(d[b]).addClass("g-input_show_error");for(var e=document.getElementsByClassName("g-switcher"),b=0;b<e.length;b++)angular.element(e[b]).addClass("g-switcher_show_errors")},g.promiseQuery=function(a){var b=c.defer(),d=a(function(){b.resolve(d)});return b.promise},g.afterAllQueries=function(a){for(var b=[],d=0;d<a.length;d++)b.push(g.promiseQuery(a[d]));return c.all(b)},g.logout=function(){e.role="anon",a.user={},a.mini_image=f+"/img/No_Avatar.png",a.header_label1=null,a.header_label2=null,Auth.logout()},g.Rus=function(a,b,c,d){return a%10==1&&a%100!=11?b:a%10>=2&&4>=a%10&&(10>=a%100||a%100>=20)?c:d},g.Date2SendStr=function(a){return a instanceof Date||(a=new Date(Date.parse(a))),a instanceof Date?a.getFullYear()+"-"+(a.getMonth()+1)+"-"+a.getDate():void 0},g.salaryMinMax2text=function(a,b){var c,d="з.п: ";return a&&b&&(c=a+" р. — "+b+"р."),a&&!b&&(c="от "+a+" р."),!a&&b&&(c="до "+b+" р."),a||b||(c="договорная"),a&&b&&a==b&&(c=b+" р."),d+c},g.groupArrayByParentId=function(a,b,c){for(var d=0;d<b.length;d++)void 0==a[b[d][c]]&&(a[b[d][c]]=[]),a[b[d][c]].push(b[d])},g.getObjByKeyValue=function(a,b,c){for(var d=0;d<a.length;d++)if(a[d][b]==c)return a[d];return null},g.getObjById=function(a,b){return g.getObjByKeyValue(a,"id",b)},g.findIndexById=function(a,b){for(var c=0;c<a.length;c++)if(a[c].id==b)return c;return-1},g.idInArray=function(a,b){if(!a)return!1;for(var c=0;c<b.length;c++)if(a.id==b[c].id)return!0;return!1},g}]),angular.module("hdashApp").controller("MainCtrl",["$scope","Proj",function(a,b){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.LIST({event_id:1},function(b){a.projects=b},function(a){UtilF.catchConnectionError(a)})}]),angular.module("hdashApp").factory("User",["$resource","apiurl",function(a,b){return a(b+"/api/Member/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").factory("Event",["$resource","apiurl",function(a,b){return a(b+"/api/Event/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").factory("Proj",["$resource","apiurl",function(a,b){return a(b+"/api/Project/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{event_id:"@event_id"},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").controller("ProjCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("ProjaddCtrl",["$scope","Proj","Event","UtilF",function(a,b,c,d){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.project={},c.LIST(function(b){a.events=b,1==b.length&&(a.project.event_id=b[0].id)},function(a){d.catchConnectionError(a)}),a.add=function(){b.CREATE(a.project,function(){d.addAlert("Успешно сохранено","success")},function(a){d.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("ProjeditCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("EventCtrl",["$scope","$stateParams","Proj",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"];var d=b.id;c.LIST({event_id:d},function(b){a.projects=b},function(a){UtilF.catchConnectionError(a)}),a.experts=[{id:1,name:"Иванов Иван",photo:"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg",des:"эксперт по стратегическим технологиям Microsoft"},{id:1,name:"Иванов Иван",photo:"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg",des:"эксперт по стратегическим технологиям Microsoft"},{id:1,name:"Иванов Иван",photo:"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg",des:"эксперт по стратегическим технологиям Microsoft"},{id:1,name:"Иванов Иван",photo:"https://pp.vk.me/c319121/v319121042/35fd/aWY9SFBeMl4.jpg",des:"эксперт по стратегическим технологиям Microsoft"}]}]),angular.module("hdashApp").controller("EventaddCtrl",["$scope","Event","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.add=function(){b.CREATE(a.event,function(){c.addAlert("Успешно сохранено","success")},function(a){c.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("EventeditCtrl",["$scope","$stateParams","Event","UtilF",function(a,b,c,d){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"];var e=b.id;c.VIEW({id:e},function(b){a.event=b,a.values=b.values},function(a){d.catchConnectionError(a)}),a.update=function(){c.UPDATE(a.event,function(){d.addAlert("Успешно сохранено","success")},function(a){d.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("UsermanagerCtrl",["$scope","User","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.delUser=function(d){b.DELETE({id:d},function(){c.removeFromArray(a.users,d)},function(a){c.catchConnectionError(a)})},b.LIST(function(b){a.users=b},function(a){c.catchConnectionError(a)})}]),angular.module("hdashApp").controller("UseraddCtrl",["$scope","Event","User","UtilF",function(a,b,c,d){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.user={},b.LIST(function(b){a.events=b,1==b.length&&(a.user.event_id=b[0].id)},function(a){d.catchConnectionError(a)}),a.add=function(){c.CREATE(a.user,function(){d.addAlert("Успешно сохранено","success")},function(a){d.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("UsereditCtrl",["$scope","$stateParams","Event","User","UtilF",function(a,b,c,d,e){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"];var f=b.id;f&&d.VIEW({id:f},function(b){a.user=b,c.VIEW({id:b.active_event},function(b){a.events=b,a.user.event_id=b.active_event},function(a){e.catchConnectionError(a)})},function(a){e.catchConnectionError(a)}),a.save=function(){d.UPDATE(a.user,function(){e.addAlert("Успешно сохранено","success")},function(a){e.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("ProjsCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("ExpertsCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("ExpertCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("ExpertaddCtrl",["$scope","Event","Expert","UtilF",function(a,b,c,d){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.LIST(function(b){a.events=b}),a.add=function(){c.CREATE(a.expert,function(){d.addAlert("Успешно сохранено","success")},function(a){d.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("ExperteditCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("ManagerCtrl",["$scope","$rootScope",function(a,b){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.alerts||(b.alerts=[])}]),angular.module("hdashApp").controller("ExpertsmanagerCtrl",["$scope","Expert","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.delExpert=function(d){b.DELETE({id:d},function(){c.removeFromArray(a.users,d)},function(a){c.catchConnectionError(a)})},b.LIST(function(b){a.experts=b},function(){c.catchConnectionError(data)})}]),angular.module("hdashApp").controller("EventsCtrl",["$scope","Event","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.LIST(function(b){a.events=b},function(a){c.catchConnectionError(a)}),a.delEvent=function(d){b.DELETE({id:d},function(){c.removeFromArray(a.users,d)},function(a){c.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("MainmanagerCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").factory("Expert",["$resource","apiurl",function(a,b){return a(b+"/api/Expert/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").controller("ManageraddCtrl",["$scope","Manager",function(a,b){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.add=function(){console.log(a.manager),b.CREATE(a.manager,function(){alert("success")},function(a){alert("error"),console.log(a)})}}]),angular.module("hdashApp").controller("AdminCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").factory("Manager",["$resource","apiurl",function(a,b){return a(b+"/api/Manager/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").controller("ManagersCtrl",["$scope","Manager","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.LIST(function(b){a.managers=b},function(a){c.catchConnectionError(a)}),a.delManager=function(d){b.DELETE({id:d},function(){c.removeFromArray(a.managers,d)},function(a){c.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("ManagereditCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("AdminmainCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("CriteriasCtrl",["$scope","Criteria","CriteriaValue","UtilF",function(a,b,c,d){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],b.LIST(function(b){a.criterias=b},function(a){d.catchConnectionError(a)})}]),angular.module("hdashApp").controller("CriteriaaddCtrl",["$scope","Criteria","UtilF",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.add=function(){b.CREATE(a.event,function(){c.addAlert("Успешно сохранено","success")},function(a){c.catchConnectionError(a)})}}]),angular.module("hdashApp").controller("CriteriaeditCtrl",["$scope","$stateParams","Criteria","CriteriaValue","UtilF",function(a,b,c,d,e){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"];var f=b.id;a.newValue={},c.VIEW({id:f},function(b){a.criteria=b,a.values=b.values},function(a){e.catchConnectionError(a)}),a.delValue=function(b){d.DELETE({id:b},function(){e.removeFromArray(a.values,b)},function(a){e.catchConnectionError(a)})},a.addValue=function(){a.newValue.label&&a.newValue.value?(a.newValue.criteria_id=f,d.CREATE(a.newValue,function(b){a.values.push(b),a.newValue={}},function(a){e.catchConnectionError(a)})):e.addAlert("Заполните поля","error")},a.update=function(){c.UPDATE(a.event,function(){e.addAlert("Успешно сохранено","success")},function(a){e.catchConnectionError(a)})}}]),angular.module("hdashApp").factory("Criteria",["$resource","apiurl",function(a,b){return a(b+"/api/Criteria/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]).factory("CriteriaValue",["$resource","apiurl",function(a,b){return a(b+"/api/CriteriaValue/:id",{id:"@id"},{CREATE:{method:"POST",params:{},isArray:!1},VIEW:{method:"GET",params:{id:"@id"},isArray:!1},LIST:{method:"GET",params:{},isArray:!0},UPDATE:{method:"PUT",params:{id:"@id"},isArray:!1},DELETE:{method:"DELETE",params:{id:"@id"},isArray:!1}})}]),angular.module("hdashApp").controller("EventmarksCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("LoginCtrl",["$scope","auth","$state",function(a,b,c){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.login=function(){b.loginManager(a.auth,function(){c.go("manager.main")},function(){alert("error")})}}]),angular.module("hdashApp").controller("LoginmanagerCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").controller("LoginexpertCtrl",["$scope",function(a){a.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}]),angular.module("hdashApp").factory("auth",["$resource","apiurl",function(a,b){return a(b+"/auth/:action",{},{loginManager:{method:"POST",params:{action:"login"}},loginMamber:{method:"POST",params:{action:"FullNameLogin"}},loginExpert:{method:"POST",params:{action:"ExpertLogin"}},logout:{method:"POST",params:{action:"logout"}},changepassword:{method:"POST",params:{action:"changepassword"}}})}]);