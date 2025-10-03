<?php
// 代码生成时间: 2025-10-03 17:21:48
// Include necessary Zend Framework components
use Zend\Expressive\GraphQL\GraphQLMiddleware;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

// Define the query type with a simple resolver
$queryType = new class extends \GraphQL\Type\Definition\ObjectType {
    public function __construct() {
        $config = [
            'name' => 'QueryType',
            'fields' => [
                'hello' => [
                    'type' => \GraphQL\Type\Definition\Type::string(),
                    'resolve' => function () {
                        return 'Hello, World!';
                    },
                ],
            ],
        ];
        parent::__construct($config);
    }
};

// Create the schema with the query type
$schema = new Schema(['query' => $queryType]);

// Define the GraphQL middleware
$app->post('/graphql', GraphQLMiddleware::create(
    function () use ($schema) {
        return GraphQL::create(
            function ($request) use ($schema) {
                $query = $request['query'] ?? null;
                $variableValues = $request['variables'] ?? null;
                return $schema->execute(
                    new \GraphQL\Executor\Executor(),
                    $query,
                    null,
                    null,
                    $variableValues
                );
            }
        );
    }
));

// Error handling middleware
$app->pipe(\Zend\Stratigility\Middleware\ErrorHandler::class);

// Run the application
$app->run();
