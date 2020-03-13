<?php

use App\Models\Address;
use GraphQL\Type\Definition\Type;

$addressMutations = [
    'addAddress' => [
        'type' => $addressType,
        'args' => [
            'user_id' => Type::nonNull(Type::int()),
            'name' => Type::nonNull(Type::string()),
            'description' => Type::nonNull(Type::string())   
        ],
        'resolve' => function($root, $args) {
            $address = new Address([
                'user_id' => $args['user_id'],
                'name' => $args['name'],
                'description' => $args['description']
            ]);

            $address->save();
            return $address->toArray();
        }
    ]
];