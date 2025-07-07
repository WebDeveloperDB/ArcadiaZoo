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
        '/admin/create-users' => [[['_route' => 'create_user', '_controller' => 'App\\Controller\\AdminDashboardController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/admin/users' => [[['_route' => 'get_users', '_controller' => 'App\\Controller\\AdminDashboardController::listUsers'], null, ['GET' => 0], null, false, false, null]],
        '/api/avis' => [
            [['_route' => 'create_avis', '_controller' => 'App\\Controller\\AvisController::createAvis'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'get_avis', '_controller' => 'App\\Controller\\AvisController::getAvis'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/consultations' => [[['_route' => 'get_consultations', '_controller' => 'App\\Controller\\ConsultationController::getConsultations'], null, ['GET' => 0], null, false, false, null]],
        '/api/contact' => [[['_route' => 'contact_form', '_controller' => 'App\\Controller\\ContactController::sendContactMail'], null, ['POST' => 0], null, false, false, null]],
        '/api/contact/requests' => [[['_route' => 'get_contact_requests', '_controller' => 'App\\Controller\\ContactController::getContactRequests'], null, ['GET' => 0], null, false, false, null]],
        '/api/contact/reply' => [[['_route' => 'reply_contact_request', '_controller' => 'App\\Controller\\ContactController::replyContactRequest'], null, ['POST' => 0], null, false, false, null]],
        '/api/habitats' => [
            [['_route' => 'get_habitats', '_controller' => 'App\\Controller\\HabitatController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_habitat', '_controller' => 'App\\Controller\\HabitatController::store'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/registration' => [[['_route' => 'app_api_registration', '_controller' => 'App\\Controller\\LoginController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => 'app_api_login', '_controller' => 'App\\Controller\\LoginController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/admin/create-user' => [[['_route' => 'api_create_user', '_controller' => 'App\\Controller\\RegistrationController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/api/services' => [
            [['_route' => 'get_services', '_controller' => 'App\\Controller\\ServiceController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'create_service', '_controller' => 'App\\Controller\\ServiceController::store'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/a(?'
                    .'|dmin/users/([^/]++)(?'
                        .'|(*:34)'
                    .')'
                    .'|pi/(?'
                        .'|habitats/([^/]++)(?'
                            .'|/animals(?'
                                .'|(*:79)'
                                .'|/([^/]++)(?'
                                    .'|(*:98)'
                                .')'
                                .'|(*:106)'
                            .')'
                            .'|(*:115)'
                        .')'
                        .'|a(?'
                            .'|vis/([^/]++)(?'
                                .'|(*:143)'
                            .')'
                            .'|nimals/([^/]++)/(?'
                                .'|consult(*:178)'
                                .'|reports(?'
                                    .'|(*:196)'
                                    .'|/([^/]++)(?'
                                        .'|(*:216)'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|services/([^/]++)(?'
                            .'|(*:248)'
                        .')'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        34 => [
            [['_route' => 'update_user', '_controller' => 'App\\Controller\\AdminDashboardController::updateUser'], ['email'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_user', '_controller' => 'App\\Controller\\AdminDashboardController::deleteUser'], ['email'], ['DELETE' => 0], null, false, true, null],
        ],
        79 => [[['_route' => 'get_animals', '_controller' => 'App\\Controller\\AnimalController::index'], ['habitatId'], ['GET' => 0], null, false, false, null]],
        98 => [
            [['_route' => 'get_animal', '_controller' => 'App\\Controller\\AnimalController::show'], ['habitatId', 'animalId'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_animal', '_controller' => 'App\\Controller\\AnimalController::update'], ['habitatId', 'animalId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_animal', '_controller' => 'App\\Controller\\AnimalController::delete'], ['habitatId', 'animalId'], ['DELETE' => 0], null, false, true, null],
        ],
        106 => [[['_route' => 'create_animal', '_controller' => 'App\\Controller\\AnimalController::store'], ['habitatId'], ['POST' => 0], null, false, false, null]],
        115 => [
            [['_route' => 'get_habitat', '_controller' => 'App\\Controller\\HabitatController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_habitat', '_controller' => 'App\\Controller\\HabitatController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_habitat', '_controller' => 'App\\Controller\\HabitatController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        143 => [
            [['_route' => 'update_avis', '_controller' => 'App\\Controller\\AvisController::updateAvis'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_avis', '_controller' => 'App\\Controller\\AvisController::deleteAvis'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        178 => [[['_route' => 'animal_consult', '_controller' => 'App\\Controller\\ConsultationController::incrementConsultation'], ['name'], ['POST' => 0], null, false, false, null]],
        196 => [
            [['_route' => 'get_reports', '_controller' => 'App\\Controller\\VeterinaryReportController::index'], ['animalId'], ['GET' => 0], null, false, false, null],
            [['_route' => 'create_report', '_controller' => 'App\\Controller\\VeterinaryReportController::store'], ['animalId'], ['POST' => 0], null, false, false, null],
        ],
        216 => [
            [['_route' => 'update_report', '_controller' => 'App\\Controller\\VeterinaryReportController::update'], ['animalId', 'reportId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_report', '_controller' => 'App\\Controller\\VeterinaryReportController::delete'], ['animalId', 'reportId'], ['DELETE' => 0], null, false, true, null],
        ],
        248 => [
            [['_route' => 'get_service', '_controller' => 'App\\Controller\\ServiceController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_service', '_controller' => 'App\\Controller\\ServiceController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_service', '_controller' => 'App\\Controller\\ServiceController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
