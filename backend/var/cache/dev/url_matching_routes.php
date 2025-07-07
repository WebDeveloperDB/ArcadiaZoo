<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'], null, ['GET' => 0], null, false, false, null]],
        '/api/doc' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/admin/create-user' => [[['_route' => 'app_api_api_create_user', '_controller' => 'App\\Controller\\AdminDashboardController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/api/admin/users' => [[['_route' => 'app_api_get_users', '_controller' => 'App\\Controller\\AdminDashboardController::listUsers'], null, ['GET' => 0], null, false, false, null]],
        '/api/animals' => [[['_route' => 'create_animal', '_controller' => 'App\\Controller\\AnimalController::create'], null, ['POST' => 0], null, false, false, null]],
        '/api/avis' => [[['_route' => 'create_avis', '_controller' => 'App\\Controller\\AvisController::createAvis'], null, ['POST' => 0], null, false, false, null]],
        '/api/avis/validated' => [[['_route' => 'get_validated_avis', '_controller' => 'App\\Controller\\AvisController::getValidatedAvis'], null, ['GET' => 0], null, false, false, null]],
        '/api/avis/pending' => [[['_route' => 'get_pending_avis', '_controller' => 'App\\Controller\\AvisController::getPendingAvis'], null, ['GET' => 0], null, false, false, null]],
        '/api/consultations' => [
            [['_route' => 'increment_consultation', '_controller' => 'App\\Controller\\ConsultationController::incrementConsultation'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'get_consultations', '_controller' => 'App\\Controller\\ConsultationController::getConsultations'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/contact' => [[['_route' => 'api_contact_create', '_controller' => 'App\\Controller\\ContactController::create'], null, ['POST' => 0], null, false, false, null]],
        '/api/contact/requests' => [[['_route' => 'api_contact_list', '_controller' => 'App\\Controller\\ContactController::list'], null, ['GET' => 0], null, false, false, null]],
        '/api/contact/reply' => [[['_route' => 'api_contact_reply', '_controller' => 'App\\Controller\\ContactController::reply'], null, ['POST' => 0], null, false, false, null]],
        '/test-email' => [[['_route' => 'app_contact_testemail', '_controller' => 'App\\Controller\\ContactController::testEmail'], null, null, null, false, false, null]],
        '/api/habitats' => [
            [['_route' => 'get_habitats', '_controller' => 'App\\Controller\\HabitatController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_habitat', '_controller' => 'App\\Controller\\HabitatController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/login' => [[['_route' => 'app_api_login', '_controller' => 'App\\Controller\\LoginController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/services' => [
            [['_route' => 'get_services', '_controller' => 'App\\Controller\\ServiceController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_service', '_controller' => 'App\\Controller\\ServiceController::create'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/api/(?'
                    .'|a(?'
                        .'|dmin/users/([^/]++)(?'
                            .'|(*:236)'
                        .')'
                        .'|nimals/([^/]++)(?'
                            .'|(*:263)'
                        .')'
                        .'|vis/([^/]++)(?'
                            .'|/validate(*:296)'
                            .'|(*:304)'
                        .')'
                    .')'
                    .'|contact/requests/([^/]++)(*:339)'
                    .'|habitats/([^/]++)(?'
                        .'|(*:367)'
                    .')'
                    .'|services/([^/]++)(?'
                        .'|(*:396)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        236 => [
            [['_route' => 'app_api_update_user', '_controller' => 'App\\Controller\\AdminDashboardController::updateUser'], ['email'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_api_delete_user', '_controller' => 'App\\Controller\\AdminDashboardController::deleteUser'], ['email'], ['DELETE' => 0], null, false, true, null],
        ],
        263 => [
            [['_route' => 'get_animals', '_controller' => 'App\\Controller\\AnimalController::index'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_animal', '_controller' => 'App\\Controller\\AnimalController::update'], ['id'], ['POST' => 0, 'PUT' => 1], null, false, true, null],
            [['_route' => 'delete_animal', '_controller' => 'App\\Controller\\AnimalController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        296 => [[['_route' => 'validate_avis', '_controller' => 'App\\Controller\\AvisController::validateAvis'], ['id'], ['POST' => 0], null, false, false, null]],
        304 => [[['_route' => 'delete_avis', '_controller' => 'App\\Controller\\AvisController::deleteAvis'], ['id'], ['DELETE' => 0], null, false, true, null]],
        339 => [[['_route' => 'delete_contact_request', '_controller' => 'App\\Controller\\ContactController::deleteContactRequest'], ['id'], ['DELETE' => 0], null, false, true, null]],
        367 => [
            [['_route' => 'update_habitat', '_controller' => 'App\\Controller\\HabitatController::update'], ['id'], ['PUT' => 0, 'POST' => 1], null, false, true, null],
            [['_route' => 'delete_habitat', '_controller' => 'App\\Controller\\HabitatController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        396 => [
            [['_route' => 'update_service', '_controller' => 'App\\Controller\\ServiceController::update'], ['id'], ['PUT' => 0, 'POST' => 1], null, false, true, null],
            [['_route' => 'delete_service', '_controller' => 'App\\Controller\\ServiceController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
