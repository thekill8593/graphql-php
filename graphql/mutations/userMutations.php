<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;

$userMutations = [
    'addUser' => [
        'type' => $userType,
        'args' => [
            'first_name' => Type::nonNull(Type::string()),
            'last_name' => Type::nonNull(Type::string()),
            'email' => Type::nonNull(Type::string()),
        ],
        'resolve' => function($root, $args) {
            $user = new User([
                'first_name' => $args['first_name'],
                'last_name' => $args['last_name'],
                'email' => $args['email'],
            ]);
            $user->save();
            return $user->toArray();
        }
    ],
    'modifyUser' => [
        'type' => $userType,
        'args' => [
            'id' => Type::nonNull(Type::int()),
            'first_name' => Type::string(),
            'last_name' => Type::string(),
            'email' => Type::string()
        ],
        'resolve' => function($root, $args) {
            $user = User::find($args['id']);
            $user->first_name = isset($args['first_name']) ? $args['first_name'] : $user->first_name;
            $user->last_name = isset($args['last_name']) ? $args['last_name'] : $user->last_name;
            $user->email = isset($args['email']) ? $args['email'] : $user->email;            
            $user->save();

            return $user->toArray();
        }
    ],
    'deleteUser' => [
        'type' => $userType,
        'args' => [
            'id' => Type::nonNull(Type::int())
        ],
        'resolve' => function($root, $args) {
            $user = User::find($args['id']);
            $user->delete();
            return $user->toArray();
        }
    ],
];