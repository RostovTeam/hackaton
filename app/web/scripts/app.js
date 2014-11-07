'use strict';


angular.module('hdashApp', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ui.router',
    'config',
    'ui.utils'
])
    .config(function ($stateProvider, $urlRouterProvider) {
        //delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $urlRouterProvider.otherwise('/');
        $stateProvider
            .state('g', {
                abstract: true,
                templateUrl: "views/global.html"
            })

            .state('g.event', {
                url: '/event/:id',
                templateUrl: '../modules/event/event.html',
                controller: 'EventCtrl'
            })
            .state('g.user', {
                url: '/user/:id',
                templateUrl: '../modules/user/user.html',
                controller: 'UserCtrl'
            })
            .state('g.proj', {
                url: '/proj/:id',
                templateUrl: '../modules/proj/proj.html',
                controller: 'ProjCtrl'
            })
            .state('g.projs', {
                url: '/projs',
                templateUrl: '../modules/proj/projs.html',
                controller: 'ProjsCtrl'
            })
            .state('g.projAdd', {
                url: '/projAdd',
                templateUrl: '../modules/proj/projAdd.html',
                controller: 'ProjaddCtrl'
            })
            .state('g.experts', {
                url: '/experts',
                templateUrl: '../modules/expert/experts.html',
                controller: 'ExpertsCtrl'
            })
            .state('g.expert/:id', {
                url: '/expert',
                templateUrl: '../modules/expert/expert.html',
                controller: 'ExpertCtrl'
            })
            .state('g.index', {
                url: '/',
                templateUrl: 'views/main.html',
                controller: 'MainCtrl'
            });

        $stateProvider.state('manager', {
            abstract: true,
            templateUrl: '../modules/manager/manager.html'
        })
            .state('manager.main', {
                url: '/manager',
                templateUrl: '../modules/manager/mainManager.html',
                controller: 'MainmanagerCtrl'
            })
            .state('manager.experts', {
                url: '/manager/experts',
                templateUrl: '../modules/manager/expertsManager.html',
                controller: 'ExpertsmanagerCtrl'
            })
            .state('manager.expertAdd', {
                url: '/expertAdd',
                templateUrl: '../modules/expert/expertAdd.html',
                controller: 'ExpertaddCtrl'
            })
            .state('manager.expertEdit', {
                url: '/expertEdit/:id',
                templateUrl: '../modules/expert/expertEdit.html',
                controller: 'ExperteditCtrl'
            })
            .state('manager.events', {
                url: '/manager/events',
                templateUrl: '../modules/event/events.html',
                controller: 'EventsCtrl'
            })
            .state('manager.eventAdd', {
                url: '/manager/eventAdd',
                templateUrl: '../modules/event/eventAdd.html',
                controller: 'EventaddCtrl'
            })
            .state('manager.eventEdit', {
                url: '/manager/eventEdit/:id',
                templateUrl: '../modules/event/eventEdit.html',
                controller: 'EventeditCtrl'
            })
            .state('manager.users', {
                url: '/manager/users',
                templateUrl: '../modules/manager/user/users.html',
                controller: 'UsermanagerCtrl'
            })
            .state('manager.userAdd', {
                url: '/manager/userAdd',
                templateUrl: '../modules/user/userAdd.html',
                controller: 'UseraddCtrl'
            })
            .state('manager.userEdit', {
                url: '/manager/userEdit/:id',
                templateUrl: '../modules/user/userEdit.html',
                controller: 'UsereditCtrl'
            })
        $stateProvider.state('admin', {
            abstract: true,
            templateUrl: '../modules/admin/admin.html'
        })
            .state('admin.main', {
                url: '/admin',
                templateUrl: '../modules/admin/adminMain.html',
                controller: 'AdminmainCtrl'
            })
            .state('admin.managers', {
                url: '/managers',
                templateUrl: '../modules/admin/managers.html',
                controller: 'ManagersCtrl'
            })
            .state('admin.managerEdit', {
                url: '/managerEdit/:id',
                templateUrl: '../modules/admin/managerEdit.html',
                controller: 'ManagereditCtrl'
            })
            .state('manager.criterias', {
              url: '/criterias',
              templateUrl: '../modules/criteria/criterias.html',
              controller: 'CriteriasCtrl'
            })
            .state('manager.criteriaAdd', {
              url: '/criteriaAdd',
              templateUrl: '../modules/criteria/criteriaAdd.html',
              controller: 'CriteriaaddCtrl'
            })
            .state('manager.criteriaEdit', {
              url: '/criteriaEdit/:id',
              templateUrl: '../modules/criteria/criteriaEdit.html',
              controller: 'CriteriaeditCtrl'
            })
            .state('eventMarks', {
              url: '/eventMarks',
              templateUrl: 'views/eventMarks.html',
              controller: 'EventmarksCtrl'
            })
            .state('login', {
              url: '/login',
              templateUrl: 'views/login.html',
              controller: 'LoginCtrl'
            })
            .state('loginManager', {
              url: '/loginManager',
              templateUrl: 'views/loginManager.html',
              controller: 'LoginmanagerCtrl'
            })
            .state('loginExpert', {
              url: '/loginExpert',
              templateUrl: 'views/loginExpert.html',
              controller: 'LoginexpertCtrl'
            })
            .state('admin.managerAdd', {
                url: '/managerAdd',
                templateUrl: '../modules/admin/managerAdd.html',
                controller: 'ManageraddCtrl'
            })

    });




