<?php 
use App\Core\Router;

return function (Router $router){
    // Api Document Route
    $router->get('/','Api\ApiDocumentController@index');

    // Auth routes
    $router->post('/register', 'Api\AuthController@register');
    $router->post('/login', 'Api\AuthController@login');
    $router->post('/logout', 'Api\AuthController@logout', ['AuthMiddleware']);
    
    // Protected by AdminMiddleware
    $router->post('/departments', 'Api\DepartmentController@store', ['AdminMiddleware']);
    $router->put('/departments/{id}', 'Api\DepartmentController@update', ['AdminMiddleware']);
    $router->delete('/departments/{id}', 'Api\DepartmentController@destroy', ['AdminMiddleware']);

    // Ticket routes
    $router->post('/tickets', 'Api\TicketController@submitTicket', ['AuthMiddleware']);
    $router->put('/tickets/assign/{id}', 'Api\TicketController@assignAgent', ['AgentMiddleware']);
    $router->put('/tickets/{id}/status', 'Api\TicketController@changeStatus', ['AuthMiddleware']);
    $router->post('/tickets/{id}/notes', 'Api\TicketController@addNote', ['AuthMiddleware']);
};
