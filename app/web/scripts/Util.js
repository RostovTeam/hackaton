'use strict';

angular.module('hdashApp')
    .factory('UtilF', function ($rootScope, $resource, $q, $timeout, $cookies, apiurl, $state, $templateCache) {
        //вспомогабрика  ©Александр Супермэн
        var Utils={};





        //Elements manipulation:
        Utils.selectEditElement=function(Element,Elements,aid,Form){
            if(Form.$invalid&&$Form.$dirty){
                Utils.addAlert("Вначале заполните форму!","error");
                return null;
            }
            Element=Elements[aid];
        };

        Utils.tryAddElement=function(scope,elem,array,form,showErrors){
            var n=array.indexOf(scope[elem]);
            if(form.$invalid&&form.$dirty){
                Utils.addAlert("Вначале заполните предыдущую форму!","error");
                scope[showErrors]=true;
                return null;
            }
            scope[showErrors]=false;
            if (form.$valid) {
                if (n==-1) {
                    scope[elem].aid = array.length;
                    array.push(scope[elem]);
                }
                scope[elem]={};
                form.$setPristine();
                return ["success",n];
            }
        };

        Utils.clearForm=function (scope,elem,array,data,form) {
            var header,text;
            if(scope[elem].id){
                header="Вы действительно хотите отменить изменения?";
                text="Введённые вами знаения будут утеряны";
            } else{
                header="Вы действительно хотите очистить форму?";
                text="Форма будет очищена";
            }

            var modalInstance = $modal.open({
                templateUrl: 'template/dialogs/confirmDialog.html',
                controller: 'ConfirmDialogCtrl',
                resolve: {
                    header: function () {
                        return header;
                    },
                    text: function () {
                        return text;
                    }
                }
            });
            return modalInstance.result.then(function () {
                console.log("Идёт очистка");
                var n=array.indexOf(scope[elem]);
                if(scope[elem].id){
                    array[n]=angular.copy(Utils.getObjById(data,scope[elem].id));
                    array[n].aid=n;
                    scope[elem]=array[n];
                }
                else if(n>-1){
                    array.splice(n,1);
                    scope[elem]={};
                }
                else{
                    scope[elem]={};
                }
                form.$setPristine();
                return true;
            },function(){
                console.log("отмена");
                return false;
            });
        };

        Utils.removeFromArray=function(array,id){
            var len=array.length;
            for(var i=id;i<len-1;i++){
                array[i]=array[i+1];
                array[i].aid=i;
            }
            array.length--;
        };

        Utils.DeleteFromResource=function (array,resource,aid){
            var header="Вы действительно хотите удалить элемент?";
            var text="Элемент будет удалён с сервера сразу после подтверждения!";
            if(!array[aid].id){
                header="Вы действительно хотите удалить форму?";
                text="Введённые вами данные будут удалены";
            }
            var modalInstance = $modal.open({
                templateUrl: 'template/dialogs/confirmDialog.html',
                controller: 'ConfirmDialogCtrl',
                resolve: {
                    header: function () {
                        return header;
                    },
                    text: function () {
                        return text;
                    }
                }
            });
            return modalInstance.result.then(function () {
                if (array[aid].id) {
                    resource.DELETE({id: array[aid].id}, function () {
                            Utils.removeFromArray(array, aid);
                            Utils.addAlert('элемент был успешно удалён с сервера','info')
                        }
                    )
                } else {
                    Utils.removeFromArray(array, aid);
                }
                return true;
            },function(){
                console.log("отмена");
                return false;
            });
        };

        //:manipulate(elements)

        Utils.addAlert=function(msg,type){
            var alert={
                'msg' : msg,
                'type': type
            };
            alert.fun= function () {
                var selfDeleting= function (e) {
                    var index=$rootScope.alerts.indexOf(e);
                    if(index>-1){
                        $rootScope.alerts.splice(index, 1);
                    }
                };
                var a=this;
                $timeout(function(){selfDeleting(a)}, 5000);
            };
            if(!$rootScope.alerts){
                $rootScope.alerts=[];
            }
            $rootScope.alerts.push(alert);
            if($rootScope.alerts.length>3)
                $rootScope.alerts.splice(0, $rootScope.alerts.length-3);
            alert.fun();
        };


        Utils.doShowTooltip=function(form,showError){
            if(form)
                return form.$error.required&&(form.$dirty||showError);
            else
                return false;
        };


        Utils.catchConnectionError=function(error){
            console.log(error);
            switch(error.status){
                case(403):
                    Utils.logout();
                    break;
                case(0):
                    Utils.addAlert("Ошибка! Сервер временно недоступен, попробуйте перезапустить страницу.","error");
                    break;
                default:
                    Utils.addAlert("Произошла ошибка "+error.status+" "+(error.data instanceof Object)?error.data:error.data.error,"error");
            }
        };


        Utils.showErrors=function(){
            var multiselects=document.getElementsByTagName("multiselect");
            for(var i=0;i<multiselects.length;i++){
                angular.element(multiselects[i]).addClass("multiselect-show-errors");
            }
            var g_inputs=document.getElementsByClassName("g-input");
            for(var i=0;i<g_inputs.length;i++){
                angular.element(g_inputs[i]).addClass("g-input_show_error");
            }
            var g_inputs_2=document.getElementsByClassName("g-input_2");
            for(var i=0;i<g_inputs_2.length;i++){
                angular.element(g_inputs_2[i]).addClass("g-input_show_error");
            }
            var g_switchers=document.getElementsByClassName("g-switcher");
            for(var i=0;i<g_switchers.length;i++){
                angular.element(g_switchers[i]).addClass("g-switcher_show_errors");
            }
        };

        Utils.promiseQuery=function(query){
            var d = $q.defer();
            var result=query(function (data) {
                    d.resolve(result);
                }
            );
            return d.promise;
        };

        Utils.afterAllQueries= function (queries) {
            var promiseQueries=[];
            for(var i=0;i<queries.length;i++){
                promiseQueries.push(Utils.promiseQuery(queries[i]));
            }
            return $q.all(promiseQueries);
        };

        Utils.logout=function(){
            $cookies.role="anon";
            $rootScope.user={};
            $rootScope.mini_image=apiurl+'/img/No_Avatar.png';
            $rootScope.header_label1=null;
            $rootScope.header_label2=null;
            Auth.logout();
        };


        //Strings:
        Utils.Rus=function(num,one,some,many){
            if(num%10==1&&num%100!=11)
                return one;
            if(num%10>=2&&num%10<=4&&(num%100<=10||num%100>=20))
                return some;
            return many;
        };

        Utils.Date2SendStr= function(date){
            if(!(date instanceof Date)){
                date=new Date(Date.parse(date));
            }
            if(date instanceof Date){
                return date.getFullYear() + '-' + (date.getMonth() + 1) +  '-' + date.getDate();
            }
        };

        Utils.salaryMinMax2text= function (salary_min,salary_max) {
            var str="з.п: ";
            var str2;
            if( salary_min&& salary_max)
                str2=salary_min + " р. — "+ salary_max +"р.";
            if( salary_min&&!salary_max)
                str2="от "+ salary_min +" р.";
            if(!salary_min&& salary_max)
                str2="до "+ salary_max +" р.";
            if(!salary_min&&!salary_max)
                str2="договорная";
            if( salary_min&& salary_max&& salary_min== salary_max)
                str2=salary_max + " р.";
            return str+str2;
        };
        //:string



        //Objects and Arrays:
        Utils.groupArrayByParentId=function(sorted,unsorted,parentparam){
            for (var i = 0; i < unsorted.length; i++) {
                if (sorted[unsorted[i][parentparam]] == undefined) {
                    sorted[unsorted[i][parentparam]] = [];
                }
                sorted[unsorted[i][parentparam]].push(unsorted[i]);
            }
        };
//         before:{a.p=1; b.p=1; c.p=2; d.p=2; e.p=3} //unsorted
//         after: [ 1:[a,b],2:[c,d],3:[e]] //sorted


        Utils.getObjByKeyValue=function(array,key,value)
        {
            for(var i=0;i<array.length;i++)
            {
                if(array[i][key]==value){
                    return array[i];
                }
            }
            return null;
        };

        Utils.getObjById=function(array,id)
        {
            return Utils.getObjByKeyValue(array,"id",id);
        };
        Utils.findIndexById=function(array,id){
            for(var i=0;i<array.length;i++)
            {
                if(array[i].id==id){
                    return i;
                }
            }
            return -1;
        };

        Utils.idInArray= function (val, arr) {
            if(!val) return false;
            for(var i=0;i<arr.length;i++){
                if(val.id==arr[i].id){
                    return true
                }
            }
            return false;
        };
        //:Arrays-Objects

        ////
        return Utils;
    });