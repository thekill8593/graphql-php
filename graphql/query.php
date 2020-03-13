<?php

use App\Models\Address;
use App\Models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$rootQuery = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'user' => [
            'type' => $userType,
            'args' => [
                'id' => Type::nonNull(Type::int())
            ],
            'resolve' => function($root, $args) {
                $user = User::find($args["id"])->toArray();
                return $user;
            }
        ],
        'users' => [
            'type' => Type::listOf($userType),            
            'resolve' => function($root, $args) {
                $users = User::get()->toArray();
                return $users;
            }
        ],
        'address' => [
            'type' => $addressType,
            'args' => [
                'id' => Type::nonNull(Type::int())
            ],
            'resolve' => function($root, $args) {
                $address = Address::find($args["id"])->toArray();
                return $address;
            }
        ]
    ]
]);